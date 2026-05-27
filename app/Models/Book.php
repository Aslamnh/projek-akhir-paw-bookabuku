<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
