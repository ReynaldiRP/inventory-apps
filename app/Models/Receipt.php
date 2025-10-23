<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    /** @use HasFactory<\Database\Factories\ReceiptFactory> */
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'user_id',
        'product_id',
        'quantity',
        'price',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
