<?php

declare(strict_types=1);

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
    public function executors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\User', 'executor_in_orders', 'order_id', 'user_id');
    }

    /**
     * Список комментарий
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }

    /**
     * Список услуг в заказе
     */
    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Service', 'service_in_orders', 'id_order', 'id_service');
    }
}
