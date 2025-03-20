<?php

namespace App\Http\Controllers;

use App\Models\LaporanGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaporanGangguanController extends Controller
{
    public function index()
    {
        $laporans = LaporanGangguan::latest()->get();
        return view('admin.laporan-gangguan.index', compact('laporans'));
    }


    public function show($id)
    {
        $laporan = LaporanGangguan::find($id);
        return view('admin.laporan-gangguan.show', compact('laporan'));
    }

    public function destroy($id)
    {
        $laporan = LaporanGangguan::find($id);
        $laporan->delete();

        return redirect()->route('admin.laporan-gangguan.index')->with('success', 'Laporan gangguan berhasil dihapus.');
    }

    // Ambil semua laporan untuk admin
    public function indexLaporan()
    {
        $laporans = LaporanGangguan::latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $laporans
        ], 200);
    }

    // Simpan laporan dari user
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required|string|max:15',
            'no_id' => 'required|string|max:50',
            'lokasi_gangguan' => 'required|string|max:255',
            'deskripsi_laporan' => 'required|string',
            //'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto opsional
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Simpan gambar jika ada
        // $fotoPath = null;
        // if ($request->hasFile('foto')) {
        //     $fotoPath = $request->file('foto')->store('laporan_gangguan', 'public');
        // }

        // Simpan data laporan
        $laporan = LaporanGangguan::create([
            'no_hp' => $request->no_hp,
            'no_id' => $request->no_id,
            'lokasi_gangguan' => $request->lokasi_gangguan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
            // 'foto' => $fotoPath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil dikirim',
            'data' => $laporan
        ], 201);
    }

    // Ambil detail laporan berdasarkan ID
    public function showLaporan($id)
    {
        $laporan = LaporanGangguan::find($id);
        if (!$laporan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $laporan
        ], 200);
    }




    /**
     * Menampilkan semua laporan gangguan (hanya untuk admin).
     */
    // public function index()
    // {
    //     try {
    //         $laporanGangguan = LaporanGangguan::all();

    //         if ($laporanGangguan->isEmpty()) {
    //             return response()->json([
    //                 'message' => 'Belum ada laporan gangguan yang tersedia',
    //             ], 404);
    //         }

    //         return response()->json([
    //             'message' => 'Semua laporan gangguan berhasil diambil',
    //             'data' => $laporanGangguan,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat mengambil laporan gangguan',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // /**
    //  * User membuat laporan gangguan.
    //  */
    // public function store(Request $request)
    // {
    //     try {
    //         // Validasi input
    //         $request->validate([
    //             'no_hp' => 'required|string|max:15',
    //             'no_id' => 'required|string|max:50',
    //             'lokasi_gangguan' => 'required|string|max:255',
    //             'deskripsi_laporan' => 'required|string',
    //         ]);

    //         // Buat laporan gangguan
    //         $laporanGangguan = LaporanGangguan::create($request->all());

    //         return response()->json([
    //             'message' => 'Laporan gangguan berhasil ditambahkan',
    //             'data' => $laporanGangguan,
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat menyimpan laporan gangguan',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // /**
    //  * Menampilkan detail laporan gangguan berdasarkan ID.
    //  */
    // public function show($id)
    // {
    //     try {
    //         $laporanGangguan = LaporanGangguan::findOrFail($id);

    //         return response()->json([
    //             'message' => 'Laporan gangguan berhasil ditampilkan',
    //             'data' => $laporanGangguan,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Laporan gangguan tidak ditemukan',
    //             'error' => $e->getMessage(),
    //         ], 404);
    //     }
    // }

    // /**
    //  * Admin menghapus laporan gangguan.
    //  */
    // public function destroy($id)
    // {
    //     try {
    //         $laporanGangguan = LaporanGangguan::findOrFail($id);
    //         $laporanGangguan->delete();

    //         return response()->json([
    //             'message' => 'Laporan gangguan berhasil dihapus',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat menghapus laporan gangguan',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
