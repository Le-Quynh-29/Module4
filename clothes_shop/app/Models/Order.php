<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'required_date',
        'shipped_date',
        'status',
        'message'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_detail', 'order_id', 'product_id');
    }
}
