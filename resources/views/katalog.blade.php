<!DOCTYPE html>
<html lang="id">
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
            background-color: #f9fafb;
            color: #111827;
            margin: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #f3f4f6;
            z-index: 50;
            transition: all 0.3s;
        }
        .navbar-content {
            width: 100%;
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        @media (min-width: 768px) {
            .navbar-content { padding-left: 2rem; padding-right: 2rem; }
        }

        .logo-link {
            display: flex;
            align-items: center;
            background-color: #f3f4f6;
            border-radius: 9999px;
            padding: 0.375rem 1rem 0.375rem 0.375rem;
            gap: 0.625rem;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .logo-link:hover { background-color: #e5e7eb; }
        .logo-img { width: 2rem; height: 2rem; }
        .logo-text { font-weight: 700; color: #1f2937; font-size: 0.875rem; letter-spacing: -0.025em; }

        .search-container {
            display: flex;
            align-items: center;
            flex: 1;
            max-width: 36rem;
            margin: 0 2rem;
            position: relative;
        }
        .search-btn {
            position: absolute;
            left: 0.375rem;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            background: none;
        }
        .search-icon { width: 2rem; height: 2rem; }
        .search-input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 3rem;
            background-color: #f3f4f6;
            border-radius: 9999px;
            font-size: 0.875rem;
            color: #374151;
            border: none;
            outline: none;
            transition: all 0.2s;
        }
        .search-input:focus {
            box-shadow: 0 0 0 2px rgba(0,0,0,0.1);
            background-color: #f9fafb;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .icon-btn {
            background-color: #f3f4f6;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
            border: none;
            cursor: pointer;
        }
        .icon-btn:hover { background-color: #e5e7eb; }
        .icon-img { width: 1.25rem; height: 1.25rem; }
        
        .login-btn {
            background-color: #000;
            color: #fff;
            padding: 0.625rem 1.5rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s, transform 0.1s;
        }
        .login-btn:hover { background-color: #1f2937; }
        .login-btn:active { transform: scale(0.95); }

        /* Sub Navigation */
        .subnav {
            position: sticky;
            top: 69px;
            border-bottom: 1px solid #e5e7eb;
            background-color: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            z-index: 40;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
        }
        .subnav-content {
            display: flex;
            justify-content: center;
            gap: 3rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .subnav-link {
            padding: 1rem 0;
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s;
        }
        .subnav-link:hover { color: #000; }
        .subnav-link.active {
            color: #000;
            border-bottom: 2px solid #000;
            font-weight: 700;
        }

        /* Main Content */
        .main-content {
            max-width: 80rem;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            min-height: 1000px;
        }
        @media (min-width: 768px) {
            .main-content { padding-left: 2rem; padding-right: 2rem; }
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        .katalog-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        .book-count {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            background-color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
        }

        /* Grid */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.5rem;
        }
        @media (min-width: 640px) { .book-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 768px) { .book-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (min-width: 1024px) { .book-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); } }

        /* Book Card */
        .book-card {
            background-color: #f8f8f8;
            border-radius: 0.5rem;
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
            padding: 1.5rem;
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
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        .detail-btn:hover { background-color: #f3f4f6; }

        .card-details {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .book-author {
            font-size: 0.75rem;
            color: #6b7280;
            margin-bottom: 0.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .book-title {
            font-size: 0.875rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 0.75rem 0;
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
            padding-top: 0.5rem;
            border-top: 1px solid rgba(229,231,235,0.6);
        }
        .book-price {
            font-weight: 700;
            color: #111827;
            font-size: 0.875rem;
        }
        .cart-btn {
            background-color: #f3f4f6;
            width: 1.75rem;
            height: 1.75rem;
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
            width: 0.875rem;
            height: 0.875rem;
            opacity: 0.6;
            transition: opacity 0.2s;
        }
        .cart-btn:hover .cart-icon {
            opacity: 1;
        }
        
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 0;
            color: #6b7280;
        }

        /* Filter css */
        
        .content-layout {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }

        /* ── FILTER SIDEBAR ── */
        .filter-sidebar {
            flex-shrink: 0;
            width: 13rem;
            background-color: #fff;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            padding: 1.25rem;
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
            font-size: 0.9375rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 1rem 0;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .filter-header svg { opacity: 0.5; }

        .filter-section {
            margin-bottom: 1.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .filter-section:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .filter-section-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #374151;
            margin: 0 0 0.625rem 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .filter-section-title svg { opacity: 0.45; }

        .filter-all-btn {
            width: 100%;
            text-align: left;
            background-color: #111827;
            color: #fff;
            border: none;
            border-radius: 9999px;
            padding: 0.4rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 0.875rem;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .filter-all-btn:hover { background-color: #374151; }

        .filter-checkbox-list {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }
        .filter-checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.15s;
        }
        .filter-checkbox-item:hover { background-color: #f9fafb; }
        .filter-checkbox-item input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 1rem;
            height: 1rem;
            border: 1.5px solid #d1d5db;
            border-radius: 0.25rem;
            flex-shrink: 0;
            cursor: pointer;
            transition: all 0.15s;
            position: relative;
        }
        .filter-checkbox-item input[type="checkbox"]:checked {
            background-color: #111827;
            border-color: #111827;
        }
        .filter-checkbox-item input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 0.2rem;
            top: 0.05rem;
            width: 0.3rem;
            height: 0.55rem;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }
        .filter-checkbox-label {
            font-size: 0.8125rem;
            color: #374151;
            cursor: pointer;
            user-select: none;
        }

        .price-range-inputs {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .price-input-wrapper { flex: 1; }
        .price-input-label {
            font-size: 0.6875rem;
            font-weight: 600;
            color: #9ca3af;
            margin-bottom: 0.25rem;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .price-input {
            width: 100%;
            padding: 0.4rem 0.5rem;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            font-size: 0.8rem;
            color: #374151;
            outline: none;
            transition: all 0.2s;
            box-sizing: border-box;
        }
        .price-input:focus { border-color: #9ca3af; background-color: #fff; }
        .price-separator {
            font-size: 0.8rem;
            color: #9ca3af;
            margin-top: 1.1rem;
            flex-shrink: 0;
        }

        .filter-radio-list {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }
        .filter-radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.3rem 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.15s;
        }
        .filter-radio-item:hover { background-color: #f9fafb; }
        .filter-radio-item input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 1rem;
            height: 1rem;
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
            font-size: 0.8125rem;
            color: #374151;
            cursor: pointer;
            user-select: none;
        }

        .filter-select {
            width: 100%;
            padding: 0.45rem 0.75rem;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            color: #374151;
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.6rem center;
            padding-right: 2rem;
            transition: all 0.2s;
            margin-bottom: 0.5rem;
        }
        .filter-select:focus { border-color: #9ca3af; background-color: #fff; }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.25rem;
        }
        .filter-apply-btn {
            flex: 1;
            background-color: #111827;
            color: #fff;
            border: none;
            border-radius: 9999px;
            padding: 0.5rem 0;
            font-size: 0.8125rem;
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
            padding: 0.5rem 0;
            font-size: 0.8125rem;
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
</head>
<body>

    <!-- Top Navigation bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <!-- Logo  -->
            <a href="#" class="logo-link">
                <img src="{{ asset('icon-images/logo.png') }}" alt="Logo" class="logo-img">
                <span class="logo-text">BookaBuku</span>
            </a>

            <!-- Search Bar -->
            <div class="search-container">
                <button class="search-btn">
                    <img src="{{ asset('icon-images/search.png') }}" alt="Search" class="search-icon">
                </button>
                <input type="text" placeholder="Temukan buku yang anda inginkan" class="search-input">
            </div>

            <!-- Keranjang, Notifikasi, dan Auth -->
            <div class="nav-actions">
                <!-- Cart Button -->
                <button class="icon-btn" title="Keranjang">
                    <img src="{{ asset('icon-images/cart.png') }}" alt="Cart" class="icon-img">
                </button>

                <!-- Notification Button -->
                <button class="icon-btn" title="Notifikasi">
                    <img src="{{ asset('icon-images/notification.png') }}" alt="Notification" class="icon-img">
                </button>
                
                <a href="{{ route('login') }}" class="login-btn">
                    Masuk/Daftar
                </a>
            </div>
        </div>
    </nav>

    <!-- Sub-navigation -->
    <div class="subnav">
        <div class="subnav-content">
            <a href="{{ route('beranda') }}" id="tab-beranda" class="subnav-link">
                Beranda
            </a>
            <a href="{{ route('katalog') }}" id="tab-katalog" class="subnav-link active">
                Katalog
            </a>
            <a href="{{ route('jual') }}" id="tab-jual" class="subnav-link">
                Jual
            </a>
        </div>
    </div>

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
                    <div class="book-card" 
                        data-price="{{ $book->price }}" 
                        data-title="{{ strtolower($book->title) }}" 
                        data-author="{{ strtolower($book->author) }}" 
                        data-kategori="{{ strtolower($book->category ?? 'novel') }}">
                        <div class="book-cover-container">
                            <img src="{{ asset($book->image ?? 'book-images/jual.png') }}" alt="{{ $book->title }}" class="book-image">
                            <div class="hover-overlay">
                                <button class="detail-btn">Lihat Detail</button>
                            </div>
                        </div>
                        
                        <div class="card-details">
                            <div class="book-author">{{ $book->author }}</div>
                            <h3 class="book-title">{{ $book->title }}</h3>
                            
                            <div class="price-container">
                                <span class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                <button class="cart-btn" title="Tambah ke Keranjang">
                                    <img src="{{ asset('icon-images/cart.png') }}" alt="Cart" class="cart-icon">
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 3rem 0; color: #6b7280;"> 
                        Belum ada buku di katalog yang sesuai dengan filter Anda. 
                    </div>
                    @endforelse
                    @endfragment
                </div>
            </div>

        </div>
    </main>
    <script>
        function applyFilter() {
            const checkedKategori = [...document.querySelectorAll('input[name="kategori"]:checked')].map(el => el.value.toLowerCase());
            const minPrice = document.getElementById('price-min').value;
            const maxPrice = document.getElementById('price-max').value;
            const sortField = document.getElementById('sort-field').value;
            const sortDir   = document.querySelector('input[name="sort_dir"]:checked')?.value || 'asc';

            const params = new URLSearchParams();
            if (checkedKategori.length > 0) params.append('kategori', checkedKategori.join(','));
            if (minPrice) params.append('min_price', minPrice);
            if (maxPrice) params.append('max_price', maxPrice);
            if (sortField) params.append('sort_field', sortField);
            params.append('sort_dir', sortDir);

            // Fetch from backend
            fetch(`{{ route('katalog') }}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
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
</body>
</html>
