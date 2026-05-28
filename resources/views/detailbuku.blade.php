@extends('layouts.app')

@section('content')

@include('layouts.subnav')
<style>

@import url('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap');


/* --- Base --- */
*,
*::before,
*::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Public sans', sans-serif;
    background-color: #f7f7f5;
    color: #1a1a1a;
    -webkit-font-smoothing: antialiased;
}

/* ============================================================
   Page Wrapper
   ============================================================ */
.product-page {
    min-height: 100vh;
    background-color: #f7f7f5;
    position: relative;
    padding: 40px 0 80px;
}

/* ============================================================
   Product Container (two-column layout)
   ============================================================ */
.product-container {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    gap: 0;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 32px;
    background-color: #ffffff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
    position: relative;
}

/* ============================================================
   Left Column – Gallery
   ============================================================ */
.gallery {
    flex: 0 0 420px;
    max-width: 420px;
    padding: 40px 32px 40px 0;
}

.gallery__main {
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 12px;
    overflow: hidden;
    background-color: #f0ede8;
}

.gallery__main-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ============================================================
   Vertical Divider
   ============================================================ */
.divider {
    flex: 0 0 1px;
    align-self: stretch;
    background-color: #e4e4e0;
    margin: 32px 0;
}

/* ============================================================
   Right Column – Product Info
   ============================================================ */
.info {
    flex: 1;
    min-width: 0;
    padding: 40px 0 100px 48px;
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Title */
.info__title {
    font-family: 'Public sans', sans-serif;
    font-size: 2rem;
    font-weight: 600;
    line-height: 1.2;
    color: #1a1a1a;
    letter-spacing: -0.02em;
    margin-bottom: 5px;
}

.info__meta-label {
    color: #4a4a4a;
    font-weight: 500;
}

/* Price */
.info__price {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    letter-spacing: -0.03em;
    margin-bottom: 24px;
}

/* ============================================================
   Seller Card
   ============================================================ */
.seller-card {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    border: 1px solid #e4e4e0;
    border-radius: 12px;
    padding: 18px 20px;
    max-width: 340px;
    margin-bottom: 32px;
    background-color: #ffffff;
}

.seller-card__avatar {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background-color: #e4e4e0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9a9a9a;
}

/* .seller-card__avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
} */



.seller-card__body {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.seller-card__name {
    font-weight: 600;
    font-size: 0.9375rem;
    color: #1a1a1a;
    line-height: 1.3;
}

.seller-card__online {
    font-size: 0.8125rem;
    color: #9a9a9a;
}

/* ============================================================
   Tabs
   ============================================================ */
.tabs {
    display: flex;
    gap: 0;
    border-bottom: 1px solid #e4e4e0;
    margin-bottom: 20px;
}

.tabs__btn {
    position: relative;
    padding: 10px 0;
    margin-right: 32px;
    background: none;
    border: none;
    font-family: 'Public sans', sans-serif;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #9a9a9a;
    cursor: pointer;
    transition: color 0.2s ease;
    white-space: nowrap;
}

.tabs__btn::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #1a1a1a;
    transform: scaleX(0);
    transition: transform 0.2s ease;
}

.tabs__btn--active {
    color: #1a1a1a;
    font-weight: 600;
}

.tabs__btn--active::after {
    transform: scaleX(1);
}

.tabs__btn:hover {
    color: #1a1a1a;
}

/* ============================================================
   Tab Content
   ============================================================ */
.tab-content {
    display: block;
}

.tab-content--hidden {
    display: none;
}

.tab-content__text {
    font-size: 0.9375rem;
    line-height: 1.75;
    color: #4a4a4a;
    max-width: 680px;
}

/* ============================================================
   Floating Cart Button (FAB)
   ============================================================ */
.cart-fab {
    position: absolute;
    bottom: 32px;
    right: 32px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #1a1a1a;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.22);
    text-decoration: none;
    z-index: 100;
}

.cart-fab__icon {
    width: 26px;
    height: 26px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}


/* ============================================================
   Responsive
   ============================================================ */
@media (max-width: 900px) {
    .product-container {
        flex-direction: column;
        padding: 24px 24px 100px 24px;
    }

    .gallery {
        flex: none;
        max-width: 100%;
        width: 100%;
        padding: 0 0 24px 0;
    }

    .divider {
        width: 100%;
        height: 1px;
        flex: none;
        align-self: auto;
        margin: 0 0 24px 0;
    }

    .info {
        padding: 0;
        width: 100%;
    }

    .info__title {
        font-size: 1.5rem;
    }

    .info__price {
        font-size: 1.625rem;
    }

    .seller-card {
        max-width: 100%;
    }
}

@media (max-width: 480px) {
    .product-page {
        padding: 16px 0 80px;
    }

    .product-container {
        margin: 0 12px;
        padding: 20px 20px 84px 20px;
        border-radius: 12px;
    }

    .info__title {
        font-size: 1.25rem;
    }

    .cart-fab {
        bottom: 20px;
        right: 20px;
        width: 52px;
        height: 52px;
    }

    .cart-fab__icon {
        width: 22px;
        height: 22px;
    }
}
.rating-badge { font-size: 11px; color: #6b7280; display: flex; align-items: center; gap: 3px; margin-bottom: 8px; }
</style>

<div class="product-page">
    <div class="product-container">

        {{-- LEFT: Image Gallery --}}
        <div class="gallery">
            <div class="gallery__main">
                <img
                    src="{{ asset($book->image ?? 'book-images/jual.png') }}"
                    alt="{{ $book->title ?? 'Judul Buku' }}"
                    class="gallery__main-img"
                />
            </div>
            
        </div>

        <div class="divider"></div>

        <div class="info">

            <h1 class="info__title">
                {{ $book->title ?? 'Judul Buku' }}
            </h1>
            <h2 class="info__meta-label">{{ $book->author ?? 'Penulis' }}</h2>
            <!-- <h2 class="info__meta-label">{{ $book->category ?? 'Kategori ' }}</h2> -->
            <!-- Rating average display -->
            <div class="rating-badge" id="rating-display-{{ $book->id }}">
                @if($book->rating !== null)
                @for($i = 1; $i <= 5; $i++)
                <svg width="11" height="11" fill="{{ $i <= round($book->rating) ? '#f59e0b' : '#e5e7eb' }}" viewBox="0 0 24 24">
                    <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                </svg>
                @endfor
                <span id="rating-number-{{ $book->id }}">{{ number_format($book->rating, 1) }}</span>
                @else
                <span id="rating-number-{{ $book->id }}" style="font-style:italic; color:#d1d5db; font-size:11px;">Belum dirating</span>
                    @endif
                </div>
            <p class="info__meta-label"><br>Harga:</p>
            <p class="info__price">Rp. {{ number_format($book->price ?? 50000, 0, ',', '.') }}</p>

            <div class="seller-card">
                <div class="seller-card__avatar">
                    <img src="{{ !empty($book->seller?->avatar) ? $book->seller->avatar : asset('icon-images/profile.png') }}" alt="{{ $book->seller?->name ?? 'Profile' }}" />
                </div>
                <div class="seller-card__body">
                    <span class="seller-card__name:">
                        {{ $book->user?->name ?? 'Unknown' }}
                    </span>
                    <span class="seller-card__online">
                        Penjual Buku
                    </span>
                </div>
            </div>
            <div class="tabs">
                <button class="tabs__btn tabs__btn--active" data-tab="deskripsi">
                    Deskripsi Produk
                </button>
            </div>

            <div class="tab-content" id="tab-deskripsi">
                <p class="tab-content__text">Kategori: {{ $book->category ?? 'Kategori' }}<br></p>
                <p class="tab-content__text">
                    {{ $book->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' }}
                </p>
            </div>

            
        </div>

        @auth

        <form action="{{ route('cart.add', $book->id) }}"
             method="POST">

         @csrf

         <button type="submit"
            class="cart-fab"
            title="Tambah ke Keranjang">

             <img src="{{ asset('icon-images/cart.png') }}"
             alt="Cart"
             class="cart-fab__icon">

          </button>

        </form>
@else

<button type="button"
        onclick="openAuthModal()"
        class="cart-fab"
        title="Login terlebih dahulu">

    <img src="{{ asset('icon-images/cart.png') }}"
         alt="Cart"
         class="cart-fab__icon">

</button>

@endauth

        </a>
    </div>
</div>
    @if(session('cart_success'))
    <script>
    document.addEventListener('DOMContentLoaded', () => {openCartModal();});
</script>

@endif

@endsection

