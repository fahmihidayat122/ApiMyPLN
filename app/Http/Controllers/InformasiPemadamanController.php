<?php

namespace App\Http\Controllers;

use App\Models\InformasiPemadaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InformasiPemadamanController extends Controller
{
    /**
     * Menampilkan daftar informasi pemadaman.
     */
    public function index()
    {
        try {
            $informasiPemadaman = InformasiPemadaman::with('admin')->get();

            if ($informasiPemadaman->isEmpty()) {
                return response()->json([
                    'message' => 'Belum ada informasi pemadaman yang tersedia',
                ], 404);
            }

            return response()->json([
                'message' => 'Semua informasi pemadaman berhasil diambil',
                'data' => $informasiPemadaman,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data informasi pemadaman',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menyimpan informasi pemadaman baru.
     */
    public function store(Request $request)
    {
        try {
            // Ambil user yang sedang login (harus admin)
            $admin = Auth::user();
            if (!$admin) {
                return response()->json([
                    'message' => 'Unauthorized, admin tidak ditemukan',
                ], 403);
            }

            // Validasi input
            $request->validate([
                'hari_tanggal' => 'required|date_format:Y-m-d',
                'waktu' => 'required|date_format:H:i',
                'wilayah_pemeliharaan' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:500',
            ]);

            // Simpan data
            $informasiPemadaman = InformasiPemadaman::create([
                'admin_id' => $admin->id, // Ambil ID dari user yang login
                'hari_tanggal' => $request->hari_tanggal,
                'waktu' => $request->waktu,
                'wilayah_pemeliharaan' => $request->wilayah_pemeliharaan,
                'pekerjaan' => $request->pekerjaan,
            ]);

            return response()->json([
                'message' => 'Informasi pemadaman berhasil dibuat',
                'data' => $informasiPemadaman,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan informasi pemadaman',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail informasi pemadaman berdasarkan ID.
     */
    public function show($id)
    {
        try {
            // Gunakan findOrFail untuk otomatis return 404 jika tidak ditemukan
            $informasiPemadaman = InformasiPemadaman::with('admin')->findOrFail($id);

            return response()->json([
                'message' => 'Informasi pemadaman berhasil diambil',
                'data' => $informasiPemadaman,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil informasi pemadaman',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mengupdate informasi pemadaman berdasarkan ID.
     */
    public function update(Request $request, InformasiPemadaman $informasiPemadaman)
    {
        try {
            // Pastikan user adalah admin
            $admin = Auth::user();
            if (!$admin) {
                return response()->json([
                    'message' => 'Unauthorized, admin tidak ditemukan',
                ], 403);
            }

            // Validasi input
            $request->validate([
                'hari_tanggal' => 'sometimes|date_format:Y-m-d',
                'waktu' => 'sometimes|date_format:H:i',
                'wilayah_pemeliharaan' => 'sometimes|string|max:255',
                'pekerjaan' => 'sometimes|string|max:500',
            ]);

            // Update data
            $informasiPemadaman->update($request->only(['hari_tanggal', 'waktu', 'wilayah_pemeliharaan', 'pekerjaan']));

            return response()->json([
                'message' => 'Informasi pemadaman berhasil diperbarui',
                'data' => $informasiPemadaman,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui informasi pemadaman',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menghapus informasi pemadaman.
     */
    public function destroy(InformasiPemadaman $informasiPemadaman)
    {
        try {
            $informasiPemadaman->delete();

            return response()->json([
                'message' => 'Informasi pemadaman berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus informasi pemadaman',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
