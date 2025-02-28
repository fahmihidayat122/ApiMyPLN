<?php

namespace App\Http\Controllers;

use App\Models\LaporanGangguan;
use Illuminate\Http\Request;

class LaporanGangguanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanGangguan = LaporanGangguan::all();
        return response()->json($laporanGangguan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = LaporanGangguan::create($data = $request->all());
            return response()->json([
                "success" => true,
                "massage" => "Laporan Gangguan Berhasil Di tambahkan",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "massage" => $e->getMessage(),
                "data" => $request->all()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = LaporanGangguan::find($id);
            if (!$data) {
                return response()->json([
                    "success" => false,
                    "massage" => "id " . $id . " Tidak Ditemukan",
                ]);
            }
            return response()->json([
                "success" => true,
                "massage" => "Laporan Gangguan Berhasil Di tampilkan",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "massage" => "Laporan Gangguan Tidak Ditemukan" . $e->getMessage(),
                "data" => $id
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanGangguan $laporanGangguan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanGangguan $laporanGangguan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanGangguan $laporanGangguan)
    {
        //
    }
}
