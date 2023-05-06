<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'status',
        'image',
        'description',
        'price',
        'stock'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
