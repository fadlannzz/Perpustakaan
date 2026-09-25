<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white tracking-tight">
                    Dashboard Utama
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Ringkasan performa dan aktivitas sistem informasi perpustakaan
                </p>
            </div>
            <div class="text-xs font-medium text-slate-500 dark:text-slate-400 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Welcome Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-800 p-6 sm:p-8 text-white shadow-lg shadow-emerald-950/10">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/15 backdrop-blur-md text-emerald-100 mb-3 border border-white/10">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Sistem Berjalan Normal
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Selamat Datang, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="mt-2 text-sm text-emerald-100/90 leading-relaxed">
                    Kelola sirkulasi buku, pantau stok bahan pustaka, dan catat transaksi peminjaman siswa dengan mudah dan terorganisir.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-emerald-800 font-bold text-xs uppercase tracking-wider hover:bg-emerald-50 transition shadow-sm active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Pinjam Buku Baru
                    </a>
                    <a href="{{ route('buku.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600/40 hover:bg-emerald-600/60 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Tambah Buku
                    </a>
                </div>
            </div>

            <!-- Background Aesthetic Shapes -->
            <div class="absolute -right-8 -bottom-10 w-64 h-64 rounded-full bg-white/5 blur-2xl pointer-events-none"></div>
            <div class="absolute right-12 top-6 opacity-10 hidden sm:block pointer-events-none">
                <svg class="w-56 h-56" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
        </div>

        <!-- 4 Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Koleksi Judul</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mt-1">{{ $totalBuku }}</h3>
                    <a href="{{ route('buku.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:underline mt-2">
                        Lihat Semua &rarr;
                    </a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Stok Fisik</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mt-1">{{ $totalStok }}</h3>
                    <span class="text-xs text-slate-400 mt-2 block">Eksemplar Buku</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Anggota Terdaftar</span>
                    <h3 class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mt-1">{{ $totalAnggota }}</h3>
                    <span class="text-xs text-slate-400 mt-2 block">Siswa & Anggota</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Peminjaman Aktif</span>
                    <h3 class="text-3xl font-extrabold text-amber-600 dark:text-amber-400 mt-1">{{ $peminjamanAktif }}</h3>
                    <a href="{{ route('peminjaman.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-amber-600 dark:text-amber-400 hover:underline mt-2">
                        Pantau Transaksi &rarr;
                    </a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- 2-Column Split: Recent Activity & Recent Books -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Recent Loans (2 Cols) -->
            <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-slate-700/80 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base text-slate-800 dark:text-slate-100">Peminjaman Terbaru</h3>
                        <p class="text-xs text-slate-400">5 transaksi aktivitas peminjaman terakhir</p>
                    </div>
                    <a href="{{ route('peminjaman.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700/60 text-xs">
                        <thead class="bg-slate-50 dark:bg-slate-900/50 uppercase font-semibold text-slate-400">
                            <tr>
                                <th class="px-5 py-3 text-left">Peminjam</th>
                                <th class="px-5 py-3 text-left">Buku</th>
                                <th class="px-5 py-3 text-center">Tgl Pinjam</th>
                                <th class="px-5 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            @forelse ($recentPeminjaman as $item)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <div class="font-bold text-slate-800 dark:text-slate-200">{{ $item->anggota->nama ?? '-' }}</div>
                                        <div class="text-[11px] text-slate-400">NIS: {{ $item->anggota->nis ?? '-' }} (Kelas {{ $item->anggota->kelas ?? '-' }})</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="font-medium text-slate-800 dark:text-slate-200 line-clamp-1">{{ $item->buku->judul ?? '-' }}</div>
                                        <div class="font-mono text-[10px] text-slate-400">{{ $item->buku->kode_buku ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-3.5 text-center whitespace-nowrap text-slate-600 dark:text-slate-300">
                                        {{ date('d M Y', strtotime($item->tanggal_pinjam)) }}
                                    </td>
                                    <td class="px-5 py-3.5 text-center whitespace-nowrap">
                                        @if($item->status == 'dipinjam')
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                Kembali
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-slate-400">
                                        Belum ada riwayat transaksi peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Books (1 Col) -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 shadow-xs overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-slate-700/80 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base text-slate-800 dark:text-slate-100">Koleksi Baru</h3>
                        <p class="text-xs text-slate-400">Buku yang baru ditambahkan</p>
                    </div>
                    <a href="{{ route('buku.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                        Katalog
                    </a>
                </div>

                <div class="p-5 space-y-4">
                    @forelse ($recentBuku as $book)
                        <div class="flex items-center justify-between gap-3 pb-3 border-b border-slate-100 dark:border-slate-700/50 last:border-0 last:pb-0">
                            <div class="min-w-0">
                                <h4 class="font-bold text-xs text-slate-800 dark:text-slate-200 truncate">{{ $book->judul }}</h4>
                                <div class="text-[11px] text-slate-400 truncate">{{ $book->pengarang }} &bull; {{ $book->tahun_terbit }}</div>
                            </div>
                            <span class="px-2 py-0.5 text-[10px] font-mono font-bold rounded bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 shrink-0">
                                {{ $book->stok }} eks
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-slate-400">
                            Belum ada buku ditambahkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
