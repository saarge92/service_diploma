<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInRole extends Model
{
    public $table = 'user_in_roles';
    protected $fillable = ['user_id', 'role_id'];
}
