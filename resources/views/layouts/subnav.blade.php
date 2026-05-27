<div class="sticky top-[69px] border-b border-gray-200 bg-white/95 backdrop-blur-md z-40 transition-all duration-300 shadow-sm">
    <div class="flex justify-center space-x-12 text-sm font-medium">
        <a href="{{ route('beranda') }}" id="tab-beranda" 
           class="{{ request()->routeIs('beranda') ? 'py-4 text-black border-b-2 border-black font-bold transition duration-200' : 'py-4 text-gray-400 hover:text-black font-medium transition duration-200' }}">
            Beranda
        </a>
        <a href="{{ route('katalog') }}" id="tab-katalog" 
           class="{{ request()->routeIs('katalog') ? 'py-4 text-black border-b-2 border-black font-bold transition duration-200' : 'py-4 text-gray-400 hover:text-black font-medium transition duration-200' }}">
            Katalog
        </a>
        <a href="{{ route('jual') }}" id="tab-jual" 
           class="{{ request()->routeIs('jual') ? 'py-4 text-black border-b-2 border-black font-bold transition duration-200' : 'py-4 text-gray-400 hover:text-black font-medium transition duration-200' }}">
            Jual
        </a>
    </div>
</div>
