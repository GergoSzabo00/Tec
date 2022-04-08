<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'country', 'state', 'zip_code', 'city', 'address',
    ];

    public function customers()
    {
        return $this->belongsToMany(User::class, 'customer_addresses', 'address_id', 'customer_id')->withTimestamps();
    }

}
