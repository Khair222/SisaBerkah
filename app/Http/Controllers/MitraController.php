<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MitraProfile;
use App\Models\AdminMitra;
use App\Models\PasokanMasuk;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = MitraProfile::where('status', 'active')->orderByRaw("id = 'doni' DESC, updated_at DESC")->get();
        return view('mitra.index', compact('mitras'));
    }

    public function detail($id)
    {
        $mitra = MitraProfile::find($id);
        if (!$mitra) {
            return response()->json(['success' => false, 'message' => 'Mitra tidak ditemukan'], 404);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $mitra->id,
                'name' => $mitra->name,
                'owner' => $mitra->owner,
                'cat' => $mitra->category,
                'category' => $mitra->category,
                'loc' => $mitra->location,
                'location' => $mitra->location,
                'fullLoc' => $mitra->full_location ?: $mitra->location,
                'full_location' => $mitra->full_location ?: $mitra->location,
                'wa' => $mitra->whatsapp,
                'whatsapp' => $mitra->whatsapp,
                'img' => $mitra->image_url ?: 'assets/images/partner_doni.jpg',
                'image_url' => $mitra->image_url ?: 'assets/images/partner_doni.jpg',
                'need' => $mitra->materials_needed,
                'materials_needed' => $mitra->materials_needed,
                'amount' => $mitra->estimated_amount,
                'estimated_amount' => $mitra->estimated_amount,
                'terms' => $mitra->terms_conditions,
                'terms_conditions' => $mitra->terms_conditions,
                'desc' => $mitra->description,
                'description' => $mitra->description,
                'operatingHours' => $mitra->operating_hours,
                'operating_hours' => $mitra->operating_hours,
                'status' => $mitra->status,
            ]
        ]);
    }

    private function getCurrentProfile($user)
    {
        $profile = null;
        if ($user->mitra_id) {
            $profile = MitraProfile::find($user->mitra_id);
        }
        if (!$profile) {
            $profile = MitraProfile::where('user_id', $user->id)->first();
        }
        if (!$profile) {
            $profile = MitraProfile::where('id', 'doni')->first();
        }
        return $profile;
    }

    public function dashboard()
    {
        $user = Auth::guard('mitra')->user();
        if (!$user) {
            return redirect()->route('login', ['role' => 'mitra'])->with('error', 'Silakan login sebagai Admin Mitra terlebih dahulu.');
        }

        $profile = $this->getCurrentProfile($user);
        $pasokanList = $profile ? $profile->pasokan : collect();

        return view('mitra.dashboard', compact('user', 'profile', 'pasokanList'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('mitra')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Sesi Admin Mitra telah berakhir.'], 403);
        }

        $id = $request->input('id');
        $profile = null;
        if ($id) {
            $profile = MitraProfile::find($id);
        }
        if (!$profile && $user->mitra_id) {
            $profile = MitraProfile::find($user->mitra_id);
        }
        if (!$profile) {
            $profile = MitraProfile::where('user_id', $user->id)->first();
        }
        if (!$profile) {
            $profile = MitraProfile::where('id', 'doni')->first();
        }

        if ($profile) {
            $profile->name = $request->input('name', $profile->name);
            $profile->owner = $request->input('owner', $profile->owner);
            $profile->category = $request->input('category', $request->input('cat', $profile->category));
            $profile->location = $request->input('location', $request->input('loc', $profile->location));
            $profile->full_location = $request->input('full_location', $request->input('fullLoc', $profile->location));
            $profile->whatsapp = preg_replace('/[^0-9]/', '', $request->input('whatsapp', $request->input('wa', $profile->whatsapp)));
            $profile->image_url = $request->input('image_url', $request->input('img', $profile->image_url));
            $profile->materials_needed = $request->input('materials_needed', $request->input('need', $profile->materials_needed));
            $profile->estimated_amount = $request->input('estimated_amount', $request->input('amount', $profile->estimated_amount));
            $profile->terms_conditions = $request->input('terms_conditions', $request->input('terms', $profile->terms_conditions));
            $profile->description = $request->input('description', $request->input('desc', $profile->description));
            $profile->operating_hours = $request->input('operating_hours', $request->input('operatingHours', $profile->operating_hours));
            $profile->status = $request->input('status', $profile->status);
            $profile->save();

            // Update nama akun admin mitra juga
            $user->name = $profile->name;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Profil berhasil disimpan!']);
        }

        return response()->json(['success' => false, 'message' => 'Data mitra tidak ditemukan.'], 404);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('mitra')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        if (!Hash::check($oldPassword, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Kata sandi saat ini (lama) salah.'], 422);
        }

        if (strlen($newPassword) < 4) {
            return response()->json(['success' => false, 'message' => 'Kata sandi baru minimal 4 karakter.'], 422);
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Kata sandi berhasil diperbarui!']);
    }

    public function storePasokan(Request $request)
    {
        $user = Auth::guard('mitra')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $profile = $this->getCurrentProfile($user);
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profil mitra tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'nama_penyalur' => 'required|string|max:150',
            'tanggal' => 'required|date',
            'jenis_bahan' => 'required|string|max:255',
            'volume' => 'required|string|max:100',
            'status' => 'required|string|max:50',
            'kontak_wa' => 'nullable|string|max:50',
            'catatan' => 'nullable|string',
        ]);

        $wa = !empty($validated['kontak_wa']) ? preg_replace('/[^0-9]/', '', $validated['kontak_wa']) : null;
        if ($wa && str_starts_with($wa, '0')) {
            $wa = '62' . substr($wa, 1);
        }

        $pasokan = PasokanMasuk::create([
            'mitra_id' => $profile->id,
            'tanggal' => $validated['tanggal'],
            'nama_penyalur' => $validated['nama_penyalur'],
            'kontak_wa' => $wa,
            'jenis_bahan' => $validated['jenis_bahan'],
            'volume' => $validated['volume'],
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan pasokan baru berhasil disimpan!',
            'data' => [
                'id' => $pasokan->id,
                'tanggal' => $pasokan->tanggal ? $pasokan->tanggal->format('Y-m-d') : $validated['tanggal'],
                'tanggal_formatted' => $pasokan->tanggal ? $pasokan->tanggal->translatedFormat('d M Y') : date('d M Y', strtotime($validated['tanggal'])),
                'nama_penyalur' => $pasokan->nama_penyalur,
                'kontak_wa' => $pasokan->kontak_wa,
                'jenis_bahan' => $pasokan->jenis_bahan,
                'volume' => $pasokan->volume,
                'status' => $pasokan->status,
                'catatan' => $pasokan->catatan,
            ]
        ]);
    }

    public function updatePasokan(Request $request, $id)
    {
        $user = Auth::guard('mitra')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $profile = $this->getCurrentProfile($user);
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profil mitra tidak ditemukan.'], 404);
        }

        $pasokan = PasokanMasuk::where('id', $id)->where('mitra_id', $profile->id)->first();
        if (!$pasokan) {
            return response()->json(['success' => false, 'message' => 'Catatan pasokan tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'nama_penyalur' => 'required|string|max:150',
            'tanggal' => 'required|date',
            'jenis_bahan' => 'required|string|max:255',
            'volume' => 'required|string|max:100',
            'status' => 'required|string|max:50',
            'kontak_wa' => 'nullable|string|max:50',
            'catatan' => 'nullable|string',
        ]);

        $wa = !empty($validated['kontak_wa']) ? preg_replace('/[^0-9]/', '', $validated['kontak_wa']) : null;
        if ($wa && str_starts_with($wa, '0')) {
            $wa = '62' . substr($wa, 1);
        }

        $pasokan->update([
            'tanggal' => $validated['tanggal'],
            'nama_penyalur' => $validated['nama_penyalur'],
            'kontak_wa' => $wa,
            'jenis_bahan' => $validated['jenis_bahan'],
            'volume' => $validated['volume'],
            'status' => $validated['status'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan pasokan berhasil diperbarui!',
            'data' => [
                'id' => $pasokan->id,
                'tanggal' => $pasokan->tanggal ? $pasokan->tanggal->format('Y-m-d') : $validated['tanggal'],
                'tanggal_formatted' => $pasokan->tanggal ? $pasokan->tanggal->translatedFormat('d M Y') : date('d M Y', strtotime($validated['tanggal'])),
                'nama_penyalur' => $pasokan->nama_penyalur,
                'kontak_wa' => $pasokan->kontak_wa,
                'jenis_bahan' => $pasokan->jenis_bahan,
                'volume' => $pasokan->volume,
                'status' => $pasokan->status,
                'catatan' => $pasokan->catatan,
            ]
        ]);
    }

    public function deletePasokan($id)
    {
        $user = Auth::guard('mitra')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Sesi login telah berakhir.'], 401);
        }

        $profile = $this->getCurrentProfile($user);
        if (!$profile) {
            return response()->json(['success' => false, 'message' => 'Profil mitra tidak ditemukan.'], 404);
        }

        $pasokan = PasokanMasuk::where('id', $id)->where('mitra_id', $profile->id)->first();
        if (!$pasokan) {
            return response()->json(['success' => false, 'message' => 'Catatan pasokan tidak ditemukan.'], 404);
        }

        $pasokan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Catatan pasokan berhasil dihapus.'
        ]);
    }
}
