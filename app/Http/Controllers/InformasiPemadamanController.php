<?php

namespace App\Http\Controllers;

use App\Models\InformasiPemadaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InformasiPemadamanController extends Controller
{
    public function index()
    {
        // Ambil semua data informasi pemadaman dari database
        $pemadamans = InformasiPemadaman::all();

        // Kirim data ke view
        return view('admin.informasi-pemadaman.index', compact('pemadamans'));
    }

    public function getInformasiPemadaman()
    {
        $data = InformasiPemadaman::orderBy('tanggal', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pemadaman',
            'data' => $data
        ], 200);
    }



    public function create()
    {
        return view('admin.informasi-pemadaman.create'); // Pastikan ini sesuai dengan lokasi blade
    }



    public function store(Request $request)
    {
        // dd($request->all()); // Cek apakah hari_tanggal terkirim

        $request->validate([
            'hari_tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi_pemeliharaan' => 'required|string|max:255',
            'pekerjaan' => 'required|string'
        ]);

        InformasiPemadaman::create([
            'admin_id' => auth()->guard('admin')->id(),
            'hari_tanggal' => $request->hari_tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi_pemeliharaan' => $request->lokasi_pemeliharaan,
            'pekerjaan' => $request->pekerjaan
        ]);

        return redirect()->route('admin.informasi-pemadaman.index')
            ->with('success', 'Informasi pemadaman berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pemadaman = InformasiPemadaman::findOrFail($id);
        return view('admin.informasi-pemadaman.edit', compact('pemadaman'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'hari_tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi_pemeliharaan' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $pemadaman = InformasiPemadaman::findOrFail($id);
        $pemadaman->update($request->all());

        return redirect()->route('admin.informasi-pemadaman.index')->with('success', 'Data berhasil diperbarui');
    }

    public function show($id)
    {
        // Ambil data berdasarkan ID
        $pemadaman = InformasiPemadaman::findOrFail($id);

        // Tampilkan view detail dengan data pemadaman
        return view('admin.informasi-pemadaman.show', compact('pemadaman'));
    }


    public function destroy($id)
    {
        $pemadaman = InformasiPemadaman::findOrFail($id);
        $pemadaman->delete();

        return redirect()->route('admin.informasi-pemadaman.index')->with('success', 'Informasi Pemadaman berhasil dihapus.');
    }



























    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'hari_tanggal' => 'required|date',
    //         'waktu' => 'required',
    //         'lokasi_pemeliharaan' => 'required|string',
    //         'pekerjaan' => 'required|string',
    //     ]);

    //     InformasiPemadaman::create([
    //         'admin_id' => auth('admin')->id(), // Menggunakan guard admin
    //         'hari_tanggal' => $request->hari_tanggal,
    //         'waktu' => $request->waktu,
    //         'lokasi_pemeliharaan' => $request->lokasi_pemeliharaan,
    //         'pekerjaan' => $request->pekerjaan,
    //     ]);

    //     return redirect()->route('admin.informasi-pemadaman')->with('success', 'Informasi Pemadaman berhasil ditambahkan!');
    // }


    // public function edit($id)
    // {
    //     $pemadaman = InformasiPemadaman::findOrFail($id);
    //     return view('admin.informasi-pemadaman-edit', compact('pemadaman'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'hari_tanggal' => 'required|date',
    //         'waktu' => 'required',
    //         'lokasi_pemeliharaan' => 'required|string|max:255',
    //         'pekerjaan' => 'required|string|max:255',
    //     ]);

    //     $pemadaman = InformasiPemadaman::findOrFail($id);
    //     $pemadaman->update($request->all());

    //     return redirect()->route('admin.informasi-pemadaman')->with('success', 'Data pemadaman berhasil diperbarui!');
    // }

    // public function destroy($id)
    // {
    //     InformasiPemadaman::findOrFail($id)->delete();
    //     return redirect()->route('admin.informasi-pemadaman')->with('success', 'Data pemadaman berhasil dihapus!');
    // }








    /**
     * Menampilkan daftar informasi pemadaman.
     */
    // public function index()
    // {
    //     try {
    //         $informasiPemadaman = InformasiPemadaman::with('admin')->get();

    //         if ($informasiPemadaman->isEmpty()) {
    //             return response()->json([
    //                 'message' => 'Belum ada informasi pemadaman yang tersedia',
    //             ], 404);
    //         }

    //         return response()->json([
    //             'message' => 'Semua informasi pemadaman berhasil diambil',
    //             'data' => $informasiPemadaman,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat mengambil data informasi pemadaman',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // /**
    //  * Menyimpan informasi pemadaman baru.
    //  */
    // public function store(Request $request)
    // {
    //     try {
    //         // Ambil user yang sedang login (harus admin)
    //         $admin = Auth::user();
    //         if (!$admin) {
    //             return response()->json([
    //                 'message' => 'Unauthorized, admin tidak ditemukan',
    //             ], 403);
    //         }

    //         // Validasi input
    //         $request->validate([
    //             'hari_tanggal' => 'required|date_format:Y-m-d',
    //             'waktu' => 'required|date_format:H:i',
    //             'wilayah_pemeliharaan' => 'required|string|max:255',
    //             'pekerjaan' => 'required|string|max:500',
    //         ]);

    //         // Simpan data
    //         $informasiPemadaman = InformasiPemadaman::create([
    //             'admin_id' => $admin->id, // Ambil ID dari user yang login
    //             'hari_tanggal' => $request->hari_tanggal,
    //             'waktu' => $request->waktu,
    //             'wilayah_pemeliharaan' => $request->wilayah_pemeliharaan,
    //             'pekerjaan' => $request->pekerjaan,
    //         ]);

    //         return response()->json([
    //             'message' => 'Informasi pemadaman berhasil dibuat',
    //             'data' => $informasiPemadaman,
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat menyimpan informasi pemadaman',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // /**
    //  * Menampilkan detail informasi pemadaman berdasarkan ID.
    //  */
    // public function show($id)
    // {
    //     try {
    //         // Gunakan findOrFail untuk otomatis return 404 jika tidak ditemukan
    //         $informasiPemadaman = InformasiPemadaman::with('admin')->findOrFail($id);

    //         return response()->json([
    //             'message' => 'Informasi pemadaman berhasil diambil',
    //             'data' => $informasiPemadaman,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat mengambil informasi pemadaman',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // /**
    //  * Mengupdate informasi pemadaman berdasarkan ID.
    //  */
    // public function update(Request $request, InformasiPemadaman $informasiPemadaman)
    // {
    //     try {
    //         // Pastikan user adalah admin
    //         $admin = Auth::user();
    //         if (!$admin) {
    //             return response()->json([
    //                 'message' => 'Unauthorized, admin tidak ditemukan',
    //             ], 403);
    //         }

    //         // Validasi input
    //         $request->validate([
    //             'hari_tanggal' => 'sometimes|date_format:Y-m-d',
    //             'waktu' => 'sometimes|date_format:H:i',
    //             'wilayah_pemeliharaan' => 'sometimes|string|max:255',
    //             'pekerjaan' => 'sometimes|string|max:500',
    //         ]);

    //         // Update data
    //         $informasiPemadaman->update($request->only(['hari_tanggal', 'waktu', 'wilayah_pemeliharaan', 'pekerjaan']));

    //         return response()->json([
    //             'message' => 'Informasi pemadaman berhasil diperbarui',
    //             'data' => $informasiPemadaman,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat memperbarui informasi pemadaman',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    // /**
    //  * Menghapus informasi pemadaman.
    //  */
    // public function destroy(InformasiPemadaman $informasiPemadaman)
    // {
    //     try {
    //         $informasiPemadaman->delete();

    //         return response()->json([
    //             'message' => 'Informasi pemadaman berhasil dihapus',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Terjadi kesalahan saat menghapus informasi pemadaman',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
