<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\JualController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
// Route::get('/katalog/buku/{buku}', [KatalogController::class, 'show'])->name('katalog.show');
Route::get('/buku/{book}', [KatalogController::class, 'show'])->name('buku.show');


// Halaman Jual — bisa diakses guest maupun user (controller handle keduanya)
Route::get('/jual', [JualController::class, 'index'])->name('jual');

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

    // CRUD Listing Jual Buku (hanya untuk user yang sudah login)
    Route::post('/jual', [JualController::class, 'store'])->name('jual.store');
    Route::put('/jual/{book}', [JualController::class, 'update'])->name('jual.update');
    Route::delete('/jual/{book}', [JualController::class, 'destroy'])->name('jual.destroy');
});

require __DIR__.'/auth.php';