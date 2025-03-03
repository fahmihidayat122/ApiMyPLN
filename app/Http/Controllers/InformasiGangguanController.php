<?php

namespace App\Http\Controllers;

use App\Models\InformasiGangguan;
use App\Models\LaporanGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiGangguanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $informasiGangguan = InformasiGangguan::all();

            if ($informasiGangguan->isEmpty()) {
                return response()->json(['message' => 'Belum ada informasi gangguan yang tersedia'], 404);
            }

            return response()->json([
                'message' => 'Semua informasi gangguan berhasil diambil',
                'data' => $informasiGangguan,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data informasi gangguan', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * Admin menerima laporan gangguan dari user lalu mengubahnya menjadi informasi gangguan
     */
    public function store(Request $request)
    {
        try {
            $admin = Auth::user();
            if (!$admin) {
                return response()->json(['message' => 'Unauthorized, hanya admin yang dapat membuat informasi gangguan'], 403);
            }

            $request->validate([
                'laporan_gangguan_id' => 'required|exists:laporan_gangguans,id',
                'hari_tanggal' => 'required|date',
                'waktu' => 'required|date_format:H:i',
                'wilayah_pemeliharaan' => 'required|string',
                'informasi_gangguan' => 'required|string',
                'dampak_gangguan' => 'required|string',
            ]);

            $informasiGangguan = InformasiGangguan::create([
                'laporan_gangguan_id' => $request->laporan_gangguan_id,
                'hari_tanggal' => $request->hari_tanggal,
                'waktu' => $request->waktu,
                'wilayah_pemeliharaan' => $request->wilayah_pemeliharaan,
                'informasi_gangguan' => $request->informasi_gangguan,
                'dampak_gangguan' => $request->dampak_gangguan,
            ]);

            return response()->json([
                'message' => 'Informasi gangguan berhasil dibuat dari laporan gangguan',
                'data' => $informasiGangguan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan informasi gangguan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $informasiGangguan = InformasiGangguan::find($id);

            if (!$informasiGangguan) {
                return response()->json(['message' => 'Informasi gangguan tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Informasi gangguan berhasil diambil',
                'data' => $informasiGangguan,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil informasi gangguan', 'error' => $e->getMessage()], 500);
        }
    }
    public function getByLaporanGangguan($laporan_gangguan_id)
    {
        try {
            $informasiGangguan = InformasiGangguan::where('laporan_gangguan_id', $laporan_gangguan_id)->get();

            if ($informasiGangguan->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Belum ada informasi gangguan untuk laporan ini'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Informasi gangguan ditemukan',
                'data' => $informasiGangguan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
