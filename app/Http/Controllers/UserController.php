<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        $admins = Admin::all();

        return view('admin.pengguna.index', compact('users', 'admins'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Data berhasil dihapus!');
    }
}
