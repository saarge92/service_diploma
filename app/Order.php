<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Список пользователей
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * Список исполнителей
    */
    public function executors()
    {
        return $this->belongsToMany('App\User', 'executor_in_orders', 'order_id', 'user_id');
    }

    /**
     * Список комментарий
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }
}
