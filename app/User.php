<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'organization', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Связь один ко многим
     * Пользователь может иметь несколько заказов
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'id');
    }

    /**
     * Список ролей для пользователя
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_in_roles', 'user_id', 'role_id');
    }

    /**
     * Имеет ли пользователь роли
     * 
     * @param mixed $roles - список ролей
     * @return bool - имеет ли роли
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
            return false;
        }
    }

    /**
     * Имеет ли конкретную роль
     * 
     * @param mixed $role - роль
     * @return bool - имеет ли роль
     */
    public function hasRole($role): bool
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    /**
     * Имеет ли пользователь вообще роли
     * 
     * @return bool - имеет ли роли
     */
    public function hasRoles(): bool
    {
        return $this->roles()->count() > 0;
    }
}
