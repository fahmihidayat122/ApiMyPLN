<?php

namespace App\Http\Controllers;

use App\Models\InformasiGangguan;
use App\Models\LaporanGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiGangguanController extends Controller
{
    public function index()
    {
        // Ambil semua data informasi gangguan dari database
        // $gangguans = InformasiGangguan::with('laporanGangguan')->get();
        $gangguans = InformasiGangguan::all();

        // Kirim data ke view
        return view('admin.informasi-gangguan.index', compact('gangguans'));
    }


    public function create()
    {
        // Ambil semua laporan gangguan yang tersedia
        // $laporanGangguans = LaporanGangguan::all();
        return view('admin.informasi-gangguan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            // 'laporan_gangguan_id' => 'required|exists:laporan_gangguans,id',
            'hari_tanggal' => 'required|date',
            'waktu' => 'required',
            'wilayah_pemeliharaan' => 'required|string',
            'informasi_gangguan' => 'required|string',
            'dampak_gangguan' => 'required|string',
            'status' => 'required|in:Belum Di Perbaiki,Sedang Di Perbaiki,Selesai Di Perbaiki',
        ]);

        InformasiGangguan::create($request->all());

        return redirect()->route('admin.informasi-gangguan.index')->with('success', 'Informasi gangguan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Cari data berdasarkan ID
        $gangguan = InformasiGangguan::findOrFail($id);

        // Tampilkan halaman edit dengan data yang ditemukan
        return view('admin.informasi-gangguan.edit', compact('gangguan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari_tanggal' => 'required|date',
            'waktu' => 'required',
            'wilayah_pemeliharaan' => 'required|string|max:255',
            'informasi_gangguan' => 'required|string',
            'dampak_gangguan' => 'required|string',
            'status' => 'required|in:Belum Di Perbaiki,Sedang Di Perbaiki,Selesai Di Perbaiki',
        ]);

        // Temukan data berdasarkan ID
        $gangguan = InformasiGangguan::findOrFail($id);

        // Update data dengan input dari form
        $gangguan->update([
            'hari_tanggal' => $request->hari_tanggal,
            'waktu' => $request->waktu,
            'wilayah_pemeliharaan' => $request->wilayah_pemeliharaan,
            'informasi_gangguan' => $request->informasi_gangguan,
            'dampak_gangguan' => $request->dampak_gangguan,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.informasi-gangguan.index')->with('success', 'Informasi gangguan berhasil diperbarui!');
    }

    public function show($id)
    {
        // Cari data gangguan berdasarkan ID
        $gangguan = InformasiGangguan::findOrFail($id);

        // Tampilkan halaman detail dengan data yang ditemukan
        return view('admin.informasi-gangguan.show', compact('gangguan'));
    }

    public function destroy($id)
    {
        // Cari data gangguan berdasarkan ID
        $gangguan = InformasiGangguan::findOrFail($id);

        // Hapus data dari database
        $gangguan->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.informasi-gangguan.index')
            ->with('success', 'Informasi gangguan berhasil dihapus.');
    }

    // ✅ Ambil semua data gangguan
    public function getByInformasiGangguan()
    {
        try {
            $data = InformasiGangguan::all();
            return response()->json([
                'success' => true,
                'message' => 'Daftar Informasi Gangguan',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }





























    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     try {
    //         $informasiGangguan = InformasiGangguan::all();

    //         if ($informasiGangguan->isEmpty()) {
    //             return response()->json(['message' => 'Belum ada informasi gangguan yang tersedia'], 404);
    //         }

    //         return response()->json([
    //             'message' => 'Semua informasi gangguan berhasil diambil',
    //             'data' => $informasiGangguan,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Terjadi kesalahan saat mengambil data informasi gangguan', 'error' => $e->getMessage()], 500);
    //     }
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  * Admin menerima laporan gangguan dari user lalu mengubahnya menjadi informasi gangguan
    //  */
    // public function store(Request $request)
    // {
    //     try {
    //         $admin = Auth::user();
    //         if (!$admin) {
    //             return response()->json(['message' => 'Unauthorized, hanya admin yang dapat membuat informasi gangguan'], 403);
    //         }

    //         $request->validate([
    //             'laporan_gangguan_id' => 'required|exists:laporan_gangguans,id',
    //             'hari_tanggal' => 'required|date',
    //             'waktu' => 'required|date_format:H:i',
    //             'wilayah_pemeliharaan' => 'required|string',
    //             'informasi_gangguan' => 'required|string',
    //             'dampak_gangguan' => 'required|string',
    //         ]);

    //         $informasiGangguan = InformasiGangguan::create([
    //             'laporan_gangguan_id' => $request->laporan_gangguan_id,
    //             'hari_tanggal' => $request->hari_tanggal,
    //             'waktu' => $request->waktu,
    //             'wilayah_pemeliharaan' => $request->wilayah_pemeliharaan,
    //             'informasi_gangguan' => $request->informasi_gangguan,
    //             'dampak_gangguan' => $request->dampak_gangguan,
    //         ]);

    //         return response()->json([
    //             'message' => 'Informasi gangguan berhasil dibuat dari laporan gangguan',
    //             'data' => $informasiGangguan,
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat menyimpan informasi gangguan',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    // /**
    //  * Display the specified resource.
    //  */
    // public function show($id)
    // {
    //     try {
    //         $informasiGangguan = InformasiGangguan::find($id);

    //         if (!$informasiGangguan) {
    //             return response()->json(['message' => 'Informasi gangguan tidak ditemukan'], 404);
    //         }

    //         return response()->json([
    //             'message' => 'Informasi gangguan berhasil diambil',
    //             'data' => $informasiGangguan,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Terjadi kesalahan saat mengambil informasi gangguan', 'error' => $e->getMessage()], 500);
    //     }
    // }
    // public function getByLaporanGangguan($laporan_gangguan_id)
    // {
    //     try {
    //         $informasiGangguan = InformasiGangguan::where('laporan_gangguan_id', $laporan_gangguan_id)->get();

    //         if ($informasiGangguan->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Belum ada informasi gangguan untuk laporan ini'
    //             ], 404);
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Informasi gangguan ditemukan',
    //             'data' => $informasiGangguan
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
