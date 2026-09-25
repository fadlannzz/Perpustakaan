<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan Daftar Transaksi Peminjaman
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Peminjaman::with(['buku', 'anggota']);

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('anggota', function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%")
                        ->orWhere('kelas', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($sub) use ($search) {
                    $sub->where('judul', 'like', "%{$search}%")
                        ->orWhere('kode_buku', 'like', "%{$search}%");
                });
            });
        }

        $peminjaman = $query->latest()->get();
        $totalTransaksi = Peminjaman::count();
        $sedangDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $sudahKembali = Peminjaman::where('status', 'kembali')->count();

        return view('peminjaman.index', compact('peminjaman', 'search', 'totalTransaksi', 'sedangDipinjam', 'sudahKembali'));
    }

    /**
     * Menampilkan Form Transaksi Baru
     */
    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $anggota = Anggota::all();

        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    /**
     * Menyimpan Transaksi Peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku ini sedang habis, tidak dapat dipinjam.');
        }

        // Simpan Transaksi
        Peminjaman::create([
            'buku_id' => $request->buku_id,
            'anggota_id' => $request->anggota_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Transaksi peminjaman berhasil dicatat!');
    }

    /**
     * Mengembalikan Buku
     */
    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'kembali') {
            return back()->with('error', 'Buku sudah dalam status dikembalikan.');
        }

        $peminjaman->update([
            'status' => 'kembali',
            'tanggal_kembali' => now()->toDateString(),
        ]);

        if ($peminjaman->buku) {
            $peminjaman->buku->increment('stok');
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui!');
    }

    /**
     * Menghapus Riwayat Transaksi
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Jika masih dipinjam, kembalikan stok sebelum dihapus
        if ($peminjaman->status === 'dipinjam' && $peminjaman->buku) {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data transaksi berhasil dihapus!');
    }
}
