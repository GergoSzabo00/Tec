<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name','description', 'manufacturer_id', 'price', 'quantity_in_stock'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function getHasProductImageAttribute()
    {
        return $this->attributes['product_image'] != null;
    }

    public function getProductImageAttribute()
    {
        if ($this->has_product_image) 
        {
            return asset("images/products/{$this->attributes['product_image']}");
        }
        return asset("images/products/placeholder.png");
    }

    public function getProductImageFilenameAttribute()
    {
        if ($this->has_product_image)
        {
            return $this->attributes['product_image'];
        }
        else
        {
            return null;
        }
    }

}
