<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_id',
        'payment_code',
        'payment_method',
        'payment_status',
    ];

    // Order dimiliki satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order punya banyak item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}