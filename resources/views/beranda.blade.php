@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<header class="grid grid-cols-1 md:grid-cols-2 bg-black overflow-hidden">
    <div class="flex flex-col justify-center px-8 sm:px-12 lg:px-24 py-8 md:py-10 text-white bg-[#030303] relative z-10">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-5 uppercase text-white">
            Temukan Buku Baru<br>Tukar Ceritamu
        </h1>
        <div>
            <a href="{{ route('katalog') }}"
               class="inline-flex items-center justify-center bg-gray-200 text-black px-8 py-3 rounded-full font-bold text-sm hover:bg-white active:scale-95 transition-all duration-200 shadow-lg shadow-black/10">
                Mulai Cari Buku
            </a>
        </div>
    </div>
    <div class="relative overflow-hidden min-h-[220px] md:min-h-full">
        <img src="/book-images/beranda.png" alt="Background Buku" class="w-full h-full object-cover object-center">
    </div>
</header>

<!-- Sub-navigation -->
<div class="sticky top-[69px] border-b border-gray-200 bg-white/95 backdrop-blur-md z-40 shadow-sm">
    <div class="flex justify-center space-x-12 text-sm font-medium">
        <a href="{{ route('beranda') }}" class="py-4 text-black border-b-2 border-black font-bold transition duration-200">Beranda</a>
        <a href="{{ route('katalog') }}" class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">Katalog</a>
        <a href="{{ route('jual') }}"    class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">Jual</a>
    </div>
</div>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-6 md:px-8 py-12 min-h-[1000px]">
    <!-- Konten Beranda -->
</main>

@endsection