<?php

namespace App\Http\Controllers;

use App\Models\InformasiGangguan;
use Illuminate\Http\Request;

class InformasiGangguanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiGangguan = InformasiGangguan::all();
        return response()->json($informasiGangguan);
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
            $data = InformasiGangguan::create($data = $request->all());
            return response()->json([
                "success" => true,
                "massage" => "Informasi Gangguan Berhasil Di tambahkan",
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

    public function show($id)
    {
        try {
            $data = InformasiGangguan::find($id);
            if (!$data) {
                return response()->json([
                    "success" => false,
                    "massage" => "id " . $id . " Tidak Ditemukan",
                ]);
            }
            return response()->json([
                "success" => true,
                "massage" => "Informasi Gangguan Berhasil Di tampilkan",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "massage" => "Informasi Gangguan Tidak Ditemukan" . $e->getMessage(),
                "data" => $id
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformasiGangguan $informasiGangguan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiGangguan $informasiGangguan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiGangguan $informasiGangguan)
    {
        //
    }
}
