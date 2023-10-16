<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    protected $fillable = [
        'name',
    ];

    public function getNameAttribute()
    {
        return __($this->attributes['name']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
