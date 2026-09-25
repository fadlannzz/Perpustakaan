<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-slate-800 dark:text-slate-100 leading-tight">
                    Edit Data Buku
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Perbarui informasi pustaka "{{ $buku->judul }}"
                </p>
            </div>
            <a href="{{ route('buku.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <!-- Header Card Banner -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4 text-white">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/10 rounded-xl backdrop-blur-xs">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white">Perbarui Data Buku</h3>
                        <p class="text-xs text-amber-100">Kode Buku: <span class="font-mono font-bold">{{ $buku->kode_buku }}</span></p>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                @if (isset($errors) && $errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 text-rose-800 dark:text-rose-200 text-sm">
                        <div class="flex items-center gap-2 font-semibold mb-2">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terdapat beberapa kesalahan pengisian:
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-xs text-rose-700 dark:text-rose-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('buku.update', $buku->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Kode Buku -->
                        <div>
                            <label for="kode_buku" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Kode Buku <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                </span>
                                <input type="text" id="kode_buku" name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku) }}" required
                                    class="w-full pl-9 pr-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition">
                            </div>
                        </div>

                        <!-- Tahun Terbit -->
                        <div>
                            <label for="tahun_terbit" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Tahun Terbit <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') + 1 }}" required
                                    class="w-full pl-9 pr-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition">
                            </div>
                        </div>
                    </div>

                    <!-- Judul Buku -->
                    <div>
                        <label for="judul" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                            Judul Buku <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required
                            class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Pengarang -->
                        <div>
                            <label for="pengarang" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Nama Pengarang <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition">
                        </div>

                        <!-- Penerbit -->
                        <div>
                            <label for="penerbit" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Nama Penerbit <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition">
                        </div>
                    </div>

                    <!-- Stok Buku -->
                    <div>
                        <label for="stok" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                            Jumlah Stok Tersedia <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative w-full sm:w-48">
                            <input type="number" id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition">
                            <span class="absolute inset-y-0 right-0 pr-4 flex items-center text-xs text-slate-400 font-medium pointer-events-none">
                                Eksemplar
                            </span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-6 border-t border-slate-200 dark:border-slate-700/80 flex items-center justify-between">
                        <a href="{{ route('buku.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-amber-500 hover:bg-amber-600 shadow-md shadow-amber-500/20 active:scale-95 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Perbarui Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>