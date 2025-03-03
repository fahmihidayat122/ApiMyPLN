<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|string|min:8',
            ]);

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'Pendaftaran berhasil',
                'admin' => $admin,
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

            $admin = Admin::where('email', $request->email)->first();

            if (!$admin || !Hash::check($request->password, $admin->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Kredensial yang diberikan salah.'],
                ]);
            }

            $token = $admin->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Masuk berhasil',
                'admin' => $admin,
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
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Keluar berhasil'
        ]);
    }
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function listUsers()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => 'semua pengguna berhasil didapatkan',
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil daftar pengguna',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getUser($id)
    {
        try {
            $user = User::findOrFail($id);

            $userData = $user->toArray();
            if ($userData['avatar']) {
                $userData['avatar'] = url('storage/' . $userData['avatar']);
            }

            return response()->json([
                'status' => 'success',
                'user' => $userData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Pengguna tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'nama_lengkap' => 'nullable|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'no_hp' => 'nullable|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatarPath;
            }

            $user->fill($request->only(['nama_lengkap', 'email', 'no_hp']));
            $user->save();

            return response()->json([
                'status' => 'success',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data pengguna',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Pengguna berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus pengguna',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function searchUsers(Request $request)
    {
        try {
            $query = User::query();

            if ($request->has('nama_lengkap')) {
                $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
            }
            if ($request->has('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }
            if ($request->has('no_hp')) {
                $query->where('no_hp', 'like', '%' . $request->no_hp . '%');
            }

            $users = $query->get();

            return response()->json([
                'status' => 'success',
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mencari pengguna',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
