<div id="cart-success-modal"
     class="hidden fixed inset-0 z-50 flex items-center justify-center">

    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative bg-white rounded-2xl p-6 w-[380px] shadow-2xl">

        <h2 class="text-xl font-bold mb-2">
            Berhasil Ditambahkan
        </h2>

        <p class="text-gray-500 mb-6">
            Buku berhasil masuk ke keranjang.
        </p>

        <div class="flex gap-3">

            <button onclick="closeCartModal()"
                    class="flex-1 border rounded-xl py-3">

                Lanjut Belanja

            </button>

            <a href="{{ route('cart') }}"
               class="flex-1 bg-black text-white rounded-xl py-3 text-center">

                Lihat Keranjang

            </a>

        </div>

    </div>

</div>
<script>

function openCartModal() {
    document.getElementById('cart-success-modal')
        .classList.remove('hidden');
}

function closeCartModal() {
    document.getElementById('cart-success-modal')
        .classList.add('hidden');
}

</script>