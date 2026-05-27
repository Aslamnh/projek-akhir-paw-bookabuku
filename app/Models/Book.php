<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartItem;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'stock',
        'image',
        'rating',
        'user_id',
        'category',
    ];

    /**
     * Relasi: buku ini dimiliki oleh satu user (penjual).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //CartItems : 1 user bisa membeli banyak buku
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
