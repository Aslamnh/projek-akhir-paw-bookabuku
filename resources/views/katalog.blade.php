<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookaBuku - Katalog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen">

    <!-- Top Navigation bar -->
    <nav class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-100 z-50 transition-all duration-300">
        <div class="w-full px-6 md:px-8 py-3.5 flex items-center justify-between">
            <!-- Logo  -->
            <a href="#" class="flex items-center bg-gray-100 rounded-full pl-1.5 pr-4 py-1.5 space-x-2.5 hover:bg-gray-200 transition duration-200 group">
                <img src="/icon-images/logo.png" alt="Logo" class = "w-8 h-8">
                <span class="font-bold text-gray-800 text-sm tracking-tight">BookaBuku</span>
            </a>

            <!-- Search Bar -->
            <div class="flex items-center flex-1 max-w-xl mx-8 relative">
                <button class="absolute left-1.5 top-1/2 -translate-y-1/2 flex items-center justify-center cursor-pointer hover:bg-gray-850 transition">
                    <img src="/icon-images/search.png" alt="Search" class="w-8 h-8">
                </button>
                <input type="text" placeholder="Temukan buku yang anda inginkan" 
                    class="w-full pl-12 pr-4 py-2.5 bg-gray-100 rounded-full text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/10 focus:bg-gray-50 border-none transition duration-200">
            </div>

            <!-- Keranjang, Notifikasi, dan Auth -->
            <div class="flex items-center space-x-4">
                <!-- Cart Button -->
                <button class="bg-gray-100 hover:bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center transition duration-200 group" title="Keranjang">
                    <img src="/icon-images/cart.png" alt="Cart" class="w-5 h-5">
                </button>

                <!-- Notification Button -->
                <button class="bg-gray-100 hover:bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center transition duration-200 group" title="Notifikasi">
                    <img src="/icon-images/notification.png" alt="Notification" class="w-5 h-5">
                </button>
                
                <a href="{{ route('login') }}" class="bg-black text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-gray-850 transition duration-200 active:scale-95">
                    Masuk/Daftar
                </a>
            </div>
        </div>
    </nav>

    <!-- Sub-navigation -->
    <div class="sticky top-[69px] border-b border-gray-200 bg-white/95 backdrop-blur-md z-40 transition-all duration-300 shadow-sm">
        <div class="flex justify-center space-x-12 text-sm font-medium">
            <a href="{{ route('beranda') }}" id="tab-beranda" class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">
                Beranda
            </a>
            <a href="{{ route('katalog') }}" id="tab-katalog" class="py-4 text-black border-b-2 border-black font-bold transition duration-200">
                Katalog
            </a>
            <a href="{{ route('jual') }}" id="tab-jual" class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">
                Jual
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 md:px-8 py-12 min-h-[1000px]">
        <!-- Konten Katalog akan ditambahkan di sini -->
    </main>

</body>
</html>
