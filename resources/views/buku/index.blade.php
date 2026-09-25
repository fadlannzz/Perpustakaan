<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white tracking-tight">
                        Katalog Buku
                    </h2>
                    <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        {{ $buku->count() }} Data
                    </span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Kelola koleksi bahan pustaka, ketersediaan stok, dan informasi buku perpustakaan
                </p>
            </div>
            <div>
                <a href="{{ route('buku.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-emerald-600/20 uppercase tracking-wider transition transform active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Buku Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Stat Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Judul Buku</span>
                    <h3 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">{{ $totalJudul ?? $buku->count() }}</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                </div>
                <div>
                    <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Stok Fisik</span>
                    <h3 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">{{ $totalStok ?? $buku->sum('stok') }}</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Buku Stok Habis</span>
                    <h3 class="text-2xl font-extrabold {{ ($stokHabis ?? 0) > 0 ? 'text-rose-600' : 'text-slate-800 dark:text-slate-100' }}">
                        {{ $stokHabis ?? 0 }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card Table Utama -->
        <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <!-- Filter Bar -->
            <div class="p-5 border-b border-slate-200 dark:border-slate-700/80 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50/50 dark:bg-slate-800/50">
                <form action="{{ route('buku.index') }}" method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul, pengarang, penerbit, atau kode buku..."
                            class="w-full pl-9 pr-24 py-2 text-sm rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
                        
                        <div class="absolute inset-y-0 right-1 flex items-center gap-1">
                            @if(!empty($search))
                                <a href="{{ route('buku.index') }}" class="px-2 py-1 text-xs text-slate-400 hover:text-slate-600 dark:hover:text-white" title="Reset Pencarian">
                                    &times;
                                </a>
                            @endif
                            <button type="submit" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold transition">
                                Cari
                            </button>
                        </div>
                    </div>
                </form>

                @if(!empty($search))
                    <div class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1">
                        Menampilkan hasil untuk: <span class="font-bold text-slate-800 dark:text-slate-200">"{{ $search }}"</span>
                        <a href="{{ route('buku.index') }}" class="text-emerald-600 underline hover:text-emerald-700 ms-1">Tampilkan Semua</a>
                    </div>
                @endif
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            <th class="px-6 py-3.5 text-left w-12">No</th>
                            <th class="px-6 py-3.5 text-left">Kode</th>
                            <th class="px-6 py-3.5 text-left">Informasi Buku</th>
                            <th class="px-6 py-3.5 text-left">Penerbit</th>
                            <th class="px-6 py-3.5 text-center">Tahun</th>
                            <th class="px-6 py-3.5 text-center">Stok</th>
                            <th class="px-6 py-3.5 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-sm">
                        @forelse ($buku as $index => $item)
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/40 transition-colors">
                                <td class="px-6 py-4 text-xs text-slate-400 font-medium">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 text-xs font-mono font-bold rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600">
                                        {{ $item->kode_buku }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 dark:text-white hover:text-emerald-600 transition">
                                        {{ $item->judul }}
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-1 mt-0.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        {{ $item->pengarang }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300 text-xs">
                                    {{ $item->penerbit }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-xs text-slate-600 dark:text-slate-300 font-medium">
                                    {{ $item->tahun_terbit }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($item->stok > 3)
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                            {{ $item->stok }} Tersedia
                                        </span>
                                    @elseif($item->stok > 0)
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                            {{ $item->stok }} Menipis
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-rose-50 text-rose-700 dark:bg-rose-950 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ route('buku.edit', $item->id) }}" class="p-1.5 rounded-lg text-amber-600 hover:text-amber-700 hover:bg-amber-50 dark:hover:bg-amber-950/40 transition" title="Edit Buku">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>

                                        <form id="delete-form-{{ $item->id }}" action="{{ route('buku.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->judul) }}')" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition" title="Hapus Buku">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="max-w-xs mx-auto flex flex-col items-center">
                                        <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <h4 class="font-bold text-slate-700 dark:text-slate-200 text-sm">Tidak Ada Data Buku</h4>
                                        <p class="text-xs text-slate-400 mt-1">
                                            @if(!empty($search))
                                                Tidak ditemukan buku dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain.
                                            @else
                                                Belum ada koleksi buku yang ditambahkan ke sistem.
                                            @endif
                                        </p>
                                        @if(!empty($search))
                                            <a href="{{ route('buku.index') }}" class="mt-3 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                                Reset Pencarian
                                            </a>
                                        @else
                                            <a href="{{ route('buku.create') }}" class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                                + Tambah Buku Sekarang
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(id, judul) {
            Swal.fire({
                title: 'Hapus Buku ini?',
                text: `Buku "${judul}" akan dihapus secara permanen dari sistem!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-4 py-2 font-bold text-sm',
                    cancelButton: 'rounded-xl px-4 py-2 font-semibold text-sm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>