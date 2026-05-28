<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Rating;
use App\Models\OrderItem;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}