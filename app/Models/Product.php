<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'description', 'price', 'quantity_in_stock'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getHasProductImageAttribute()
    {
        return $this->product_image != null;
    }

    public function getProductImageAttribute()
    {
        if ($this->has_product_image) 
        {
            return asset('uploads/product_images/{$this->product_image}');
        }
        //todo return placeholder
    }

}
