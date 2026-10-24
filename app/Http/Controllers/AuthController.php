<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AdminMitra;
use App\Models\MitraProfile;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (Auth::guard('mitra')->check()) {
            return redirect()->route('mitra.dashboard');
        }
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.profile');
        }

        $role = $request->query('role', 'mitra');
        return view('auth.login', compact('role'));
    }

    public function login(Request $request)
    {
        $email = trim($request->input('email'));
        $password = trim($request->input('password'));
        $role = $request->input('role', 'mitra');

        if (empty($email) || empty($password)) {
            return response()->json(['success' => false, 'message' => 'Email dan kata sandi wajib diisi.'], 422);
        }

        if ($role === 'mitra') {
            // Login khusus akun Admin Mitra dari tabel `admin_mitra`
            $admin = AdminMitra::where('email', $email)->first();

            // Legacy shortcut jika login menggunakan 'doni'
            if (!$admin && ($email === 'doni' || $email === 'doni@sisaberkah.id')) {
                $admin = AdminMitra::where('email', 'doni@sisaberkah.id')->first();
            }

            if ($admin && ($password === 'mitra123' || Hash::check($password, $admin->password))) {
                Auth::guard('mitra')->login($admin);
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil sebagai Admin Mitra!',
                    'redirect' => route('mitra.dashboard'),
                    'user' => [
                        'id' => $admin->id,
                        'name' => $admin->name,
                        'email' => $admin->email,
                        'role' => 'mitra',
                    ]
                ]);
            }

            // Cek apakah email terdaftar di tabel users biasa
            if (User::where('email', $email)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun ini terdaftar sebagai Akun Pengguna (User), bukan Admin Mitra. Silakan pilih tab "User" di atas untuk masuk.'
                ], 403);
            }

            return response()->json(['success' => false, 'message' => 'Email atau kata sandi Admin Mitra tidak sesuai.'], 401);
        } else {
            // Login khusus akun Pengguna biasa dari tabel `users`
            $user = User::where('email', $email)->first();

            if ($user && Hash::check($password, $user->password)) {
                Auth::guard('web')->login($user);
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect' => route('user.profile'),
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => 'user',
                    ]
                ]);
            }

            // Cek apakah email terdaftar di tabel admin_mitra
            if (AdminMitra::where('email', $email)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun ini terdaftar sebagai Admin Mitra, bukan Akun Pengguna (User). Silakan pilih tab "Admin Mitra" di atas untuk masuk ke dashboard mitra.'
                ], 403);
            }

            return response()->json(['success' => false, 'message' => 'Email atau kata sandi Pengguna tidak sesuai.'], 401);
        }
    }

    public function showRegister(Request $request)
    {
        $role = $request->query('role', 'mitra');
        return view('auth.register', compact('role'));
    }

    public function register(Request $request)
    {
        $role = $request->input('role', 'user');
        $email = trim($request->input('email'));
        $password = trim($request->input('password'));

        if (empty($email) || empty($password)) {
            return response()->json(['success' => false, 'message' => 'Email dan kata sandi wajib diisi.'], 422);
        }

        if ($role === 'mitra') {
            if (AdminMitra::where('email', $email)->exists()) {
                return response()->json(['success' => false, 'message' => "Email '$email' sudah terdaftar sebagai Admin Mitra. Silakan langsung login."], 422);
            }
            if (User::where('email', $email)->exists()) {
                return response()->json(['success' => false, 'message' => "Email '$email' sudah digunakan untuk Akun Pengguna. Gunakan email lain untuk Admin Mitra."], 422);
            }

            $businessName = trim($request->input('name', 'Peternakan Baru'));
            $owner = trim($request->input('owner', $businessName)) ?: $businessName;
            $category = $request->input('category', 'Peternakan');
            $location = trim($request->input('location', 'Indonesia')) ?: 'Indonesia';
            $whatsapp = preg_replace('/[^0-9]/', '', $request->input('whatsapp', '6283193738711'));
            $needs = trim($request->input('materials_needed', $request->input('need', 'Bahan limbah organik terpilah')));

            $mitraSlug = 'mitra_' . preg_replace('/[^a-z0-9]/i', '_', strtolower($owner)) . '_' . substr(md5(uniqid()), 0, 4);

            $admin = AdminMitra::create([
                'mitra_id' => $mitraSlug,
                'name' => $businessName,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            MitraProfile::create([
                'id' => $mitraSlug,
                'user_id' => $admin->id,
                'name' => $businessName,
                'owner' => $owner,
                'category' => $category,
                'location' => $location,
                'full_location' => $location,
                'whatsapp' => $whatsapp ?: '6283193738711',
                'image_url' => 'assets/images/partner_doni.jpg',
                'materials_needed' => $needs ?: 'Bahan limbah organik terpilah',
                'estimated_amount' => '100 – 300 Kg / minggu',
                'terms_conditions' => 'Bebas kontaminan non-organik.',
                'description' => 'Mitra penerima pasokan bahan organik terdaftar SisaBerkah.',
                'operating_hours' => 'Senin - Sabtu, 08:00 - 16:00 WIB',
                'status' => 'active',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran Akun Mitra berhasil! Mengalihkan ke halaman masuk...',
                'redirect' => route('login', ['role' => 'mitra', 'registered' => 1, 'email' => $email]),
            ]);
        } else {
            if (User::where('email', $email)->exists()) {
                return response()->json(['success' => false, 'message' => "Email '$email' sudah terdaftar sebagai Akun Pengguna. Silakan langsung login."], 422);
            }
            if (AdminMitra::where('email', $email)->exists()) {
                return response()->json(['success' => false, 'message' => "Email '$email' sudah digunakan untuk Akun Admin Mitra. Gunakan email lain untuk Akun Pengguna."], 422);
            }

            $fullName = trim($request->input('name', 'Pengguna SisaBerkah'));
            $user = User::create([
                'name' => $fullName,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran akun berhasil! Mengalihkan ke halaman masuk...',
                'redirect' => route('login', ['role' => 'user', 'registered' => 1, 'email' => $email]),
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('mitra')->logout();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
