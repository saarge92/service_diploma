<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [''];
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_in_roles', 'user_id', 'role_id');
    }
}
