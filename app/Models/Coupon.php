<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code', 'type', 'coupon_value', 'minimum_cart_amount', 'expires_at'
    ];

    public function getTypeAttribute()
    {
        return __($this->attributes['type']);
    }

}
