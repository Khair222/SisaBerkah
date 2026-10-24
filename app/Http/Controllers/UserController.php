<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna biasa (role = user).
     */
    public function profile()
    {
        if (Auth::guard('mitra')->check()) {
            return redirect()->route('mitra.dashboard');
        }

        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('login', ['role' => 'user'])->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('user.profile', compact('user'));
    }

    /**
     * Perbarui data profil pengguna (nama).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $name = trim($request->input('name'));
        if (empty($name) || strlen($name) < 2) {
            return response()->json(['success' => false, 'message' => 'Nama lengkap minimal 2 karakter.'], 422);
        }

        $user->name = $name;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil Anda berhasil diperbarui!',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    /**
     * Perbarui kata sandi akun pengguna.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            return response()->json(['success' => false, 'message' => 'Semua kolom kata sandi wajib diisi.'], 422);
        }

        if (!Hash::check($currentPassword, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Kata sandi saat ini tidak sesuai.'], 422);
        }

        if (strlen($newPassword) < 6) {
            return response()->json(['success' => false, 'message' => 'Kata sandi baru minimal 6 karakter.'], 422);
        }

        if ($newPassword !== $confirmPassword) {
            return response()->json(['success' => false, 'message' => 'Konfirmasi kata sandi baru tidak cocok.'], 422);
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Kata sandi Anda berhasil diperbarui!'
        ]);
    }

    /**
     * Hapus akun pengguna (User) secara permanen.
     */
    public function deleteAccount(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $password = $request->input('password');
        if (empty($password)) {
            return response()->json(['success' => false, 'message' => 'Masukkan kata sandi untuk mengonfirmasi penghapusan akun.'], 422);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Kata sandi konfirmasi tidak sesuai.'], 422);
        }

        // Hapus pengguna secara permanen
        $user->delete();

        // Logout dan bersihkan sesi
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Akun Anda berhasil dihapus secara permanen dari SisaBerkah.',
            'redirect' => route('login', ['role' => 'user'])
        ]);
    }
}
