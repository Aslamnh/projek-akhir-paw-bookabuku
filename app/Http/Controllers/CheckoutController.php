<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
{
    $cartItems = CartItem::with('book')
        ->where('user_id', Auth::id())
        ->get();

    $total = 0;
    $shippingCost = 10000;

    foreach ($cartItems as $item) {

        $total +=
            $item->book->price *
            $item->quantity;
    }
    $total += $shippingCost;
    return view('checkout', compact(
        'cartItems',
        'total',
        'shippingCost'
    ));
}
    public function process()
    {
        // ambil cart user
        $cartItems = CartItem::with('book')
            ->where('user_id', Auth::id())
            ->get();

        // kalau cart kosong
        if ($cartItems->isEmpty()) {

            return back()->with('error', 'Keranjang kosong');
        }

        $total = 0;

        // hitung total + cek stock
        foreach ($cartItems as $item) {

            if ($item->book->stock < $item->quantity) {

                return back()->with(
                    'error',
                    'Stock buku tidak mencukupi'
                );
            }

            $total +=
                $item->book->price *
                $item->quantity;
        }

        // buat order
        $order = Order::create([

        'user_id' => Auth::id(),
        'total_price' => $total,
        'status' => 'pending',
        'payment_status' => 'unpaid',
        'payment_method' => request('payment_method'),
        'payment_id' => 'PAY-' . strtoupper(uniqid()),
        'payment_code' => rand(100000, 999999),
]);

        // buat order items
        foreach ($cartItems as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book->id,
                'price' => $item->book->price,
                'quantity' => $item->quantity,
                'subtotal' =>
                    $item->book->price *
                    $item->quantity,
            ]);

            // kurangi stock
            $item->book->decrement(
                'stock',
                $item->quantity
            );
        }

        // hapus cart
        CartItem::where('user_id', Auth::id())
            ->delete();

        return redirect()
            ->route('payment.show', $order->id)
            ->with('success', 'Order berhasil dibuat');
    }
}