<?php

namespace App\Http\Controllers;

use App\Models\LaporanGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaporanGangguanController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanGangguan::query();

        if ($request->filled('no_hp')) {
            $query->where('no_hp', 'like', '%' . $request->no_hp . '%');
        }

        if ($request->filled('no_id')) {
            $query->where('no_id', 'like', '%' . $request->no_id . '%');
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $laporans = $query->latest()->get();

        return view('admin.laporan-gangguan.index', compact('laporans'));
    }
    public function show($id)
    {
        $laporan = LaporanGangguan::find($id);

        if (!$laporan) {
            return redirect()->route('admin.laporan-gangguan.index')->with('error', 'Laporan tidak ditemukan.');
        }

        return view('admin.laporan-gangguan.show', compact('laporan'));
    }
    public function destroy($id)
    {
        $laporan = LaporanGangguan::find($id);

        if (!$laporan) {
            return redirect()->route('admin.laporan-gangguan.index')->with('error', 'Laporan tidak ditemukan.');
        }

        $laporan->delete();

        return redirect()->route('admin.laporan-gangguan.index')->with('success', 'Laporan gangguan berhasil dihapus.');
    }
    public function indexLaporan()
    {
        $laporans = LaporanGangguan::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $laporans
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required|string|max:15',
            'no_id' => 'required|string|max:50',
            'lokasi_gangguan' => 'required|string|max:255',
            'deskripsi_laporan' => 'required|string',
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $laporan = LaporanGangguan::create([
            'no_hp' => $request->no_hp,
            'no_id' => $request->no_id,
            'lokasi_gangguan' => $request->lokasi_gangguan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil dikirim.',
            'data' => $laporan
        ], 201);
    }
    public function showLaporan($id)
    {
        $laporan = LaporanGangguan::find($id);

        if (!$laporan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Laporan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $laporan
        ], 200);
    }
}
