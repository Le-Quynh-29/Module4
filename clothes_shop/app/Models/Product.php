<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'quantity',
        'price',
        'voucher',
        'image'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_detail', 'product_id', 'order_id');
    }

    public function productlines()
    {
        return $this->belongsToMany(Product_line::class, 'product_details', 'product_id', 'productline_id');
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class,'product_id');
    }

    public function productLikes()
    {
        return $this->hasMany(ProductLike::class,'product_id');
    }
}
