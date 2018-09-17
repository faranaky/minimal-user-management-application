<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $fillable = [
        'username', 'password', 'name'
    ];

    public $hidden = [
      'api_token'
    ];


    /**
     * Roll API Key
     */
    public function rollApiKey()
    {
        do {
            $this->api_token = str_random(60);
        }while($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }
}
