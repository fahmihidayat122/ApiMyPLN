<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        // Buat token untuk user
        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_hp' => 'required|string|max:15',
        ]);

        $user = User::create([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'no_hp' => $validatedData['no_hp'],
        ]);

        // 🔥 Generate token untuk user yang baru terdaftar
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => $user,
            'token' => $token // ✅ Pastikan token dikirim dalam respons
        ], 201);
    }


    public function logout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->currentAccessToken()->delete();
                return response()->json(['message' => 'Logout berhasil'], 200);
            } else {
                return response()->json(['error' => 'User tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat logout', 'message' => $e->getMessage()], 500);
        }
    }
}
