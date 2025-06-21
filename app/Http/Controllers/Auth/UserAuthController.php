<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

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

    public function getUserById($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Data bidan berhasil diambil',
            'data' => [
                'id' => $user->id,
                'email' => $user->email,
                // 'password' => $user->password,
                'nama_lengkap' => $user->nama_lengkap,
                'no_hp' => $user->no_hp,
            ]
        ], 200);
    }
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed', // pastikan ada "password_confirmation"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil direset.'
        ]);
    }

    // public function resetPassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'otp' => 'required',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'validation_error',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $cachedOtp = Cache::get('reset_otp_' . $request->email);
    //     if (!$cachedOtp || $request->otp != $cachedOtp) {
    //         return response()->json([
    //             'status' => 'otp_invalid',
    //             'message' => 'OTP tidak valid atau telah kedaluwarsa.'
    //         ], 403);
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     // Hapus OTP dari cache setelah berhasil
    //     Cache::forget('reset_otp_' . $request->email);

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Password berhasil direset.'
    //     ]);
    // }


    // public function sendResetOtp(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $otp = rand(100000, 999999); // atau pakai Str::random(6) jika mau alfanumerik
    //     Cache::put('reset_otp_' . $request->email, $otp, now()->addMinutes(10)); // expire 10 menit

    //     // Kirim email OTP (gunakan Mail::to + view/email)
    //     Mail::raw("Kode OTP untuk reset password Anda: $otp", function ($message) use ($request) {
    //         $message->to($request->email)
    //             ->subject('Kode OTP Reset Password');
    //     });

    //     return response()->json([
    //         'status' => 'otp_sent',
    //         'message' => 'OTP telah dikirim ke email.'
    //     ]);
    // }
}
