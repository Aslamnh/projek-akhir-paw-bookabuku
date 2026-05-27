<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
    $cartItems = CartItem::with('book')
        ->where('user_id', Auth::id())
        ->get();
    return view('keranjang', compact('cartItems'));
    }

    public function add(Book $book)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {

            $cartItem->increment('quantity');

        } else {

            CartItem::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Buku ditambahkan ke keranjang');
    }
    public function delete(CartItem $cartItem)
{
    // Pastikan item milik user yang login
    if ($cartItem->user_id != Auth::id()) {
        abort(403);
    }

    $cartItem->delete();

    return back()->with('success', 'Item dihapus dari keranjang');
}
}