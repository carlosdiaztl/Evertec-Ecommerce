<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'user_id',
        'order_id',
        'url',
        'total',
        'status',
        'provider'

    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')
                    ->withPivot('quantity');
    }
}
