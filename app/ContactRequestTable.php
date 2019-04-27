<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Таблица для хранения данных о запросах пользователя связаться с ним
 */
class ContactRequestTable extends Model
{
    protected $fillable = ['name', 'phone', 'comments'];
}
