<?php

namespace App\Http\Controllers;

use App\Models\InformasiPemadaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InformasiPemadamanController extends Controller
{
    public function index()
    {
        $pemadamans = InformasiPemadaman::all();

        return view('admin.informasi-pemadaman.index', compact('pemadamans'));
    }

    public function getInformasiPemadaman()
    {
        $data = InformasiPemadaman::orderBy('hari_tanggal', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pemadaman',
            'data' => $data
        ], 200);
    }




    public function create()
    {
        return view('admin.informasi-pemadaman.create');
    }



    public function store(Request $request)
    {
        // dd($request->all());

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
        $pemadaman = InformasiPemadaman::findOrFail($id);

        return view('admin.informasi-pemadaman.show', compact('pemadaman'));
    }


    public function destroy($id)
    {
        $pemadaman = InformasiPemadaman::findOrFail($id);
        $pemadaman->delete();

        return redirect()->route('admin.informasi-pemadaman.index')->with('success', 'Informasi Pemadaman berhasil dihapus.');
    }
}
