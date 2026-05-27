{{-- ═══════════════════════════════════════════
     MODAL AUTH
═══════════════════════════════════════════ --}}
<div id="modal-auth"
     class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
     onclick="closeModalIfOutside(event)">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    {{-- Card --}}
    <div id="modal-card"
         class="relative z-10 flex w-full max-w-[680px] rounded-2xl overflow-hidden shadow-2xl"
         style="animation: slideUp .3s ease-out">

        {{-- Kiri: foto --}}
        <div class="hidden md:block w-[42%] flex-shrink-0 min-h-[440px]"
             style="background: url('{{ asset('book-images/login-pic.jpg') }}') center/cover no-repeat">
        </div>

        {{-- Kanan: form --}}
        <div class="flex-1 bg-[#fafafa] px-10 py-10 flex flex-col justify-center">

            {{-- ── LOGIN ── --}}
            <div id="tab-login">
                <h1 class="font-serif text-3xl font-bold text-gray-900 mb-1">Welcome</h1>
                <p class="text-sm text-gray-400 mb-7">Login dengan Email</p>

                @if ($errors->has('email'))
                    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-300 text-red-600 text-sm rounded-lg">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="contoh@email.com" required autofocus
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-2 focus:ring-black/5 transition">
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                        <input type="password" name="password"
                               placeholder="••••••••" required
                               class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:border-gray-900 focus:ring-2 focus:ring-black/5 transition">
                    </div>
                    <button type="submit"
                            class="w-full mt-5 bg-gray-900 text-white rounded-full py-3 text-sm font-semibold hover:bg-black transition">
                        Login
                    </button>
                </form>

                <p class="text-center text-sm text-gray-400 mt-5">
                    Belum punya akun?
                    <button onclick="switchTab('register')" class="font-semibold text-gray-900 hover:underline">
                        Daftar sekarang
                    </button>
                </p>
            </div>

            {{-- ── REGISTER ── --}}
            <div id="tab-register" class="hidden">
                <h1 class="font-serif text-3xl font-bold text-gray-900 mb-1">Get Started</h1>
                <p class="text-sm text-gray-400 mb-6">Buat Akun Baru</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               placeholder="Nama lengkap kamu" required
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
                    <button onclick="switchTab('login')" class="font-semibold text-gray-900 hover:underline">
                        Login
                    </button>
                </p>
            </div>

        </div>

        {{-- Tombol close --}}
        <button onclick="document.getElementById('modal-auth').classList.add('hidden')"
                class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center rounded-full bg-black/10 hover:bg-black/20 text-gray-600 text-sm transition">
            ✕
        </button>
    </div>
</div>

<style>
    @keyframes slideUp {
        from { opacity:0; transform:translateY(20px) }
        to   { opacity:1; transform:translateY(0) }
    }
</style>

<script>
    function switchTab(tab) {
        document.getElementById('tab-login').classList.toggle('hidden', tab !== 'login');
        document.getElementById('tab-register').classList.toggle('hidden', tab !== 'register');
    }

    function closeModalIfOutside(e) {
        if (e.target === document.getElementById('modal-auth')) {
            document.getElementById('modal-auth').classList.add('hidden');
        }
    }
    @if(session('openLoginModal'))
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('modal-auth').classList.remove('hidden');
    });
@endif
    // Buka modal otomatis kalau ada error validasi
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('modal-auth').classList.remove('hidden');
            @if ($errors->has('name') || $errors->has('password_confirmation'))
                switchTab('register');
            @endif
        });
    @endif
    
</script>