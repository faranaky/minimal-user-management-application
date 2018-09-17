<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'pivot'
    ];

    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_group');
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function addGroup($data)
    {
        return self::create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public static function updateGroup($id, $data)
    {
        $group = Group::findOrFail($id);

        $group->update($data);

        return $group;
    }

    /**
     * @param $id
     */
    public static function removeGroup($id)
    {
        $group = Group::findOrFail($id);
        if($group->users->count()){
            return false;
        }
        $group->delete();

        return true;
    }
}
