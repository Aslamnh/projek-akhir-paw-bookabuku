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
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-semibold mb-5">
                    Alamat Pengiriman
                    </h2>
                <div class="border border-dashed border-gray-300 rounded-xl p-5 text-gray-400 text-sm">
                <textarea
                name="shipping_address"
                form="checkout-form"
                rows="3"
                placeholder="Masukkan alamat lengkap..."
                class="w-full border border-gray-300 rounded-xl p-4 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-black/10 text-black placeholder:text-gray-400"></textarea>
                </div>
        </div>
    </div>

            <!-- Produk -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-semibold mb-5">
                    Produk Checkout
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

                <!-- Isi Produk -->
                @forelse($cartItems as $item)

                <div class="grid grid-cols-4 items-center py-5 border-b">

                    <!-- Produk -->
                    <div>
                        <h3 class="font-semibold">
                            {{ $item->book->title }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $item->book->author }}
                        </p>
                    </div>

                    <!-- Harga -->
                    <div class="text-center">
                        Rp {{ number_format($item->book->price, 0, ',', '.') }}
                    </div>

                    <!-- Quantity -->
                    <div class="text-center">
                        {{ $item->quantity }}
                    </div>

                    <!-- Subtotal -->
                    <div class="text-right font-semibold">
                        Rp {{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}
                    </div>

                </div>

                @empty

                <div class="py-16 text-center text-gray-400 text-sm">

                    Belum ada produk checkout

                </div>

                @endforelse

            </div>

            <!-- Metode Pembayaran -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-semibold mb-5">
                    Metode Pembayaran
                </h2>

                <div class="space-y-3">

                    <label class="block">

    <input type="radio"
           name="payment_method"
           value="bank"
           class="hidden peer">

    <div class="w-full border rounded-xl px-4 py-4 flex items-center justify-between cursor-pointer transition
                peer-checked:border-black
                peer-checked:bg-gray-100">

        <h3 class="font-medium">
            Transfer Bank
        </h3>

        <div class="flex items-center gap-2">

            <img src="{{ asset('payment-images/bca.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/bri.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/bsi.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/bni.jpg') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/mandiri.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

        </div>

    </div>

</label>

                    <label class="block">

    <input type="radio"
           name="payment_method"
           value="bank"
           class="hidden peer">

    <div class="w-full border rounded-xl px-4 py-4 flex items-center justify-between cursor-pointer transition peer-checked:border-black peer-checked:bg-gray-100">

        <h3 class="font-medium">
            E-Wallet
        </h3>

        <div class="flex items-center gap-2">

            <img src="{{ asset('payment-images/ovo.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/Shopeepay.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/gopay.jpg') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

            <img src="{{ asset('payment-images/dana.png') }}"
                 class="w-10 h-10 object-contain bg-white p-0.5">

        </div>

    </div>

</label>
<label class="block mt-3">

    <input type="radio"
           name="payment_method"
           value="cod"
           class="hidden peer">

    <div class="w-full border rounded-xl px-4 py-4 cursor-pointer transition peer-checked:border-black peer-checked:bg-gray-100">
        <h3 class="font-medium">
            COD
        </h3>

    </div>

</label>
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

                        <span>
                            {{ $cartItems->sum('quantity') }}
                        </span>

                    </div>

                    <div class="flex justify-between text-gray-600">

                        <span>Ongkir</span>

                        <span>
                            Rp {{ number_format($shippingCost, 0, ',', '.') }}
                        </span>

                    </div>

                    <div class="border-t pt-4 flex justify-between text-lg font-bold">

                        <span>Total Bayar</span>

                        <span class="text-green-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

                <!-- Order Button -->
                <form action="{{ route('checkout.process') }}"
                      method="POST">

                    @csrf

                    <button type="submit"
                            class="w-full mt-6 bg-black hover:bg-zinc-800 text-white py-3 rounded-xl font-medium transition">

                        Order

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection