<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookaBuku - Jual</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Custom scrollbar to match premium feel */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen">

    <!-- Sticky Navbar -->
    <nav class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-100 z-50 transition-all duration-300">
        <div class="w-full px-6 md:px-8 py-3.5 flex items-center justify-between">
            <!-- Left: Logo Badge -->
            <a href="{{ route('beranda') }}" class="flex items-center bg-gray-100 rounded-full pl-1.5 pr-4 py-1.5 space-x-2.5 hover:bg-gray-200 transition duration-200 group">
                <div class="bg-black text-white w-8 h-8 rounded-full flex items-center justify-center group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-book-open text-xs"></i>
                </div>
                <span class="font-bold text-gray-800 text-sm tracking-tight">BookaBuku</span>
            </a>

            <!-- Center: Search Bar -->
            <div class="flex items-center flex-1 max-w-xl mx-8 relative">
                <div class="absolute left-1.5 top-1/2 -translate-y-1/2 text-white bg-black rounded-full w-8 h-8 flex items-center justify-center cursor-pointer hover:bg-gray-855 transition">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" placeholder="Temukan buku yang anda inginkan" 
                    class="w-full pl-12 pr-4 py-2.5 bg-gray-100 rounded-full text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-black/10 focus:bg-gray-50 border-none transition duration-200">
            </div>

            <!-- Right: Action Icons & Auth -->
            <div class="flex items-center space-x-4">
                <!-- Cart Icon -->
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-10 h-10 rounded-full flex items-center justify-center transition duration-200 group" title="Keranjang">
                    <i class="fa-solid fa-cart-shopping text-base"></i>
                </button>

                <!-- Notifications -->
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-10 h-10 rounded-full flex items-center justify-center transition duration-200 group" title="Notifikasi">
                    <i class="fa-solid fa-bell text-base"></i>
                </button>
                
                <a href="{{ route('login') }}" class="bg-black text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-gray-855 transition duration-200 active:scale-95">
                    Masuk/Daftar
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="grid grid-cols-1 md:grid-cols-2 bg-black overflow-hidden">
        <!-- Hero Text -->
        <div class="flex flex-col justify-center px-8 sm:px-12 lg:px-24 py-8 md:py-10 text-white bg-[#030303] relative z-10">
            <!-- Subtle gradient background element -->
            <div class="absolute inset-0 bg-gradient-to-tr from-black via-transparent to-white/5 opacity-40 pointer-events-none"></div>
            
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-5 uppercase relative z-10 text-white">
                Temukan Buku Baru<br>
                Tukar Ceritamu
            </h1>
            <div class="relative z-10">
                <a href="{{ route('katalog') }}" id="btn-start-search" class="inline-flex items-center justify-center bg-gray-200 text-black px-8 py-3 rounded-full font-bold text-sm hover:bg-white active:scale-95 transition-all duration-200 shadow-lg shadow-black/10">
                    Mulai Cari Buku
                </a>
            </div>
        </div>

        <!-- Hero Image -->
        <div class="relative overflow-hidden min-h-[220px] md:min-h-full">
            <img src="/book-images/jual.png" 
                alt="Background Buku" 
                class="w-full h-full object-cover object-center">
        </div>
    </header>

    <!-- Sub-navigation Tabs (Sticky under Navbar) -->
    <div class="sticky top-[69px] border-b border-gray-200 bg-white/95 backdrop-blur-md z-40 transition-all duration-300 shadow-sm">
        <div class="flex justify-center space-x-12 text-sm font-medium">
            <a href="{{ route('beranda') }}" id="tab-beranda" class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">
                Beranda
            </a>
            <a href="{{ route('katalog') }}" id="tab-katalog" class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">
                Katalog
            </a>
            <a href="{{ route('jual') }}" id="tab-jual" class="py-4 text-black border-b-2 border-black font-bold transition duration-200">
                Jual
            </a>
        </div>
    </div>

    <!-- MAIN SCROLLABLE CONTENT -->
    <main class="max-w-7xl mx-auto px-6 md:px-8 py-12 min-h-[1000px]">
        <!-- Konten Jual akan ditambahkan di sini -->
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-12 mt-24">
        <div class="w-full px-6 md:px-8 flex flex-col md:flex-row items-center justify-between text-gray-400 text-xs gap-4">
            <div class="flex items-center space-x-2">
                <div class="bg-black text-white p-1.5 rounded-full flex items-center justify-center w-6 h-6">
                    <i class="fa-solid fa-book-open text-[10px]"></i>
                </div>
                <span class="font-bold text-gray-800 tracking-tight">BookaBuku</span>
            </div>
            <p>&copy; 2026 BookaBuku. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
