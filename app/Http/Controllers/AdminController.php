<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\User;
use App\Models\InformasiGangguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahPengguna = User::count();

        return view('admin.dashboard', compact('jumlahPengguna'));
    }


    public function informasiGangguan()
    {
        $gangguans = InformasiGangguan::all();
        return view('admin.informasi-gangguan.index', compact('gangguans'));
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Data Admin berhasil dihapus.');
    }
}
