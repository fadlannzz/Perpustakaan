<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route terproteksi: Hanya admin yang sudah login yang dapat mengelola aplikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Halaman Dashboard Perpustakaan
    Route::get('/dashboard', function () {
        $totalBuku = Buku::count();
        $totalStok = (int) Buku::sum('stok');
        $totalAnggota = Anggota::count();
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $recentPeminjaman = Peminjaman::with(['buku', 'anggota'])->latest()->take(5)->get();
        $recentBuku = Buku::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalStok',
            'totalAnggota',
            'peminjamanAktif',
            'recentPeminjaman',
            'recentBuku'
        ));
    })->name('dashboard');

    // CRUD Data Buku
    Route::resource('buku', BukuController::class);

    // Transaksi Peminjaman
    Route::patch('peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::resource('peminjaman', PeminjamanController::class);

    // Profile Management bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
