<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_line extends Model
{
    use HasFactory;

    protected $fillable = [
        'productline',
        'description',
        'image'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_details', 'productline_id', 'product_id');
    }
}
