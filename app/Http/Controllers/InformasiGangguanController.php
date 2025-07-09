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
        // $gangguans = InformasiGangguan::with('laporanGangguan')->get();
        $gangguans = InformasiGangguan::all();

        return view('admin.informasi-gangguan.index', compact('gangguans'));
    }


    public function create()
    {
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
        $gangguan = InformasiGangguan::findOrFail($id);

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

        $gangguan = InformasiGangguan::findOrFail($id);

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
        $gangguan = InformasiGangguan::findOrFail($id);

        return view('admin.informasi-gangguan.show', compact('gangguan'));
    }

    public function destroy($id)
    {
        $gangguan = InformasiGangguan::findOrFail($id);

        $gangguan->delete();

        return redirect()->route('admin.informasi-gangguan.index')
            ->with('success', 'Informasi gangguan berhasil dihapus.');
    }

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
}
