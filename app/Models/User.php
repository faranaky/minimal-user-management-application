<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'user_group')->select(['id', 'name']);
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function addUser($data)
    {
        $user = self::create($data);

        if (isset($data['groups']) && is_array($data['groups']))
        {
            $groups = Group::whereIn('id', $data['groups'])->get()->keyBy('id')->toArray();
        }
        $user->groups()->attach(array_keys($groups));

        $user->groups;

        return $user;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public static function updateUser($id, $data)
    {
        $user = self::findOrFail($id);
        $user->update($data);

        if (isset($data['groups']) && is_array($data['groups']))
        {
            $groups = Group::whereIn('id', $data['groups'])->get()->keyBy('id')->toArray();
        }
        $user->groups()->sync(array_keys($groups));

        return $user;
    }

    /**
     * @param $id
     */
    public static function removeUser($id)
    {
        $user = self::findOrFail($id);
        $user->groups()->detach();
        $user->delete();
    }
}
