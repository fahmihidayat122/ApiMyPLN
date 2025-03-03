<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'no_hp' => 'required|string|max:255',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $user = User::create([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_hp' => $request->no_hp,
                'avatar' => $request->avatar ? $request->file('avatar')->store('images/users') : null,
            ]);

            return response()->json([
                'message' => 'Pendaftaran berhasil',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Pendaftaran gagal',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Kredensial yang diberikan salah.'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Masuk berhasil',
                'user' => $user,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Masuk gagal',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Logout berhasil',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal melakukan logout',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    public function profile(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'message' => 'Tidak terautentikasi',
                ], 401);
            }

            return response()->json([
                'message' => 'Berhasil mendapatkan profil',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mendapatkan profil',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'no_hp' => 'required|string|max:255',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'message' => 'Tidak terautentikasi',
                ], 401);
            }

            $user->nama_lengkap = $request->nama_lengkap;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            if ($request->avatar) {
                Storage::delete($user->avatar);
                $user->avatar = $request->file('avatar')->store('images/users');
            }
            $user->save();

            return response()->json([
                'message' => 'Berhasil memperbarui profil',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui profil',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
