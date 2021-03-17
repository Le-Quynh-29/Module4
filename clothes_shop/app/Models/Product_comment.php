<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'comment'
    ];

    protected $table = 'product_comment';

    public function customers()
    {
        $this->belongsTo(Customer::class, 'customer_id');
    }

    public function products()
    {
        $this->belongsTo(Product::class, 'product_id');
    }
}
