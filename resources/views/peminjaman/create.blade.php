<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-slate-800 dark:text-slate-100 leading-tight">
                    Tambah Transaksi Peminjaman
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Catat peminjaman buku oleh siswa / anggota perpustakaan
                </p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <!-- Header Card Banner -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4 text-white">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/10 rounded-xl backdrop-blur-xs">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white">Formulir Peminjaman</h3>
                        <p class="text-xs text-emerald-100">Pastikan ketersediaan stok buku dan identitas anggota</p>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                @if (isset($errors) && $errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900 text-rose-800 dark:text-rose-200 text-sm">
                        <div class="flex items-center gap-2 font-semibold mb-2">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terdapat kesalahan saat menyimpan:
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-xs text-rose-700 dark:text-rose-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Pilih Anggota -->
                    <div>
                        <label for="anggota_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                            Pilih Anggota / Siswa <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="anggota_id" name="anggota_id" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
                                <option value="" selected disabled>-- Pilih Anggota Peminjam --</option>
                                @foreach ($anggota as $item)
                                    <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                                        NIS: {{ $item->nis }} — {{ $item->nama }} (Kelas {{ $item->kelas }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-xs text-slate-400 mt-1.5">Pilih nama siswa yang terdaftar sebagai anggota perpustakaan</p>
                    </div>

                    <!-- Pilih Buku -->
                    <div>
                        <label for="buku_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                            Pilih Judul Buku <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="buku_id" name="buku_id" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
                                <option value="" selected disabled>-- Pilih Buku yang Tersedia --</option>
                                @foreach ($buku as $item)
                                    <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                                        [{{ $item->kode_buku }}] {{ $item->judul }} &bull; Stok Tersedia: {{ $item->stok }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400 mt-1.5">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Stok buku akan otomatis berkurang sebanyak 1 saat disimpan.
                        </div>
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div>
                        <label for="tanggal_pinjam" class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                            Tanggal Peminjaman <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative w-full sm:w-64">
                            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required
                                class="w-full px-4 py-2.5 rounded-xl text-sm border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white focus:bg-white dark:focus:bg-slate-900 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-6 border-t border-slate-200 dark:border-slate-700/80 flex items-center justify-between">
                        <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md shadow-emerald-600/20 active:scale-95 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>