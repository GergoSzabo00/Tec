<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'customer_name', 'shipping_address', 'phone', 'order_status', 'payment_option', 'total_price',
    ];

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function payment_option()
    {
        return $this->belongsTo(PaymentOption::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetal::class);
    }

}
