<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function getHasVerifiedEmailAttribute()
    {
        return $this->is_verified;
    }

    public function customer_info()
    {
        return $this->hasOne(CustomerInfo::class);
    }

    public function customer_addresses()
    {
        return $this->belongsToMany(Address::class, 'customer_addresses', 'customer_id', 'address_id')->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
