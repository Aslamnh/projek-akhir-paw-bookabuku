@extends('layouts.app')

@section('content')

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

<div class="sticky top-[69px] border-b border-gray-200 bg-white/95 backdrop-blur-md z-40 shadow-sm">
    <div class="flex justify-center space-x-12 text-sm font-medium">
        <a href="{{ route('beranda') }}" class="py-4 text-black border-b-2 border-black font-bold transition duration-200">Beranda</a>
        <a href="{{ route('katalog') }}" class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">Katalog</a>
        <a href="{{ route('jual') }}"    class="py-4 text-gray-400 hover:text-black font-medium transition duration-200">Jual</a>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap');
    body { font-family: 'Public Sans', sans-serif; background-color: #f9fafb; color: #111827; }
    .book-card { background-color: #f8f8f8; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; cursor: pointer; text-decoration: none; color: inherit; }
    .book-cover-container { aspect-ratio: 1/1; width: 100%; background-color: #B85D2C; display: flex; align-items: center; justify-content: center; padding: 24px; position: relative; }
    .book-image { height: 75%; object-fit: cover; filter: drop-shadow(0 20px 13px rgba(0,0,0,0.03)) drop-shadow(0 8px 5px rgba(0,0,0,0.08)); }
    .hover-overlay { position: absolute; inset: 0; background-color: rgba(0,0,0,0.4); opacity: 0; display: flex; align-items: center; justify-content: center; transition: opacity 0.2s; }
    .book-card:hover .hover-overlay { opacity: 1; }
    .detail-btn { background-color: #fff; color: #000; padding: 8px 16px; border-radius: 9999px; font-size: 14px; font-weight: 600; }
    .card-details { padding: 16px; display: flex; flex-direction: column; flex-grow: 1; }
    .book-author { font-size: 12px; color: #6b7280; margin-bottom: 4px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; }
    .book-title { font-size: 14px; font-weight: 700; color: #111827; margin: 0 0 8px 0; line-height: 1.375; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .rating-badge { font-size: 11px; color: #6b7280; display: flex; align-items: center; gap: 3px; margin-bottom: 8px; }
    .price-container { display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 8px; border-top: 1px solid rgba(229,231,235,0.6); }
    .book-price { font-weight: 700; color: #111827; font-size: 14px; }
    .cart-btn { background-color: #f3f4f6; width: 28px; height: 28px; border-radius: 9999px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: background-color 0.2s; }
    .cart-btn:hover { background-color: #e5e7eb; }
    .cart-icon { width: 14px; height: 14px; opacity: 0.6; transition: opacity 0.2s; }
    .cart-btn:hover .cart-icon { opacity: 1; }
    .sidebar-card { background: #fff; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden; }
    .sidebar-card-header { padding: 12px 16px; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 700; color: #111827; }
    .sidebar-book-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-bottom: 1px solid #f9fafb; text-decoration: none; color: inherit; transition: background-color 0.15s; }
    .sidebar-book-item:last-child { border-bottom: none; }
    .sidebar-book-item:hover { background-color: #f9fafb; }
    .sidebar-cover { width: 40px; height: 56px; border-radius: 6px; overflow: hidden; flex-shrink: 0; background-color: #B85D2C; display: flex; align-items: center; justify-content: center; padding: 4px; }
    .sidebar-cover img { height: 100%; object-fit: cover; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15)); }
    .sidebar-book-title { font-size: 12px; font-weight: 600; color: #111827; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 2px; }
    .sidebar-book-author { font-size: 11px; color: #9ca3af; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 3px; }
    .sidebar-stars { display: flex; align-items: center; gap: 2px; }
    .sidebar-empty { padding: 24px 16px; text-align: center; font-size: 12px; color: #9ca3af; font-style: italic; }
</style>

<main style="max-width:1280px; margin:0 auto; padding:40px 24px; min-height:1000px;">
    <div style="display:flex; gap:32px; align-items:flex-start;">

        <!-- Kolom Kiri -->
        <section style="flex:1; min-width:0;">
            <h2 style="font-size:20px; font-weight:700; color:#111827; margin:0 0 24px 0;">Semua Buku</h2>

            <div style="display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:20px;">
                @forelse($books as $book)
                @php $userRating = $userRatings[$book->id] ?? 0; @endphp
                <div class="book-card">
                    <a href="{{ route('buku.show', $book->id) }}" style="display:block;">
                        <div class="book-cover-container">
                            <img src="{{ asset($book->image ?? 'book-images/jual.png') }}" alt="{{ $book->title }}" class="book-image">
                            <div class="hover-overlay">
                                <span class="detail-btn">Lihat Detail</span>
                            </div>
                        </div>
                    </a>

                    <div class="card-details">
                        <div class="book-author">{{ $book->author }}</div>
                        <h3 class="book-title">{{ $book->title }}</h3>

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

                        <div class="price-container">
                            <span class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</span>

                            @auth
                            <object>
                                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="cart-btn" title="Tambah ke Keranjang">
                                        <img src="{{ asset('icon-images/cart.png') }}" alt="Cart" class="cart-icon">
                                    </button>
                                </form>
                            </object>
                            @else
                            <object>
                                <button type="button" class="cart-btn"
                                        onclick="event.preventDefault(); document.getElementById('modal-auth').classList.remove('hidden')"
                                        title="Login terlebih dahulu">
                                    <img src="{{ asset('icon-images/cart.png') }}" alt="Cart" class="cart-icon">
                                </button>
                            </object>
                            @endauth
                        </div>

                        @auth
                        <div style="margin-top:8px; padding-top:8px; border-top:1px solid #f3f4f6;">
                            <p style="font-size:10px; color:#9ca3af; margin:0 0 4px 0;">Rating kamu:</p>
                            <div class="star-rating" style="display:flex; gap:2px;"
                                 data-book-id="{{ $book->id }}"
                                 data-current="{{ $userRating }}">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" class="star-btn" data-value="{{ $i }}"
                                        style="width:18px; height:18px; background:none; border:none; cursor:pointer; padding:0;">
                                    <svg fill="{{ $i <= $userRating ? '#f59e0b' : '#e5e7eb' }}"
                                         viewBox="0 0 24 24" style="width:100%; height:100%; transition:transform 0.1s;">
                                        <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                    </svg>
                                </button>
                                @endfor
                            </div>
                        </div>
                        @endauth

                        @guest
                        <div style="margin-top:8px; padding-top:8px; border-top:1px solid #f3f4f6;">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('modal-auth').classList.remove('hidden')"
                               style="font-size:10px; color:#60a5fa; cursor:pointer;">
                                Login untuk memberi rating
                            </a>
                        </div>
                        @endguest
                    </div>
                </div>
                @empty
                <div style="grid-column:1/-1; text-align:center; padding:64px 0; color:#9ca3af;">
                    Belum ada buku tersedia.
                </div>
                @endforelse
            </div>

            <div style="margin-top:32px;">{{ $books->links() }}</div>
        </section>

        <!-- Sidebar Kanan -->
        <aside style="width:272px; flex-shrink:0; display:flex; flex-direction:column; gap:20px; position:sticky; top:130px;">

            <!-- Rekomendasi -->
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <svg width="14" height="14" fill="#f59e0b" viewBox="0 0 24 24">
                        <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                    </svg>
                    Rekomendasi Teratas
                </div>
                <div id="top-rated-list">
                    @forelse($topRated as $index => $book)
                    <a href="{{ route('buku.show', $book->id) }}" class="sidebar-book-item">
                        <span style="font-size:11px; font-weight:900; width:16px; text-align:center; color:{{ $index === 0 ? '#f59e0b' : '#d1d5db' }}; flex-shrink:0;">
                            #{{ $index + 1 }}
                        </span>
                        <div class="sidebar-cover">
                            <img src="{{ asset($book->image ?? 'book-images/jual.png') }}" alt="{{ $book->title }}">
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="sidebar-book-title">{{ $book->title }}</div>
                            <div class="sidebar-book-author">{{ $book->author }}</div>
                            <div class="sidebar-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg width="9" height="9" fill="{{ $i <= round($book->rating) ? '#f59e0b' : '#e5e7eb' }}" viewBox="0 0 24 24">
                                        <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                    </svg>
                                @endfor
                                <span style="font-size:10px; color:#6b7280; margin-left:2px;">{{ number_format($book->rating, 1) }}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="sidebar-empty">Belum ada buku dengan rating.</div>
                    @endforelse
                </div>
            </div>

            <!-- Terakhir Dilihat -->
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <svg width="14" height="14" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Terakhir Dilihat
                </div>

                @auth
                <div class="" id="recently-viewed-list">
                    @forelse($recentlyViewed as $book)
                    <a href="{{ route('buku.show', $book->id) }}" class="sidebar-book-item">
                        <div class="sidebar-cover">
                            <img src="{{ asset($book->image ?? 'book-images/jual.png') }}" alt="{{ $book->title }}">
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="sidebar-book-title">{{ $book->title }}</div>
                            <div class="sidebar-book-author">{{ $book->author }}</div>
                            <div style="font-size:11px; font-weight:600; color:#374151;">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="sidebar-empty">Belum ada buku yang dilihat.</div>
                    @endforelse
                </div>
                @else
                <div class="sidebar-empty">
                    <p style="margin:0 0 8px 0;">Login untuk melihat riwayat.</p>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('modal-auth').classList.remove('hidden')"
                       style="font-size:12px; font-weight:600; color:#111827; cursor:pointer;">
                        Masuk sekarang →
                    </a>
                </div>
                @endauth
            </div>

        </aside>
    </div>
</main>

<script>
async function refreshRecentlyViewed() {
    const res  = await fetch('/beranda/recently-viewed', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const data = await res.json();
    const list = document.getElementById('recently-viewed-list');
    if (!list) return;

    if (!data.length) {
        list.innerHTML = `<div class="sidebar-empty">Belum ada buku yang dilihat.</div>`;
        return;
    }

    list.innerHTML = data.map(book => `
        <a href="/buku/${book.id}" class="sidebar-book-item">
            <div class="sidebar-cover">
                <img src="${book.image ? '/' + book.image : '/book-images/jual.png'}" alt="${book.title}">
            </div>
            <div style="flex:1; min-width:0;">
                <div class="sidebar-book-title">${book.title}</div>
                <div class="sidebar-book-author">${book.author}</div>
                <div style="font-size:11px; font-weight:600; color:#374151;">
                    Rp ${parseInt(book.price).toLocaleString('id-ID')}
                </div>
            </div>
        </a>
    `).join('');
}

// Refresh saat user balik ke tab ini
document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') refreshRecentlyViewed();
});
const STAR_PATH = "M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z";

function buildStarSvg(size, filled) {
    return `<svg width="${size}" height="${size}" fill="${filled ? '#f59e0b' : '#e5e7eb'}" viewBox="0 0 24 24"><path d="${STAR_PATH}"/></svg>`;
}

function buildRatingDisplay(avg) {
    const rounded = Math.round(avg);
    let html = '';
    for (let i = 1; i <= 5; i++) html += buildStarSvg(11, i <= rounded);
    html += `<span id="rating-number-temp">${parseFloat(avg).toFixed(1)}</span>`;
    return html;
}

function buildTopRatedList(topRated) {
    if (!topRated.length) {
        return `<div class="sidebar-empty">Belum ada buku dengan rating.</div>`;
    }
    return topRated.map((book, index) => {
        const rounded = Math.round(book.rating);
        const stars   = Array.from({length: 5}, (_, i) => buildStarSvg(9, i + 1 <= rounded)).join('');
        const imgSrc = book.image ? `/${book.image}` : `/book-images/jual.png`;
        return `
        <a href="/buku/${book.id}" class="sidebar-book-item">
            <span style="font-size:11px;font-weight:900;width:16px;text-align:center;color:${index === 0 ? '#f59e0b' : '#d1d5db'};flex-shrink:0;">#${index + 1}</span>
            <div class="sidebar-cover"><img src="${imgSrc}" alt="${book.title}"></div>
            <div style="flex:1;min-width:0;">
                <div class="sidebar-book-title">${book.title}</div>
                <div class="sidebar-book-author">${book.author}</div>
                <div class="sidebar-stars">${stars}<span style="font-size:10px;color:#6b7280;margin-left:2px;">${parseFloat(book.rating).toFixed(1)}</span></div>
            </div>
        </a>`;
    }).join('');
}

document.addEventListener('DOMContentLoaded', () => {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

    document.querySelectorAll('.star-rating').forEach(container => {
        const bookId  = container.dataset.bookId;
        const buttons = container.querySelectorAll('.star-btn');
        let current   = parseFloat(container.dataset.current) || 0;

        const highlight = (upTo) => {
            buttons.forEach(btn => {
                btn.querySelector('svg').setAttribute('fill', btn.dataset.value <= upTo ? '#f59e0b' : '#e5e7eb');
            });
        };

        buttons.forEach(btn => {
            btn.addEventListener('mouseenter', () => highlight(btn.dataset.value));
            btn.addEventListener('mouseleave', () => highlight(current));
            btn.addEventListener('click', async () => {
                const value = parseFloat(btn.dataset.value);
                try {
                    const res  = await fetch(`/books/${bookId}/rate`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                        body: JSON.stringify({ rating: value }),
                    });
                    const data = await res.json();
                    if (data.success) {
                        current = value;
                        highlight(current);
                        container.dataset.current = current;

                        // Update rating badge di card (average semua user)
                        const display = document.getElementById(`rating-display-${bookId}`);
                        if (display) display.innerHTML = buildRatingDisplay(data.new_average);

                        // Update sidebar top rated
                        const topList = document.getElementById('top-rated-list');
                        if (topList) topList.innerHTML = buildTopRatedList(data.top_rated);

                        showToast(`Rating ${value} ⭐ disimpan! Rata-rata: ${parseFloat(data.new_average).toFixed(1)}`);
                    }
                } catch {
                    showToast('Gagal menyimpan rating.', true);
                }
            });
        });
    });
});

function showToast(msg, isError = false) {
    const t = document.createElement('div');
    t.textContent = msg;
    t.style.cssText = `position:fixed;bottom:24px;right:24px;z-index:9999;padding:10px 18px;border-radius:12px;font-size:13px;font-weight:500;color:#fff;background:${isError ? '#ef4444' : '#111827'};box-shadow:0 4px 12px rgba(0,0,0,0.15);transition:opacity 0.3s;`;
    document.body.appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }, 2500);
}
</script>

@endsection