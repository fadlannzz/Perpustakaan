<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-white tracking-tight">Selamat Datang</h2>
        <p class="text-xs text-slate-400 mt-1">Masukkan kredensial Anda untuk mengelola perpustakaan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-emerald-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                Alamat Email
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email', 'admin@perpus') }}" required autofocus autocomplete="username"
                    placeholder="nama@email.com"
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl text-sm border-slate-700 bg-slate-900/80 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
            </div>
            <x-input-error :messages="$errors?->get('email')" class="mt-2 text-xs text-rose-400" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                    Kata Sandi
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-emerald-400 hover:text-emerald-300 transition" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl text-sm border-slate-700 bg-slate-900/80 text-white placeholder-slate-500 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
            </div>
            <x-input-error :messages="$errors?->get('password')" class="mt-2 text-xs text-rose-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-emerald-600 focus:ring-emerald-500/20 focus:ring-offset-slate-800" name="remember">
                <span class="ms-2 text-xs text-slate-300 select-none">Ingat saya di perangkat ini</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-500 active:scale-98 shadow-lg shadow-emerald-600/30 transition duration-150">
                <span>Masuk Sekarang</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>

        <!-- Helper hint -->
        <div class="pt-4 border-t border-slate-700/60 text-center">
            <p class="text-[11px] text-slate-400">
                Akun Admin Default: <code class="text-emerald-400 bg-slate-900/80 px-1.5 py-0.5 rounded font-mono">admin@perpus</code> | <code class="text-emerald-400 bg-slate-900/80 px-1.5 py-0.5 rounded font-mono">password</code>
            </p>
        </div>
    </form>
</x-guest-layout>
