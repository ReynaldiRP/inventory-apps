<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'type_id',
        'code',
        'name',
        'unit',
        'stock',
        'price',
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
