<?php

namespace App\Http\Controllers;

use App\Models\LaporanGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanGangguanController extends Controller
{
    /**
     * Menampilkan semua laporan gangguan (hanya untuk admin).
     */
    public function index()
    {
        try {
            $laporanGangguan = LaporanGangguan::all();

            if ($laporanGangguan->isEmpty()) {
                return response()->json([
                    'message' => 'Belum ada laporan gangguan yang tersedia',
                ], 404);
            }

            return response()->json([
                'message' => 'Semua laporan gangguan berhasil diambil',
                'data' => $laporanGangguan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil laporan gangguan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * User membuat laporan gangguan.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'no_hp' => 'required|string|max:15',
                'no_id' => 'required|string|max:50',
                'lokasi_gangguan' => 'required|string|max:255',
                'deskripsi_laporan' => 'required|string',
            ]);

            // Buat laporan gangguan
            $laporanGangguan = LaporanGangguan::create($request->all());

            return response()->json([
                'message' => 'Laporan gangguan berhasil ditambahkan',
                'data' => $laporanGangguan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan laporan gangguan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan detail laporan gangguan berdasarkan ID.
     */
    public function show($id)
    {
        try {
            $laporanGangguan = LaporanGangguan::findOrFail($id);

            return response()->json([
                'message' => 'Laporan gangguan berhasil ditampilkan',
                'data' => $laporanGangguan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Laporan gangguan tidak ditemukan',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Admin menghapus laporan gangguan.
     */
    public function destroy($id)
    {
        try {
            $laporanGangguan = LaporanGangguan::findOrFail($id);
            $laporanGangguan->delete();

            return response()->json([
                'message' => 'Laporan gangguan berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus laporan gangguan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
