<nav class="sticky top-0 bg-white/90 backdrop-blur-md border-b border-gray-100 z-50">

    <div class="w-full px-6 md:px-8 py-3.5 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('beranda') }}"
           class="flex items-center bg-gray-100 rounded-full pl-1.5 pr-4 py-1.5 space-x-2.5 hover:bg-gray-200 transition">

            <img src="/icon-images/logo.png"
                 alt="Logo"
                 class="w-8 h-8">

            <span class="font-bold text-gray-800 text-sm tracking-tight">
                BookaBuku
            </span>

        </a>

        <!-- Search -->
        <div class="flex items-center flex-1 max-w-xl mx-8 relative">

            <button class="absolute left-1.5 top-1/2 -translate-y-1/2">

                <img src="/icon-images/search.png"
                     alt="Search"
                     class="w-8 h-8">

            </button>

            <input type="text"
                   placeholder="Temukan buku yang anda inginkan"
                   class="w-full pl-12 pr-4 py-2.5 bg-gray-100 rounded-full text-sm">

        </div>

        <!-- Right Menu -->
        <div class="flex items-center space-x-4">

            <!-- Cart -->
            <a href="/cart"
               class="bg-gray-100 hover:bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center">

                <img src="/icon-images/cart.png"
                     alt="Cart"
                     class="w-5 h-5">

            </a>

            <!-- Notification -->
            <button class="bg-gray-100 hover:bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center">

                <img src="/icon-images/notification.png"
                     alt="Notification"
                     class="w-5 h-5">

            </button>

@auth

<div x-data="{ open: false }" class="relative">

    <!-- Tombol Profile -->
    <button
        @click="open = !open"
        class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-full transition">

        <div class="w-8 h-8 rounded-full bg-gray-300"></div>

        <span class="text-sm font-medium">
            {{ Auth::user()->name }}
        </span>

    </button>

    <!-- Dropdown -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg border border-gray-100 z-50">

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100 rounded-xl">

                Logout

            </button>
        </form>

    </div>

</div>

@else

<a href="{{ route('login') }}"
   class="bg-black text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-gray-800 transition">

    Masuk/Daftar

</a>

@endauth

        </div>

    </div>

</nav>