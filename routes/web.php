<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\JualController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/buku/{book}', [KatalogController::class, 'show'])->name('buku.show');

Route::get('/jual', [JualController::class, 'index'])->name('jual');

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

    Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')
    ->name('cart');
    Route::get('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/delete/{cartItem}',[CartController::class, 'delete'])->name('cart.delete');

    //Checkout
    Route::post('/checkout/process', [CheckoutController::class, 'process'])
    ->middleware('auth')
    ->name('checkout.process');
    Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout');


    Route::post('/jual', [JualController::class, 'store'])->name('jual.store');
    Route::put('/jual/{book}', [JualController::class, 'update'])->name('jual.update');
    Route::delete('/jual/{book}', [JualController::class, 'destroy'])->name('jual.destroy');
    Route::post('/books/{book}/rate', [BerandaController::class, 'rate'])->name('books.rate');
});
Route::get('/beranda/recently-viewed', function () {
    if (!Auth::check()) return response()->json([]);

    $data = \App\Models\RecentlyViewed::with('book')
        ->where('user_id', Auth::id())
        ->latest()
        ->limit(5)
        ->get()
        ->pluck('book')
        ->filter()
        ->map(fn($b) => [
            'id'     => $b->id,
            'title'  => $b->title,
            'author' => $b->author,
            'image'  => $b->image,
            'price'  => $b->price,
        ])->values();

    return response()->json($data);
});
require __DIR__.'/auth.php';