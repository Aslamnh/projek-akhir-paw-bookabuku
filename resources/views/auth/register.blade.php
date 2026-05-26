<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — BookaBuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1a1a1a] min-h-screen flex flex-col">

    <nav class="bg-[#111] px-8 py-3 flex items-center gap-4">
        <span class="text-white font-bold text-lg">BookaBuku</span>
        <div class="flex-1 max-w-md ml-2">
            <input type="text" placeholder="Temukan buku yang anda cari..."
                   class="w-full bg-[#2a2a2a] border border-[#333] rounded-full px-4 py-2 text-sm text-gray-300 placeholder-gray-600 outline-none">
        </div>
        <div class="ml-auto">
            <a href="{{ route('login') }}"
               class="bg-white text-black text-sm font-semibold px-5 py-2 rounded-full hover:bg-gray-100 transition">
                Masuk/Daftar
            </a>
        </div>
    </nav>

    <div class="flex-1 bg-gradient-to-br from-[#2c2c2c] to-[#1a1a1a] flex items-center justify-center p-6">
        <div class="flex w-full max-w-[680px] rounded-2xl overflow-hidden shadow-2xl"
             style="animation: slideUp .35s ease-out">

            <div class="hidden md:block w-[42%] flex-shrink-0 min-h-[500px]"
                 style="background: url('{{ asset('bg-acc.img') }}') center/cover no-repeat">
            </div>

            <div class="flex-1 bg-[#fafafa] px-10 py-10 flex flex-col justify-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Get Started</h1>
                <p class="text-sm text-gray-400 mb-6">Buat Akun Baru</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Nama lengkap kamu" required autofocus
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-2 focus:ring-black/5 transition">
                        @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="contoh@email.com" required
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-2 focus:ring-black/5 transition">
                        @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                        <input type="password" name="password" placeholder="••••••••" required
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-2 focus:ring-black/5 transition">
                        @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-2 focus:ring-black/5 transition">
                    </div>
                    <button type="submit"
                            class="w-full mt-4 bg-gray-900 text-white rounded-full py-3 text-sm font-semibold hover:bg-black transition">
                        Register
                    </button>
                </form>

                <p class="text-center text-sm text-gray-400 mt-5">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-gray-900 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>

    <style>
        @keyframes slideUp {
            from { opacity:0; transform:translateY(20px) }
            to   { opacity:1; transform:translateY(0) }
        }
    </style>
</body>
</html>