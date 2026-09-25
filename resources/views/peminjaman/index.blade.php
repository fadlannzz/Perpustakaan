<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white tracking-tight">
                        Transaksi Peminjaman
                    </h2>
                    <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                        {{ $peminjaman->count() }} Transaksi
                    </span>
                </div>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Pantau sirkulasi peminjaman, pengembalian buku, dan riwayat anggota perpustakaan
                </p>
            </div>
            <div>
                <a href="{{ route('peminjaman.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-emerald-600/20 uppercase tracking-wider transition transform active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Transaksi Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Stat Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-950/60 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Total Riwayat Transaksi</span>
                    <h3 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">{{ $totalTransaksi ?? $peminjaman->count() }}</h3>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Sedang Dipinjam</span>
                    <h3 class="text-2xl font-extrabold text-amber-600 dark:text-amber-400">
                        {{ $sedangDipinjam ?? $peminjaman->where('status', 'dipinjam')->count() }}
                    </h3>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200/80 dark:border-slate-700/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Buku Sudah Kembali</span>
                    <h3 class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">
                        {{ $sudahKembali ?? $peminjaman->where('status', 'kembali')->count() }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Card Table Utama -->
        <div class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80 overflow-hidden">
            <!-- Filter Bar -->
            <div class="p-5 border-b border-slate-200 dark:border-slate-700/80 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50/50 dark:bg-slate-800/50">
                <form action="{{ route('peminjaman.index') }}" method="GET" class="flex-1 max-w-md">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama anggota, NIS, kelas, atau judul buku..."
                            class="w-full pl-9 pr-24 py-2 text-sm rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-800 dark:text-white focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition">
                        
                        <div class="absolute inset-y-0 right-1 flex items-center gap-1">
                            @if(!empty($search))
                                <a href="{{ route('peminjaman.index') }}" class="px-2 py-1 text-xs text-slate-400 hover:text-slate-600 dark:hover:text-white" title="Reset Pencarian">
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
                        <a href="{{ route('peminjaman.index') }}" class="text-emerald-600 underline hover:text-emerald-700 ms-1">Tampilkan Semua</a>
                    </div>
                @endif
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                            <th class="px-6 py-3.5 text-left w-12">No</th>
                            <th class="px-6 py-3.5 text-left">Peminjam / Anggota</th>
                            <th class="px-6 py-3.5 text-left">Buku yang Dipinjam</th>
                            <th class="px-6 py-3.5 text-center">Tanggal Pinjam</th>
                            <th class="px-6 py-3.5 text-center">Status</th>
                            <th class="px-6 py-3.5 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-sm">
                        @forelse ($peminjaman as $index => $item)
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/40 transition-colors">
                                <td class="px-6 py-4 text-xs text-slate-400 font-medium">
                                    {{ $index + 1 }}
                                </td>

                                <!-- Anggota -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                            {{ substr($item->anggota->nama ?? 'A', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 dark:text-white">
                                                {{ $item->anggota->nama ?? 'Anggota Dihapus' }}
                                            </div>
                                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                                <span>NIS: {{ $item->anggota->nis ?? '-' }}</span>
                                                <span>&bull;</span>
                                                <span class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-700 font-medium text-[10px]">
                                                    Kelas {{ $item->anggota->kelas ?? '-' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Buku -->
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-800 dark:text-slate-100">
                                        {{ $item->buku->judul ?? 'Buku Dihapus' }}
                                    </div>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-mono font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600">
                                            {{ $item->buku->kode_buku ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Tanggal Pinjam & Kembali -->
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                        {{ date('d M Y', strtotime($item->tanggal_pinjam)) }}
                                    </div>
                                    @if($item->tanggal_kembali)
                                        <div class="text-[11px] text-emerald-600 dark:text-emerald-400 mt-0.5">
                                            Kembali: {{ date('d M Y', strtotime($item->tanggal_kembali)) }}
                                        </div>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($item->status == 'dipinjam')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Sedang Dipinjam
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($item->status == 'dipinjam')
                                            <form id="kembalikan-form-{{ $item->id }}" action="{{ route('peminjaman.kembalikan', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" onclick="confirmKembalikan({{ $item->id }}, '{{ addslashes($item->buku->judul ?? 'buku ini') }}')" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/60 dark:hover:bg-emerald-900 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 transition" title="Tandai Sudah Dikembalikan">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @endif

                                        <form id="delete-peminjaman-{{ $item->id }}" action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDeletePeminjaman({{ $item->id }})" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition" title="Hapus Riwayat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="max-w-xs mx-auto flex flex-col items-center">
                                        <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <h4 class="font-bold text-slate-700 dark:text-slate-200 text-sm">Tidak Ada Transaksi Peminjaman</h4>
                                        <p class="text-xs text-slate-400 mt-1">
                                            @if(!empty($search))
                                                Tidak ditemukan data peminjaman yang cocok dengan "{{ $search }}".
                                            @else
                                                Belum ada aktivitas sirkulasi buku yang tercatat di sistem.
                                            @endif
                                        </p>
                                        @if(!empty($search))
                                            <a href="{{ route('peminjaman.index') }}" class="mt-3 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                                Reset Pencarian
                                            </a>
                                        @else
                                            <a href="{{ route('peminjaman.create') }}" class="mt-3 inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                                + Buat Transaksi Baru
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
        function confirmKembalikan(id, judul) {
            Swal.fire({
                title: 'Konfirmasi Pengembalian',
                text: `Tandai buku "${judul}" telah dikembalikan? Stok buku akan bertambah 1.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl px-4 py-2 font-bold text-sm',
                    cancelButton: 'rounded-xl px-4 py-2 font-semibold text-sm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`kembalikan-form-${id}`).submit();
                }
            });
        }

        function confirmDeletePeminjaman(id) {
            Swal.fire({
                title: 'Hapus Transaksi?',
                text: 'Riwayat transaksi ini akan dihapus dari sistem.',
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
                    document.getElementById(`delete-peminjaman-${id}`).submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>