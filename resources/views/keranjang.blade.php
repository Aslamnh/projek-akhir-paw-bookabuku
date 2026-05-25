@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mt-4 mb-0.5 text-center">
    My Cart
</h1>

<div class="max-w-7xl mx-auto px-6 py-8">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Container Tabel Keranjang -->
        <div class="lg:col-span-3">

            <div class="bg-white rounded-2xl shadow p-5">

                <!-- Header Tabel -->
                <div class="grid grid-cols-4 border-b pb-4 font-semibold text-gray-700">
                    <div>Produk</div>
                    <div class="text-center">Harga Satuan</div>
                    <div class="text-center">Kuantitas</div>
                    <div class="text-right">Total Harga</div>
                </div>

            </div>

        </div>

        <!-- Container Summary -->
        <div class="lg:col-span-1">

            <div class="bg-white rounded-2xl shadow p-5 sticky top-6">

                <h2 class="text-xl font-bold mb-6">
                    Ringkasan Belanja
                </h2>

                <div class="space-y-4">

                    <div class="flex justify-between text-gray-600">
                        <span>Total Buku</span>
                        <span></span>
                    </div>

                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span class="text-green-600"></span>
                    </div>

                </div>

                <button class="w-full mt-6 bg-black hover:bg-zinc-800 text-white py-3 rounded-xl font-medium transition">
                    Checkout
                </button>

            </div>

        </div>

    </div>

</div>

@endsection