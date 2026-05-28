@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto px-6 py-10">

    <div class="bg-white rounded-2xl shadow p-8">

        <h1 class="text-3xl font-bold text-center mb-8">
            Payment
        </h1>

        <div class="space-y-5">

            <!-- Payment ID -->
            <div class="flex justify-between border-b pb-4">

                <span class="text-gray-500">
                    ID Pembayaran
                </span>

                <span class="font-semibold">
                    {{ $order->payment_id }}
                </span>

            </div>

            <!-- Payment Method -->
            <div class="flex justify-between border-b pb-4">

                <span class="text-gray-500">
                    Metode Pembayaran
                </span>

                <span class="font-semibold uppercase">
                    {{ $order->payment_method }}
                </span>

            </div>

            <!-- Payment Code -->
            <div class="flex justify-between border-b pb-4">

                <span class="text-gray-500">
                    Kode Pembayaran
                </span>

                <span class="font-bold text-xl tracking-widest">
                    {{ $order->payment_code }}
                </span>

            </div>

            <!-- Total -->
            <div class="flex justify-between border-b pb-4">

                <span class="text-gray-500">
                    Total Bayar
                </span>

                <span class="font-bold text-green-600 text-xl">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>

            </div>

            <!-- Status -->
            <div class="flex justify-between">

                <span class="text-gray-500">
                    Status Pembayaran
                </span>

                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                    {{ $order->payment_status }}
                </span>

            </div>

        </div>

        {{-- COD --}}
        @if($order->payment_method == 'cod')

        <div class="mt-8 bg-orange-50 border border-orange-200 rounded-xl p-5">

            <h2 class="font-semibold text-orange-700 mb-2">
                Cash On Delivery
            </h2>

            <p class="text-sm text-orange-600">
                Silakan siapkan uang sesuai total pembayaran saat pesanan tiba.
            </p>

        </div>

        @else

        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-5">

            <h2 class="font-semibold text-blue-700 mb-2">
                Instruksi Pembayaran
            </h2>

            <p class="text-sm text-blue-600">
                Gunakan kode pembayaran di atas untuk menyelesaikan pembayaran.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection