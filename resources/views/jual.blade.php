@extends('layouts.app')

@section('content')
@include('layouts.subnav')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap');
        body {
            font-family: 'Public Sans', sans-serif;
            background-color: #f9fafb;
            color: #111827;
            margin: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── MAIN ── */
        .main-content {
            max-width: 80rem; margin: 0 auto;
            padding: 3rem 1.5rem; min-height: 1000px;
        }
        @media (min-width: 768px) {
            .main-content { padding-left: 2rem; padding-right: 2rem; }
        }

        /* ── HEADER BAR ── */
        .header-bar {
            display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 2rem;
        }
        .page-title { font-size: 1.5rem; font-weight: 700; color: #111827; margin: 0; }
        .book-count {
            font-size: 0.875rem; font-weight: 500; color: #6b7280;
            background-color: #fff; padding: 0.25rem 0.75rem;
            border-radius: 9999px; border: 1px solid #e5e7eb;
        }
        .add-btn {
            display: flex; align-items: center; gap: 0.5rem;
            background-color: #000; color: #fff;
            padding: 0.625rem 1.25rem; border-radius: 9999px;
            font-size: 0.875rem; font-weight: 700;
            border: none; cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            text-decoration: none;
        }
        .sales-btn {
            display: flex; align-items: center; gap: 0.5rem;
            background-color: #fff; border: 1px solid #e5e7eb;
            color: #374151;
            padding: 0.625rem 1.25rem; border-radius: 9999px;
            font-size: 0.875rem; font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            text-decoration: none;
        }
        .sales-btn:hover { background-color: #f3f4f6; }
        .sales-btn:active { transform: scale(0.95); }
        .sales-btn svg { width: 0.875rem; height: 0.875rem; }
        .add-btn:hover { background-color: #1f2937; }
        .add-btn:active { transform: scale(0.95); }
        .add-btn svg { width: 0.875rem; height: 0.875rem; }

        /* ── BOOK GRID ── */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.5rem;
        }
        @media (min-width: 640px)  { .book-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 768px)  { .book-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (min-width: 1024px) { .book-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); } }

        /* ── BOOK CARD ── */
        .book-card {
            background-color: #f8f8f8; border-radius: 0.5rem;
            overflow: hidden; display: flex; flex-direction: column;
            transition: box-shadow 0.2s;
        }
        .book-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .book-cover-container {
            aspect-ratio: 1 / 1; width: 100%;
            background-color: #B85D2C;
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem; position: relative;
        }
        .book-image {
            height: 75%; object-fit: cover;
            filter: drop-shadow(0 20px 13px rgba(0,0,0,0.03)) drop-shadow(0 8px 5px rgba(0,0,0,0.08));
        }
        .category-badge {
            position: absolute; top: 0.625rem; left: 0.625rem;
            background-color: rgba(0,0,0,0.55);
            backdrop-filter: blur(4px);
            color: #fff; font-size: 0.625rem; font-weight: 700;
            padding: 0.25rem 0.625rem; border-radius: 9999px;
            text-transform: uppercase; letter-spacing: 0.06em;
        }
        .card-details {
            padding: 1rem; display: flex;
            flex-direction: column; flex-grow: 1;
        }
        .book-author {
            font-size: 0.75rem; color: #6b7280;
            margin-bottom: 0.25rem;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .book-title {
            font-size: 0.875rem; font-weight: 700; color: #111827;
            margin: 0 0 0.75rem 0; line-height: 1.375; flex-grow: 1;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        .price-row {
            display: flex; align-items: center;
            justify-content: space-between;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(229,231,235,0.6);
            margin-top: auto;
        }
        .book-price { font-weight: 700; color: #111827; font-size: 0.875rem; }
        .stock-badge {
            font-size: 0.6875rem; color: #6b7280;
            background: #f3f4f6; padding: 0.2rem 0.5rem;
            border-radius: 9999px;
        }
        .action-row {
            display: flex; gap: 0.5rem;
            padding-top: 0.625rem;
            margin-top: 0.5rem;
        }
        .edit-btn {
            flex: 1; display: flex; align-items: center; justify-content: center;
            gap: 0.3rem;
            background-color: #fff; border: 1px solid #e5e7eb;
            color: #374151; font-size: 0.75rem; font-weight: 700;
            padding: 0.45rem 0; border-radius: 0.375rem;
            cursor: pointer; transition: background-color 0.15s;
        }
        .edit-btn:hover { background-color: #f3f4f6; }
        .delete-btn {
            flex: 1; display: flex; align-items: center; justify-content: center;
            gap: 0.3rem;
            background-color: #fff5f5; border: 1px solid #fecaca;
            color: #dc2626; font-size: 0.75rem; font-weight: 700;
            padding: 0.45rem 0; border-radius: 0.375rem;
            cursor: pointer; transition: background-color 0.15s;
        }
        .delete-btn:hover { background-color: #fee2e2; }
        .delete-form {
            flex: 1;
            display: flex;
        }
        .delete-form .delete-btn {
            width: 100%;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            grid-column: 1 / -1; text-align: center;
            padding: 5rem 1rem;
        }
        .empty-icon {
            width: 4rem; height: 4rem; background-color: #f3f4f6;
            border-radius: 9999px; display: flex; align-items: center;
            justify-content: center; margin: 0 auto 1rem;
        }
        .empty-title { font-size: 1rem; font-weight: 700; color: #111827; margin: 0 0 0.25rem; }
        .empty-desc { font-size: 0.875rem; color: #6b7280; margin: 0 0 1.5rem; }

        /* ── TOAST ── */
        .toast {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999;
            background-color: #16a34a; color: #fff;
            padding: 0.875rem 1.25rem; border-radius: 0.875rem;
            display: flex; align-items: center; gap: 0.75rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: slideInToast 0.35s ease-out;
        }
        @keyframes slideInToast {
            from { opacity: 0; transform: translateY(1rem); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .toast-close {
            background: none; border: none; color: #fff;
            cursor: pointer; font-size: 1rem; opacity: 0.75;
            padding: 0; line-height: 1;
        }
        .toast-close:hover { opacity: 1; }

        /* ── ERROR BANNER ── */
        .error-banner {
            background-color: #fef2f2; border: 1px solid #fecaca;
            color: #dc2626; padding: 1rem 1.25rem;
            border-radius: 0.75rem; margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
        .error-banner ul { margin: 0.5rem 0 0 1rem; padding: 0; }
        .error-banner li { margin-bottom: 0.25rem; }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            position: fixed; inset: 0; z-index: 9000;
            display: none;
            align-items: center; justify-content: center;
            padding: 1rem;
            background-color: rgba(0,0,0,0.55);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }
        .modal-overlay.active {
            display: flex;
            animation: fadeInOverlay 0.25s ease-out;
        }
        @keyframes fadeInOverlay {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* ── MODAL CARD ── */
        .modal-card {
            background: #fff; border-radius: 1rem;
            width: 100%; max-width: 780px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            overflow: hidden;
            animation: slideUpModal 0.3s ease-out;
            display: flex; flex-direction: column;
            max-height: 92vh;
        }
        @keyframes slideUpModal {
            from { opacity: 0; transform: translateY(1.5rem) scale(0.98); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6;
            background-color: #fafafa;
        }
        .modal-title { font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0; }
        .modal-subtitle { font-size: 0.75rem; color: #6b7280; margin: 0.125rem 0 0; }
        .modal-close-btn {
            background: none; border: none; cursor: pointer;
            color: #9ca3af; padding: 0.25rem;
            border-radius: 9999px; transition: color 0.15s, background-color 0.15s;
        }
        .modal-close-btn:hover { color: #374151; background-color: #f3f4f6; }

        /* ── MODAL BODY ── */
        .modal-body {
            display: flex; flex-direction: row; overflow: hidden;
            flex: 1;
        }
        @media (max-width: 640px) {
            .modal-body { flex-direction: column; overflow-y: auto; }
        }

        /* Left panel — upload */
        .modal-left {
            width: 240px; flex-shrink: 0;
            background-color: #f9fafb;
            border-right: 1px solid #f3f4f6;
            padding: 1.5rem 1.25rem;
            display: flex; flex-direction: column; gap: 1.25rem;
        }
        @media (max-width: 640px) { .modal-left { width: 100%; border-right: none; border-bottom: 1px solid #f3f4f6; } }

        .upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 0.75rem;
            aspect-ratio: 3 / 4;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center; cursor: pointer;
            position: relative; overflow: hidden;
            transition: border-color 0.2s, background-color 0.2s;
        }
        .upload-zone:hover { border-color: #9ca3af; background-color: #f3f4f6; }
        .upload-zone input[type="file"] {
            position: absolute; inset: 0;
            opacity: 0; cursor: pointer; z-index: 5;
        }
        .upload-zone-preview {
            position: absolute; inset: 0;
            display: none; z-index: 3;
        }
        .upload-zone-preview img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .upload-zone-overlay {
            position: absolute; inset: 0; z-index: 4;
            background-color: rgba(0,0,0,0.4);
            display: none; align-items: center; justify-content: center;
        }
        .upload-zone:hover .upload-zone-overlay { display: flex; }
        .upload-zone-overlay span {
            color: #fff; font-size: 0.75rem; font-weight: 700;
            background-color: rgba(0,0,0,0.6); padding: 0.35rem 0.875rem;
            border-radius: 9999px;
        }
        .upload-icon { color: #9ca3af; margin-bottom: 0.625rem; }
        .upload-label { font-size: 0.8125rem; font-weight: 600; color: #374151; }
        .upload-hint { font-size: 0.6875rem; color: #9ca3af; margin-top: 0.25rem; }

        /* Price block */
        .price-block { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem; }
        .price-block-title { font-size: 0.875rem; font-weight: 700; color: #111827; margin: 0 0 0.75rem; }
        .price-field {
            width: 100%; padding: 0.5rem 0.75rem;
            border: 1px solid #e5e7eb; border-radius: 0.5rem;
            font-size: 0.875rem; color: #374151;
            outline: none; transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .price-field:focus { border-color: #6b7280; }
        .stock-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 0.875rem;
        }
        .stock-label { font-size: 0.875rem; font-weight: 700; color: #111827; }
        .stock-controls { display: flex; align-items: center; gap: 0.75rem; }
        .stock-btn {
            width: 1.75rem; height: 1.75rem;
            border: 1px solid #d1d5db; border-radius: 9999px;
            background: #fff; font-size: 1.125rem; line-height: 1;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #374151; transition: background-color 0.15s;
        }
        .stock-btn:hover { background-color: #f3f4f6; }
        .stock-value {
            font-size: 0.875rem; font-weight: 700; color: #111827;
            min-width: 1.5rem; text-align: center;
        }
        .stock-input-hidden { display: none; }

        /* Right panel — form */
        .modal-right {
            flex: 1; padding: 1.5rem;
            overflow-y: auto;
        }
        .detail-title { font-size: 1rem; font-weight: 700; color: #111827; margin: 0 0 1.125rem; }
        .field-group { margin-bottom: 1rem; }
        .field-label {
            display: block; font-size: 0.8rem; color: #374151;
            font-weight: 500; margin-bottom: 0.375rem;
        }
        .field-input {
            width: 100%; padding: 0.5625rem 0.75rem;
            border: 1px solid #d1d5db; border-radius: 0.5rem;
            font-size: 0.875rem; color: #374151; outline: none;
            font-family: inherit; transition: border-color 0.2s;
            box-sizing: border-box;
        }
        .field-input:focus { border-color: #6b7280; }
        .field-textarea {
            resize: none; min-height: 100px;
        }
        .field-select {
            appearance: none; -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.25rem;
            cursor: pointer;
        }

        /* ── MODAL FOOTER ── */
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f3f4f6;
            background-color: #fafafa;
            display: flex; justify-content: flex-end; gap: 0.75rem;
        }
        .btn-cancel {
            padding: 0.625rem 1.25rem; border-radius: 9999px;
            border: 1px solid #e5e7eb; background-color: #fff;
            font-size: 0.875rem; font-weight: 600; color: #374151;
            cursor: pointer; transition: background-color 0.15s;
        }
        .btn-cancel:hover { background-color: #f3f4f6; }
        .btn-submit {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.625rem 1.5rem; border-radius: 9999px;
            border: none; background-color: #111827;
            font-size: 0.875rem; font-weight: 700; color: #fff;
            cursor: pointer; transition: background-color 0.15s, transform 0.1s;
        }
        .btn-submit:hover { background-color: #374151; }
        .btn-submit:active { transform: scale(0.96); }

        /* ── CONFIRM DELETE MODAL ── */
        .confirm-overlay {
            position: fixed; inset: 0; z-index: 9100;
            display: none; align-items: center; justify-content: center;
            padding: 1rem;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
        }
        .confirm-overlay.active { display: flex; animation: fadeInOverlay 0.2s ease-out; }
        .confirm-card {
            background: #fff; border-radius: 0.875rem;
            padding: 1.75rem; max-width: 380px; width: 100%;
            text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            animation: slideUpModal 0.25s ease-out;
        }
        .confirm-icon {
            width: 3rem; height: 3rem; background-color: #fef2f2;
            border-radius: 9999px; display: flex; align-items: center;
            justify-content: center; margin: 0 auto 1rem;
        }
        .confirm-title { font-size: 1rem; font-weight: 700; color: #111827; margin: 0 0 0.5rem; }
        .confirm-desc  { font-size: 0.875rem; color: #6b7280; margin: 0 0 1.5rem; }
        .confirm-actions { display: flex; gap: 0.75rem; justify-content: center; }
        .confirm-cancel {
            padding: 0.625rem 1.25rem; border-radius: 9999px;
            border: 1px solid #e5e7eb; background-color: #fff;
            font-size: 0.875rem; font-weight: 600; color: #374151;
            cursor: pointer; transition: background-color 0.15s;
        }
        .confirm-cancel:hover { background-color: #f3f4f6; }
        .confirm-delete {
            padding: 0.625rem 1.25rem; border-radius: 9999px;
            border: none; background-color: #dc2626;
            font-size: 0.875rem; font-weight: 700; color: #fff;
            cursor: pointer; transition: background-color 0.15s;
        }
        .confirm-delete:hover { background-color: #b91c1c; }
    </style>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <main class="main-content">

        {{-- Toast --}}
        @if(session('success'))
            <div class="toast" id="success-toast">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p style="font-weight:700;font-size:0.875rem;margin:0;">Berhasil!</p>
                    <p style="font-size:0.75rem;opacity:0.9;margin:0;">{{ session('success') }}</p>
                </div>
                <button class="toast-close" onclick="document.getElementById('success-toast').remove()">✕</button>
            </div>
            <script>setTimeout(() => { const t = document.getElementById('success-toast'); if(t) t.remove(); }, 4000);</script>
        @endif

        {{-- Error Banner --}}
        @if($errors->any())
            <div class="error-banner">
                <strong>Ada kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ── HEADER BAR ── --}}
        <div class="header-bar">
            <div style="display:flex;align-items:center;gap:1rem;">
                <h1 class="page-title">Listing Buku Saya</h1>
                @auth
                    <span class="book-count">{{ $books->count() }} Buku</span>
                @endauth
            </div>
            <div style="display:flex; gap:0.75rem;">
                @auth
                    <button class="sales-btn" onclick="openDetailPenjualanModal()">
                        <img src="{{ asset('icon-images/sales.png') }}" alt="Sales" style="width: 0.875rem; height: 0.875rem;">
                        Detail Penjualan
                    </button>
                    <button class="add-btn" onclick="openCreateModal()">
                        <img src="{{ asset('icon-images/create-white.png') }}" alt="Create" style="width: 0.875rem; height: 0.875rem;">
                        Tambah Buku Baru
                    </button>
                @else
                    <button class="sales-btn" onclick="document.getElementById('modal-auth').classList.remove('hidden')">
                        <img src="{{ asset('icon-images/sales.png') }}" alt="Sales" style="width: 0.875rem; height: 0.875rem;">
                        Detail Penjualan
                    </button>
                    <button class="add-btn" onclick="document.getElementById('modal-auth').classList.remove('hidden')">
                        <img src="{{ asset('icon-images/create-white.png') }}" alt="Create" style="width: 0.875rem; height: 0.875rem;">
                        Tambah Buku Baru
                    </button>
                @endauth
            </div>
        </div>

        {{-- ── BOOK GRID ── --}}
        @auth
            @if($books->isEmpty())
                <div class="book-grid">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg width="28" height="28" fill="none" stroke="#9ca3af" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <p class="empty-title">Belum Ada Buku yang Dijual</p>
                        <p class="empty-desc">Mulai jual buku Anda agar muncul di Katalog BookaBuku.</p>
                        <button class="add-btn" style="margin:0 auto;display:inline-flex;align-items:center;gap:0.5rem;" onclick="openCreateModal()">
                            <img src="{{ asset('icon-images/create-white.png') }}" alt="Create" style="width: 0.875rem; height: 0.875rem;">
                            Mulai Jual Buku
                        </button>
                    </div>
                </div>
            @else
                <div class="book-grid">
                    @foreach($books as $book)
                        <div class="book-card">
                            {{-- Cover --}}
                            <div class="book-cover-container">
                                <img src="{{ asset($book->image ?? 'book-images/jual.png') }}"
                                     alt="{{ $book->title }}" class="book-image">
                                @if($book->category)
                                    <span class="category-badge">{{ $book->category }}</span>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="card-details">
                                <div class="book-author">{{ $book->author }}</div>
                                <h3 class="book-title">{{ $book->title }}</h3>

                                <div class="price-row">
                                    <span class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                    <span class="stock-badge">Stok: {{ $book->stock }}</span>
                                </div>

                                <div class="action-row">
                                    {{-- Edit --}}
                                    <button class="edit-btn"
                                            onclick="openEditModal({{ json_encode([
                                                'id'          => $book->id,
                                                'title'       => $book->title,
                                                'author'      => $book->author,
                                                'category'    => $book->category,
                                                'price'       => $book->price,
                                                'stock'       => $book->stock,
                                                'description' => $book->description,
                                                'image'       => $book->image,
                                            ]) }})">
                                        <img src="{{ asset('icon-images/edit.png') }}" alt="Edit" style="width: 0.75rem; height: 0.75rem;">
                                        Edit
                                    </button>

                                    {{-- Delete --}}
                                    <form class="delete-form"
                                          id="delete-form-{{ $book->id }}"
                                          action="{{ route('jual.destroy', $book->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-btn"
                                                onclick="openConfirmDelete({{ $book->id }}, '{{ addslashes($book->title) }}')">
                                            <img src="{{ asset('icon-images/delete-red.png') }}" alt="Hapus" style="width: 0.75rem; height: 0.75rem;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <div class="book-grid">
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="28" height="28" fill="none" stroke="#9ca3af" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <p class="empty-title">Silakan Login Terlebih Dahulu</p>
                    <p class="empty-desc">Anda perlu masuk akun untuk mengelola listing buku.</p>
                    <button class="add-btn" style="margin:0 auto;display:inline-flex;"
                            onclick="document.getElementById('modal-auth').classList.remove('hidden')">
                        Masuk / Daftar
                    </button>
                </div>
            </div>
        @endauth

    </main>

    {{-- ══════════════════════════════════════════
         MODAL CREATE / EDIT
    ══════════════════════════════════════════ --}}
    <div id="modal-jual" class="modal-overlay" onclick="handleOverlayClick(event)">
        <div class="modal-card" id="modal-jual-card">

            {{-- Header --}}
            <div class="modal-header">
                <div>
                    <p class="modal-title" id="modal-jual-title">Jual Buku Baru</p>
                    <p class="modal-subtitle">Masukkan rincian informasi buku yang ingin dipublikasikan.</p>
                </div>
                <button class="modal-close-btn" type="button" onclick="closeJualModal()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form id="jual-form" method="POST" action="{{ route('jual.store') }}" enctype="multipart/form-data"
                  style="display:flex;flex-direction:column;flex:1;overflow:hidden;">
                @csrf
                <input type="hidden" name="_method" id="form-method" value="POST">
                <input type="hidden" name="id" id="form-book-id" value="">

                <div class="modal-body">

                    {{-- ── LEFT: Image + Price + Stock ── --}}
                    <div class="modal-left">

                        {{-- Upload Zone --}}
                        <div>
                            <div class="upload-zone" id="upload-zone">
                                <input type="file" name="image" id="image-input"
                                       accept="image/png,image/jpeg,image/gif"
                                       onchange="handleImagePreview(event)">

                                {{-- Preview layer --}}
                                <div class="upload-zone-preview" id="image-preview-wrap">
                                    <img id="image-preview-img" src="" alt="Preview Cover">
                                    <div class="upload-zone-overlay">
                                        <span>Ganti Gambar</span>
                                    </div>
                                </div>

                                {{-- Default layer --}}
                                <div id="upload-default-layer" style="display:flex;flex-direction:column;align-items:center;padding:1rem;">
                                    <svg class="upload-icon" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                                    </svg>
                                    <span class="upload-label">Upload gambar buku</span>
                                    <span class="upload-hint">max. 1 gambar (PNG / JPG)</span>
                                </div>
                            </div>
                        </div>

                        {{-- Price + Stock Block --}}
                        <div class="price-block">
                            <p class="price-block-title">Masukkan Harga</p>
                            <input type="number" name="price" id="field-price" class="price-field"
                                   placeholder="Rp0" min="0" required>
                            <div class="stock-row">
                                <span class="stock-label">Stok</span>
                                <div class="stock-controls">
                                    <button type="button" class="stock-btn" onclick="changeStock(-1)">−</button>
                                    <span class="stock-value" id="stock-display">1</span>
                                    <button type="button" class="stock-btn" onclick="changeStock(1)">+</button>
                                </div>
                            </div>
                            <input type="hidden" name="stock" id="field-stock" value="1">
                        </div>

                    </div>

                    {{-- ── RIGHT: Detail Buku Form ── --}}
                    <div class="modal-right">
                        <p class="detail-title">Detail Buku</p>

                        <div class="field-group">
                            <label class="field-label" for="field-title">Judul Buku</label>
                            <input type="text" name="title" id="field-title" class="field-input"
                                   placeholder="Masukkan judul buku" required>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="field-author">Penulis</label>
                            <input type="text" name="author" id="field-author" class="field-input"
                                   placeholder="Nama penulis" required>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="field-description">Deskripsi Singkat</label>
                            <textarea name="description" id="field-description"
                                      class="field-input field-textarea"
                                      placeholder="Tulis sinopsis atau deskripsi buku..." required></textarea>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="field-category">Kategori</label>
                            <select name="category" id="field-category" class="field-input field-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Novel">Novel</option>
                                <option value="Komik">Komik</option>
                                <option value="Edukasi">Edukasi</option>
                                <option value="Biografi">Biografi</option>
                                <option value="Teknologi">Teknologi</option>
                            </select>
                        </div>
                    </div>

                </div>{{-- end modal-body --}}

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeJualModal()">Batal</button>
                    <button type="submit" class="btn-submit">
                        Kirim
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                        </svg>
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         CONFIRM DELETE MODAL
    ══════════════════════════════════════════ --}}
    <div id="confirm-delete-modal" class="confirm-overlay">
        <div class="confirm-card">
            <div class="confirm-icon">
                <svg width="24" height="24" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
            <p class="confirm-title">Hapus Listing Buku?</p>
            <p class="confirm-desc" id="confirm-delete-desc">Buku ini akan dihapus permanen dari listing Anda.</p>
            <div class="confirm-actions">
                <button class="confirm-cancel" onclick="closeConfirmDelete()">Batal</button>
                <button class="confirm-delete" id="confirm-delete-btn" onclick="submitDelete()">Hapus</button>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         MODAL DETAIL PENJUALAN
    ══════════════════════════════════════════ --}}
    @auth
    <div id="modal-detail-penjualan" class="modal-overlay" onclick="handleDetailOverlayClick(event)">
        <div class="modal-card" id="modal-detail-penjualan-card" style="max-width: 650px;">

            {{-- Header --}}
            <div class="modal-header">
                <div>
                    <p class="modal-title">Detail Penjualan & Pendapatan</p>
                    <p class="modal-subtitle">Ringkasan penjualan dari seluruh buku yang telah Anda listing.</p>
                </div>
                <button class="modal-close-btn" type="button" onclick="closeDetailPenjualanModal()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body" style="padding: 1.5rem; display: flex; flex-direction: column; overflow-y: auto; max-height: 60vh;">
                @if($books->isEmpty())
                    <div style="text-align: center; padding: 2rem 0; color: #9ca3af;">
                        Belum ada data buku untuk melihat detail penjualan.
                    </div>
                @else
                    <div style="width: 100%; border-collapse: collapse;">
                        <table style="width: 100%; text-align: left; font-size: 0.875rem;">
                            <thead>
                                <tr style="border-bottom: 2px solid #e5e7eb; color: #4b5563; font-weight: 600;">
                                    <th style="padding: 0.75rem 0.5rem;">Buku</th>
                                    <th style="padding: 0.75rem 0.5rem; text-align: center;">Harga</th>
                                    <th style="padding: 0.75rem 0.5rem; text-align: center;">Terjual</th>
                                    <th style="padding: 0.75rem 0.5rem; text-align: right;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPendapatan = 0;
                                @endphp
                                @foreach($books as $book)
                                    @php
                                        $soldCount = $book->orderItems->sum('quantity'); 
                                        $totalBuku = $book->orderItems->sum('subtotal');
                                        $totalPendapatan += $totalBuku;
                                    @endphp
                                    <tr style="border-bottom: 1px solid #f3f4f6; color: #374151;">
                                        <td style="padding: 0.75rem 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                                            <img src="{{ asset($book->image ?? 'book-images/jual.png') }}" 
                                                 alt="{{ $book->title }}" 
                                                 style="width: 2.5rem; height: 3.2rem; object-fit: cover; border-radius: 0.25rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <div>
                                                <div style="font-weight: 700; color: #111827; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; max-width: 250px;">
                                                    {{ $book->title }}
                                                </div>
                                                <div style="font-size: 0.75rem; color: #6b7280;">{{ $book->author }}</div>
                                            </div>
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; text-align: center; white-space: nowrap;">
                                            Rp {{ number_format($book->price, 0, ',', '.') }}
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; text-align: center; font-weight: 600;">
                                            {{ $soldCount }}
                                        </td>
                                        <td style="padding: 0.75rem 0.5rem; text-align: right; font-weight: 700; color: #111827; white-space: nowrap;">
                                            Rp {{ number_format($totalBuku, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Footer --}}
            <div class="modal-footer" style="display: flex; flex-direction: column; gap: 1rem; padding: 1.25rem 1.5rem;">
                @if(!$books->isEmpty())
                    <div style="display: flex; justify-content: space-between; align-items: center; background-color: #f0fdf4; border: 1px solid #bbf7d0; padding: 1rem; border-radius: 0.75rem;">
                        <span style="font-size: 0.875rem; font-weight: 700; color: #166534;">TOTAL PENDAPATAN</span>
                        <span style="font-size: 1.125rem; font-weight: 800; color: #15803d; letter-spacing: -0.025em;">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </span>
                    </div>
                @endif
                <div style="display: flex; justify-content: flex-end;">
                    <button type="button" class="btn-cancel" onclick="closeDetailPenjualanModal()">Tutup</button>
                </div>
            </div>

        </div>
    </div>
    @endauth



    {{-- ══════════════════════════════════════════
         SCRIPTS
    ══════════════════════════════════════════ --}}
    <script>
        /* ── Stock counter ── */
        let stockValue = 1;

        function changeStock(delta) {
            stockValue = Math.max(0, stockValue + delta);
            document.getElementById('stock-display').textContent = stockValue;
            document.getElementById('field-stock').value = stockValue;
        }

        /* ── Image preview ── */
        function handleImagePreview(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('image-preview-img').src = e.target.result;
                document.getElementById('image-preview-wrap').style.display = 'block';
                document.getElementById('upload-default-layer').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        /* ── Open / Close modal ── */
        function openCreateModal() {
            // Reset form
            document.getElementById('jual-form').reset();
            document.getElementById('form-method').value = 'POST';
            document.getElementById('jual-form').action = '{{ route('jual.store') }}';
            document.getElementById('form-book-id').value = '';
            document.getElementById('modal-jual-title').textContent = 'Jual Buku Baru';

            // Reset stock
            stockValue = 1;
            document.getElementById('stock-display').textContent = 1;
            document.getElementById('field-stock').value = 1;

            // Reset preview
            document.getElementById('image-preview-wrap').style.display = 'none';
            document.getElementById('upload-default-layer').style.display = 'flex';

            document.getElementById('modal-jual').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function openEditModal(book) {
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('jual-form').action = `/jual/${book.id}`;
            document.getElementById('form-book-id').value = book.id;
            document.getElementById('modal-jual-title').textContent = 'Edit Detail Buku';

            document.getElementById('field-title').value       = book.title       || '';
            document.getElementById('field-author').value      = book.author      || '';
            document.getElementById('field-description').value = book.description || '';
            document.getElementById('field-price').value       = book.price       || '';
            document.getElementById('field-category').value    = book.category    || '';

            // Stock
            stockValue = parseInt(book.stock) || 0;
            document.getElementById('stock-display').textContent = stockValue;
            document.getElementById('field-stock').value = stockValue;

            // Image preview
            if (book.image) {
                document.getElementById('image-preview-img').src = '/' + book.image;
                document.getElementById('image-preview-wrap').style.display = 'block';
                document.getElementById('upload-default-layer').style.display = 'none';
            } else {
                document.getElementById('image-preview-wrap').style.display = 'none';
                document.getElementById('upload-default-layer').style.display = 'flex';
            }

            // Reset file input so user can re-upload
            document.getElementById('image-input').value = '';

            document.getElementById('modal-jual').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeJualModal() {
            document.getElementById('modal-jual').classList.remove('active');
            document.body.style.overflow = '';
        }

        function handleOverlayClick(e) {
            if (e.target === document.getElementById('modal-jual')) closeJualModal();
        }

        /* ── Confirm delete ── */
        let pendingDeleteId = null;

        function openConfirmDelete(bookId, bookTitle) {
            pendingDeleteId = bookId;
            document.getElementById('confirm-delete-desc').textContent =
                `"${bookTitle}" akan dihapus permanen dari listing Anda.`;
            document.getElementById('confirm-delete-modal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeConfirmDelete() {
            pendingDeleteId = null;
            document.getElementById('confirm-delete-modal').classList.remove('active');
            document.body.style.overflow = '';
        }

        function submitDelete() {
            if (!pendingDeleteId) return;
            document.getElementById(`delete-form-${pendingDeleteId}`).submit();
        }

        /* ── Re-open modal on validation error ── */
        @if($errors->any() && !$errors->has('email') && !$errors->has('name') && !$errors->has('password_confirmation'))
            document.addEventListener('DOMContentLoaded', () => {
                // Re-populate from old() values
                const oldMethod = '{{ old('_method', 'POST') }}';
                const oldId     = '{{ old('id') }}';
                if (oldMethod === 'PUT' && oldId) {
                    document.getElementById('form-method').value   = 'PUT';
                    document.getElementById('jual-form').action    = `/jual/${oldId}`;
                    document.getElementById('form-book-id').value  = oldId;
                    document.getElementById('modal-jual-title').textContent = 'Edit Detail Buku';
                } else {
                    document.getElementById('modal-jual-title').textContent = 'Jual Buku Baru';
                }
                document.getElementById('field-title').value       = '{{ old('title') }}';
                document.getElementById('field-author').value      = '{{ old('author') }}';
                document.getElementById('field-description').value = '{{ old('description') }}';
                document.getElementById('field-price').value       = '{{ old('price') }}';
                document.getElementById('field-category').value    = '{{ old('category') }}';
                const s = parseInt('{{ old('stock', 1) }}') || 1;
                stockValue = s;
                document.getElementById('stock-display').textContent = s;
                document.getElementById('field-stock').value = s;

                document.getElementById('modal-jual').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        @endif

        /* ── Detail Penjualan Modal ── */
        function openDetailPenjualanModal() {
            const modal = document.getElementById('modal-detail-penjualan');
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeDetailPenjualanModal() {
            const modal = document.getElementById('modal-detail-penjualan');
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        function handleDetailOverlayClick(e) {
            if (e.target === document.getElementById('modal-detail-penjualan')) {
                closeDetailPenjualanModal();
            }
        }
    </script>

@endsection
