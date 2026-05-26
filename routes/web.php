<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/katalog', function () {
    return view('katalog');
})->name('katalog');

Route::get('/jual', function () {
    return view('jual');
})->name('jual');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/login', function () {
    session()->flash('openLoginModal', true);

    return redirect()->route('beranda');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');

});

require __DIR__.'/auth.php';