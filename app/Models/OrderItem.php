<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'book_id',
        'price',
        'quantity',
        'subtotal',
    ];

    // item milik order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // item mengacu ke buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}