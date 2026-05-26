@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Title -->
   <h1 class="text-3xl font-bold mt-3 mb-5 text-center">
    Checkout
</h1>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- LEFT SIDE -->
        <div class="lg:col-span-3 space-y-6">

            <!-- Alamat -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-semibold mb-5">
                    Alamat Pengiriman
                </h2>

                <div class="border border-dashed border-gray-300 rounded-xl p-5 text-gray-400 text-sm">

                    Belum ada alamat dipilih

                </div>

            </div>

            <!-- Produk -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-semibold mb-5">
                    Produk
                </h2>

                <!-- Header Table -->
                <div class="grid grid-cols-4 border-b pb-4 font-semibold text-gray-700">

                    <div>Produk</div>

                    <div class="text-center">
                        Harga
                    </div>

                    <div class="text-center">
                        Jumlah
                    </div>

                    <div class="text-right">
                        Subtotal
                    </div>

                </div>

                <!-- Isi produk nanti -->

                <div class="py-16 text-center text-gray-400 text-sm">

                    Belum ada produk checkout

                </div>

            </div>

            <!-- Metode Pembayaran -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-semibold mb-5">
                    Metode Pembayaran
                </h2>

                <div class="space-y-3">

                    <button class="w-full border rounded-xl px-4 py-4 text-left hover:border-black transition">

                        Transfer Bank

                    </button>

                    <button class="w-full border rounded-xl px-4 py-4 text-left hover:border-black transition">

                        E-Wallet

                    </button>

                    <button class="w-full border rounded-xl px-4 py-4 text-left hover:border-black transition">

                        COD

                    </button>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="lg:col-span-1">

            <div class="bg-white rounded-2xl shadow p-6 sticky top-24">

                <h2 class="text-xl font-bold mb-6">
                    Ringkasan Pembayaran
                </h2>

                <div class="space-y-4">

                    <div class="flex justify-between text-gray-600">

                        <span>Total Produk</span>

                        <span></span>

                    </div>

                    <div class="flex justify-between text-gray-600">

                        <span>Ongkir</span>

                        <span></span>

                    </div>

                    <div class="border-t pt-4 flex justify-between text-lg font-bold">

                        <span>Total Bayar</span>

                        <span class="text-green-600"></span>

                    </div>

                </div>

                <button class="w-full mt-6 bg-black hover:bg-zinc-800 text-white py-3 rounded-xl font-medium transition">

                    Order

                </button>

            </div>

        </div>

    </div>

</div>

@endsection