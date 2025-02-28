<?php

namespace App\Http\Controllers;

use App\Models\InformasiPemadaman;
use Illuminate\Http\Request;

class InformasiPemadamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasiPemadaman = InformasiPemadaman::all();
        return response()->json($informasiPemadaman);
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
            $data = InformasiPemadaman::create($data = $request->all());
            return response()->json([
                "success" => true,
                "massage" => "Informasi Pemadaman Berhasil Di tambahkan",
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
            $data = InformasiPemadaman::find($id);
            if (!$data) {
                return response()->json([
                    "success" => false,
                    "massage" => "id " . $id . " Tidak Ditemukan",
                ]);
            }
            return response()->json([
                "success" => true,
                "massage" => "Informasi Pemadaman Berhasil Di tampilkan",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "massage" => "Informasi Pemadaman Tidak Ditemukan" . $e->getMessage(),
                "data" => $id
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformasiPemadaman $informasiPemadaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiPemadaman $informasiPemadaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformasiPemadaman $informasiPemadaman)
    {
        //
    }
}
