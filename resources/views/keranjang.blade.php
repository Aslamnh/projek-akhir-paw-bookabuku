@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mt-4 mb-0.5 text-center">
    My Cart
</h1>

<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- LEFT SIDE -->
        <div class="lg:col-span-3">

            <div class="bg-white rounded-2xl shadow p-5">

                <!-- Header -->
                <div class="grid grid-cols-4 border-b pb-4 font-semibold text-gray-700">
                    <div>Produk</div>
                    <div class="text-center">Harga Satuan</div>
                    <div class="text-center">Kuantitas</div>
                    <div class="text-right">Total Harga</div>
                </div>

                <!-- Cart Items -->
                @forelse($cartItems as $item)

                <div class="grid grid-cols-4 items-center py-5 border-b">

                    <!-- Produk -->
                    <div class="flex items-center gap-4">

                        <img src="{{ asset($item->book->image) }}"
                             alt="{{ $item->book->title }}"
                             class="w-16 h-20 object-cover rounded-lg">

                        <div>

                            <h3 class="font-semibold">
                                {{ $item->book->title }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $item->book->author }}
                            </p>

                        </div>

                    </div>

                    <!-- Harga -->
                    <div class="text-center">

                        Rp {{ number_format($item->book->price, 0, ',', '.') }}

                    </div>

                    <!-- Quantity -->
                    <div class="text-center">

                        {{ $item->quantity }}

                    </div>

                    <!-- Total + Delete -->
                    <div class="flex items-center justify-end gap-4">

                    <span class="font-semibold">

                     Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}

                    </span>

                    <form action="{{ route('cart.delete', $item->id) }}"
                      method="POST">

                       @csrf
                    @method('DELETE')

                    <button type="submit"
                class="text-red-500 hover:text-red-700 text-sm font-medium">

            Hapus

        </button>

    </form>

</div>

                </div>

                @empty

                <div class="py-16 text-center text-gray-400">

                    Keranjang masih kosong

                </div>

                @endforelse

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="lg:col-span-1">

            <div class="bg-white rounded-2xl shadow p-5 sticky top-6">

                <h2 class="text-xl font-bold mb-6">
                    Ringkasan Belanja
                </h2>

                @php
                    $totalBuku = $cartItems->sum('quantity');

                    $totalHarga = $cartItems->sum(function ($item) {
                        return $item->book->price * $item->quantity;
                    });
                @endphp

                <div class="space-y-4">

                    <div class="flex justify-between text-gray-600">

                        <span>Total Buku</span>

                        <span>{{ $totalBuku }}</span>

                    </div>

                    <div class="flex justify-between text-lg font-semibold">

                        <span>Total</span>

                        <span class="text-green-600">

                            Rp {{ number_format($totalHarga, 0, ',', '.') }}

                        </span>

                    </div>

                </div>

                <a href="{{ route('checkout') }}"
                   class="block w-full mt-6 bg-black hover:bg-zinc-800 text-white py-3 rounded-xl font-medium transition text-center">

                    Checkout

                </a>

            </div>

        </div>

    </div>

</div>

@endsection