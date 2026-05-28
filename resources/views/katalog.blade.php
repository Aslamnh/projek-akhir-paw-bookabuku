@extends('layouts.app')

@section('content')
@include('layouts.subnav')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap');
        body {
            font-family: 'Public Sans', sans-serif;
            font-family: 'Public Sans', sans-serif;
            background-color: #f9fafb;
            color: #111827;
            margin: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Main Content */
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 48px 24px;
            min-height: 1000px;
        }
        @media (min-width: 768px) {
            .main-content { padding-left: 32px; padding-right: 32px; }
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }
        .katalog-title {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        .book-count {
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            background-color: #fff;
            padding: 4px 12px;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
        }

        /* Grid */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 24px;
        }
        @media (min-width: 640px) { .book-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 768px) { .book-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (min-width: 1024px) { .book-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); } }

        /* Book Card */
        .book-card {
            background-color: #f8f8f8;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        
        .book-cover-container {
            aspect-ratio: 1 / 1;
            width: 100%;
            background-color: #B85D2C;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
        }
        .book-image {
            height: 75%;
            object-fit: cover;
            filter: drop-shadow(0 20px 13px rgba(0,0,0,0.03)) drop-shadow(0 8px 5px rgba(0,0,0,0.08));
        }

        .hover-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0,0,0,0.4);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .book-card:hover .hover-overlay {
            opacity: 1;
        }
        .detail-btn {
            background-color: #fff;
            color: #000;
            padding: 8px 16px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        .detail-btn:hover { background-color: #f3f4f6; }

        .card-details {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .book-author {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .book-title {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 12px 0;
            line-height: 1.375;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .price-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 8px;
            border-top: 1px solid rgba(229,231,235,0.6);
        }
        .book-price {
            font-weight: 700;
            color: #111827;
            font-size: 14px;
        }
        .cart-btn {
            background-color: #f3f4f6;
            width: 28px;
            height: 28px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .cart-btn:hover { background-color: #e5e7eb; }
        .cart-icon {
            width: 14px;
            height: 14px;
            opacity: 0.6;
            transition: opacity 0.2s;
        }
        .cart-btn:hover .cart-icon {
            opacity: 1;
        }
        
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 48px 0;
            color: #6b7280;
        }

        /* Filter css */
        
        .content-layout {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        /* ── FILTER SIDEBAR ── */
        .filter-sidebar {
            flex-shrink: 0;
            width: 208px;
            background-color: #fff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 20px;
            position: sticky;
            top: 130px;
            max-height: calc(100vh - 160px);
            overflow-y: auto;
        }
        
        .filter-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .filter-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .filter-sidebar::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 20px;
        }

        .filter-header {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 16px 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filter-header svg { opacity: 0.5; }

        .filter-section {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f3f4f6;
        }
        .filter-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .filter-section-title {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .filter-section-title svg { opacity: 0.45; }

        .filter-all-btn {
            width: 100%;
            text-align: left;
            background-color: #111827;
            color: #fff;
            border: none;
            border-radius: 9999px;
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 14px;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .filter-all-btn:hover { background-color: #374151; }

        .filter-checkbox-list {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }
        .filter-checkbox-item {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 5px 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.15s;
        }
        .filter-checkbox-item:hover { background-color: #f9fafb; }
        .filter-checkbox-item input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 4px;
            flex-shrink: 0;
            cursor: pointer;
            position: relative;
        }
        .filter-checkbox-item input[type="checkbox"]:checked {
            background-color: #111827;
            border-color: #111827;
        }
        .filter-checkbox-item input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 1px;
            width: 5px;
            height: 9px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }
        .filter-checkbox-label {
            font-size: 13px;
            color: #374151;
            cursor: pointer;
            user-select: none;
        }

        .price-range-inputs {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .price-input-wrapper { flex: 1; }
        .price-input-label {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            margin-bottom: 4px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .price-input {
            width: 100%;
            padding: 7px 8px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 13px;
            color: #374151;
            outline: none;
            transition: all 0.2s;
            box-sizing: border-box;
        }
        .price-input:focus { border-color: #9ca3af; background-color: #fff; }
        .price-separator {
            font-size: 13px;
            color: #9ca3af;
            margin-top: 1.16px;
            flex-shrink: 0;
        }

        .filter-radio-list {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .filter-radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.15s;
        }
        .filter-radio-item:hover { background-color: #f9fafb; }
        .filter-radio-item input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 9999px;
            flex-shrink: 0;
            cursor: pointer;
            transition: all 0.15s;
            position: relative;
        }
        .filter-radio-item input[type="radio"]:checked {
            border-color: #111827;
            border-width: 4px;
            background-color: #111827;
            box-shadow: inset 0 0 0 2px #fff;
        }
        .filter-radio-label {
            font-size: 13px;
            color: #374151;
            cursor: pointer;
            user-select: none;
        }

        .filter-select {
            width: 100%;
            padding: 8px 12px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 13px;
            color: #374151;
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 32px;
            transition: all 0.2s;
            margin-bottom: 8px;
        }
        .filter-select:focus { border-color: #9ca3af; background-color: #fff; }

        .filter-actions {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }
        .filter-apply-btn {
            flex: 1;
            background-color: #111827;
            color: #fff;
            border: none;
            border-radius: 9999px;
            padding: 8px 0;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }
        .filter-apply-btn:hover { background-color: #374151; }
        .filter-apply-btn:active { transform: scale(0.97); }
        .filter-reset-btn {
            flex: 1;
            background-color: #f3f4f6;
            color: #374151;
            border: none;
            border-radius: 9999px;
            padding: 8px 0;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .filter-reset-btn:hover { background-color: #e5e7eb; }

        /* Book grid wrapper */
        .book-grid-wrapper {
            flex: 1;
            min-width: 0;
        }
    </style>



    <!-- Main Content -->
    <main class="main-content">
        <div class="header-container">
            <h2 class="katalog-title">Katalog Buku</h2>
            <span class="book-count">{{ count($books) }} Buku Tersedia</span>
        </div>

                <div class="content-layout">

            <aside class="filter-sidebar">
                <h3 class="filter-header">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filter
                </h3>

                <div class="filter-section">
                    <button class="filter-all-btn" onclick="resetFilter()">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                        Semua Produk
                    </button>
                </div>

                <div class="filter-section">
                    <p class="filter-section-title">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h7"/></svg>
                        Kategori
                    </p>
                    <div class="filter-checkbox-list">
                        <label class="filter-checkbox-item">
                            <input type="checkbox" name="kategori" value="novel">
                            <span class="filter-checkbox-label">Novel</span>
                        </label>
                        <label class="filter-checkbox-item">
                            <input type="checkbox" name="kategori" value="komik">
                            <span class="filter-checkbox-label">Komik</span>
                        </label>
                        <label class="filter-checkbox-item">
                            <input type="checkbox" name="kategori" value="edukasi">
                            <span class="filter-checkbox-label">Edukasi</span>
                        </label>
                        <label class="filter-checkbox-item">
                            <input type="checkbox" name="kategori" value="biografi">
                            <span class="filter-checkbox-label">Biografi</span>
                        </label>
                        <label class="filter-checkbox-item">
                            <input type="checkbox" name="kategori" value="teknologi">
                            <span class="filter-checkbox-label">Teknologi</span>
                        </label>
                    </div>
                </div>

                <div class="filter-section">
                    <p class="filter-section-title">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        Rentang Biaya
                    </p>
                    <div class="price-range-inputs">
                        <div class="price-input-wrapper">
                            <span class="price-input-label">Min</span>
                            <input type="number" id="price-min" class="price-input" placeholder="0" min="0">
                        </div>
                        <span class="price-separator">—</span>
                        <div class="price-input-wrapper">
                            <span class="price-input-label">Max</span>
                            <input type="number" id="price-max" class="price-input" placeholder="∞" min="0">
                        </div>
                    </div>
                </div>

                

                <div class="filter-section">
                    <p class="filter-section-title">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                        Urutkan
                    </p>
                    <select class="filter-select" id="sort-field">
                        <option value="">-- None --</option>
                        <option value="price">Harga</option>
                        <option value="title">Judul</option>
                        <option value="author">Penulis</option>
                    </select>
                    <div class="filter-radio-list">
                        <label class="filter-radio-item">
                            <input type="radio" name="sort_dir" value="asc" checked>
                            <span class="filter-radio-label">Ascending</span>
                        </label>
                        <label class="filter-radio-item">
                            <input type="radio" name="sort_dir" value="desc">
                            <span class="filter-radio-label">Descending</span>
                        </label>
                    </div>
                </div>

                <div class="filter-actions">
                    <button class="filter-apply-btn" onclick="applyFilter()">Terapkan</button>
                    <button class="filter-reset-btn" onclick="resetFilter()">Reset</button>
                </div>
            </aside>

            <div class="book-grid-wrapper">
                <div class="book-grid" id="book-grid">
                    @fragment('book-grid')
                    @forelse($books as $book)
                    <a href="{{ route('buku.show', $book->id) }}" class="book-card" 
                        data-price="{{ $book->price }}" 
                        data-title="{{ strtolower($book->title) }}" 
                        data-author="{{ strtolower($book->author) }}" 
                        data-kategori="{{ strtolower($book->category ?? 'novel') }}">
                        <div class="book-cover-container">
                            <img src="{{ asset($book->image ?? 'book-images/jual.png') }}" alt="{{ $book->title }}" class="book-image">
                            <div class="hover-overlay">
                                <span class="detail-btn">Lihat Detail</span>
                            </div>
                        </div>
                        
                        <div class="card-details">
                            <div class="book-author">{{ $book->author }}</div>
                            <h3 class="book-title">{{ $book->title }}</h3>
                            
                            <div class="price-container">
                                <span class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                <object><button class="cart-btn" title="Tambah ke Keranjang" onclick="event.preventDefault(); /* implement cart add */">
                                    <img src="{{ asset('icon-images/cart.png') }}" alt="Cart" class="cart-icon">
                                </button></object>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: #6b7280;"> 
                        Belum ada buku di katalog yang sesuai dengan filter Anda. 
                    </div>
                    @endforelse
                    @endfragment
                </div>
            </div>

        </div>
    </main>
    <script>
        async function applyFilter() {
            const checkedKategori = [...document.querySelectorAll('input[name="kategori"]:checked')].map(el => el.value.toLowerCase());
            const minPrice = document.getElementById('price-min').value;
            const maxPrice = document.getElementById('price-max').value;
            const sortField = document.getElementById('sort-field').value;
            const sortDir   = document.querySelector('input[name="sort_dir"]:checked')?.value || 'asc';

            let queryParts = [];

            if (checkedKategori.length > 0) {
                queryParts.push('kategori=' + checkedKategori.join(','));
            }
            if (minPrice) {
                queryParts.push('min_price=' + minPrice);
            }
            if (maxPrice) {
                queryParts.push('max_price=' + maxPrice);
            }
            if (sortField) {
                queryParts.push('sort_field=' + sortField);
            }
            queryParts.push('sort_dir=' + sortDir);

            let queryString = queryParts.join('&');

            // Fetch from backend
            fetch(`?${queryString}`, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
            .then(res => res.text())
            .then(html => {
                document.getElementById('book-grid').innerHTML = html;
            });
        }

        function resetFilter() {
            document.querySelectorAll('input[name="kategori"]').forEach(el => el.checked = false);
            document.getElementById('price-min').value = '';
            document.getElementById('price-max').value = '';
            document.getElementById('sort-field').value = '';
            document.querySelector('input[name="sort_dir"][value="asc"]').checked = true;
            applyFilter();
        }
    </script>
@endsection
