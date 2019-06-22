<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExecutorInOrder extends Model
{
    protected $table = 'executor_in_orders';
    protected $fillable = ['order_id', 'user_id'];
}
