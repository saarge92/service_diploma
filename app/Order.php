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
}
