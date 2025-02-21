<?php

namespace NSO\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use NSO\Backend\Traits\WithEvent;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles, WithEvent;

    protected $fillable = [
        'username',
        'password',
        'ninja',
        'activated',
        'balance',
        'luong',
        'tongnap',
        'kh',
        'otp',
        'phone',
        'gift',
        'amount_unpaid',
        'status',
        'online',
        'nap',
        'lock',
        'last_attendance_at',
        'level_reward',
        'role',
        'ban_until',
        'createtime',
        'time_post',
        'deleted_at',
        'updated_at',
        'ip_web',
        'isTien',
        'level',
        'activated_at',
        'ip_register'
    ];

    protected $dates = [
        'last_attendance_at',
        'ban_until',
        'createtime',
        'time_post',
        'deleted_at',
        'updated_at'
    ];

    public function player(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Player::class, 'user_id');
    }
}
