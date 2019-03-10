<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'order_id', 'comments'];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
