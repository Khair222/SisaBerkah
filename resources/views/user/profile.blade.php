@extends('layouts.app')

@section('title', 'Profil Saya — SISABERKAH')
@section('meta_description', 'Kelola informasi profil akun pengguna, identitas pribadi, dan keamanan kata sandi di platform SisaBerkah.')

@section('content')
<div style="background-color: #F4F6F4; min-height: 85vh; padding: 2.5rem 0 4.5rem;">
  <div class="container" style="max-width: 1050px; margin: 0 auto; padding: 0 1.5rem;">

    <!-- Breadcrumb -->
    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #64748B; margin-bottom: 1.5rem;">
      <a href="{{ route('home') }}" style="color: #64748B; text-decoration: none;">Beranda</a>
      <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
      <span style="color: #10B981; font-weight: 600;">Profil Pengguna</span>
    </div>

    <!-- User Hero Banner -->
    <div style="background: linear-gradient(135deg, #062817 0%, #03180F 100%); border: 1px solid rgba(34, 197, 94, 0.24); border-radius: 20px; padding: 2.25rem 2.5rem; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(4, 20, 13, 0.12); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
      
      <div style="display: flex; align-items: center; gap: 1.25rem;">
        <div style="width: 68px; height: 68px; border-radius: 50%; background: rgba(34, 197, 94, 0.2); border: 2px solid #22C55E; display: flex; align-items: center; justify-content: center; color: #FFFFFF; flex-shrink: 0;">
          <i data-lucide="user" style="width: 34px; height: 34px;"></i>
        </div>
        <div>
          <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; color: #4ADE80; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.4rem;">
            <i data-lucide="check-circle" style="width: 12px; height: 12px;"></i>
            <span>Akun Pengguna Terverifikasi</span>
          </div>
          <h1 style="font-family: var(--font-heading); font-size: 1.65rem; font-weight: 800; color: #FFFFFF; margin: 0 0 0.25rem; letter-spacing: -0.3px;">
            Halo, <span id="heroUserName">{{ $user->name }}</span>!
          </h1>
          <p style="font-size: 0.88rem; color: rgba(255, 255, 255, 0.8); margin: 0;">
            Kelola data akun personal Anda untuk berpartisipasi menyalurkan limbah organik.
          </p>
        </div>
      </div>

      <div style="display: flex; align-items: center; gap: 0.75rem;">
        <a href="{{ route('mitra.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #22C55E; color: #04140D; padding: 0.7rem 1.25rem; border-radius: 12px; font-weight: 700; font-size: 0.88rem; text-decoration: none; box-shadow: 0 4px 14px rgba(34, 197, 94, 0.35); transition: transform 0.2s ease;">
          <i data-lucide="search" style="width: 16px; height: 16px;"></i>
          <span>Cari Mitra Penerima</span>
        </a>
      </div>
    </div>

    <!-- Alert Box Container -->
    <div id="userProfileAlert" style="display: none; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.75rem; font-size: 0.9rem; font-weight: 600;"></div>

    <!-- Profile Grid Layout -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">

      <!-- Card 1: Edit Informasi Profil -->
      <div style="background: #FFFFFF; border: 1px solid #E2E8E2; border-radius: 18px; padding: 2rem; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);">
        <div style="display: flex; align-items: center; gap: 0.75rem; padding-bottom: 1.25rem; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8E2;">
          <div style="width: 42px; height: 42px; border-radius: 12px; background: #ECFDF5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i data-lucide="user-pen" style="width: 22px; height: 22px;"></i>
          </div>
          <div>
            <h3 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 2px;">
              Informasi Akun
            </h3>
            <p style="font-size: 0.82rem; color: #64748B; margin: 0;">
              Ubah nama tampilan dan periksa data email Anda.
            </p>
          </div>
        </div>

        <form onsubmit="handleSaveProfile(event)">
          <div style="margin-bottom: 1.25rem;">
            <label for="userNameInput" style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
              Nama Lengkap
            </label>
            <input type="text" id="userNameInput" value="{{ $user->name }}" style="width: 100%; padding: 0.75rem 1rem; border-radius: 10px; border: 1.5px solid #CBD5E1; font-size: 0.92rem; outline: none; transition: border 0.2s ease; box-sizing: border-box;" required placeholder="Nama lengkap Anda...">
          </div>

          <div style="margin-bottom: 1.25rem;">
            <label style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
              Alamat Email (Akun Login)
            </label>
            <input type="email" value="{{ $user->email }}" disabled style="width: 100%; padding: 0.75rem 1rem; border-radius: 10px; border: 1.5px solid #E2E8F0; background: #F8FAFC; color: #64748B; font-size: 0.92rem; box-sizing: border-box; cursor: not-allowed;">
            <span style="font-size: 0.75rem; color: #94A3B8; margin-top: 0.35rem; display: block;">
              Email digunakan sebagai identitas akun dan tidak dapat diubah secara bebas.
            </span>
          </div>

          <div style="margin-bottom: 1.5rem; background: #F8FAF8; border: 1px solid #E2E8E2; border-radius: 12px; padding: 0.95rem 1.15rem;">
            <div style="display: flex; justify-content: space-between; font-size: 0.82rem; margin-bottom: 0.4rem;">
              <span style="color: #64748B;">Jenis Akun:</span>
              <strong style="color: #059669;">Pengguna Terdaftar (User)</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.82rem;">
              <span style="color: #64748B;">Bergabung Sejak:</span>
              <strong style="color: #1E293B;">{{ $user->created_at ? $user->created_at->format('d M Y') : 'Terdaftar' }}</strong>
            </div>
          </div>

          <button type="submit" id="btnSaveProfile" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.8rem 1.25rem; background: #22C55E; color: #04140D; font-weight: 700; font-size: 0.88rem; border: none; border-radius: 12px; cursor: pointer; transition: all 0.2s ease;">
            <i data-lucide="save" style="width: 16px; height: 16px;"></i>
            <span>Simpan Nama Profil</span>
          </button>
        </form>
      </div>

      <!-- Card 2: Perbarui Kata Sandi -->
      <div style="background: #FFFFFF; border: 1px solid #E2E8E2; border-radius: 18px; padding: 2rem; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);">
        <div style="display: flex; align-items: center; gap: 0.75rem; padding-bottom: 1.25rem; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8E2;">
          <div style="width: 42px; height: 42px; border-radius: 12px; background: #FEF3C7; color: #D97706; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i data-lucide="shield-check" style="width: 22px; height: 22px;"></i>
          </div>
          <div>
            <h3 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 2px;">
              Keamanan & Kata Sandi
            </h3>
            <p style="font-size: 0.82rem; color: #64748B; margin: 0;">
              Ubah kata sandi secara berkala untuk menjaga akun tetap aman.
            </p>
          </div>
        </div>

        <form onsubmit="handleSavePassword(event)">
          <div style="margin-bottom: 1.15rem;">
            <label for="currentPasswordInput" style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
              Kata Sandi Saat Ini
            </label>
            <div style="position: relative;">
              <input type="password" id="currentPasswordInput" style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 1rem; border-radius: 10px; border: 1.5px solid #CBD5E1; font-size: 0.92rem; outline: none; box-sizing: border-box;" required placeholder="Ketik kata sandi lama Anda...">
              <button type="button" onclick="togglePasswordVisibility('currentPasswordInput', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94A3B8; cursor: pointer; padding: 0;" aria-label="Lihat kata sandi">
                <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
              </button>
            </div>
          </div>

          <div style="margin-bottom: 1.15rem;">
            <label for="newPasswordInput" style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
              Kata Sandi Baru (Min. 6 Karakter)
            </label>
            <div style="position: relative;">
              <input type="password" id="newPasswordInput" style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 1rem; border-radius: 10px; border: 1.5px solid #CBD5E1; font-size: 0.92rem; outline: none; box-sizing: border-box;" required placeholder="Ketik kata sandi baru...">
              <button type="button" onclick="togglePasswordVisibility('newPasswordInput', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94A3B8; cursor: pointer; padding: 0;" aria-label="Lihat kata sandi">
                <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
              </button>
            </div>
          </div>

          <div style="margin-bottom: 1.5rem;">
            <label for="confirmPasswordInput" style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
              Konfirmasi Kata Sandi Baru
            </label>
            <div style="position: relative;">
              <input type="password" id="confirmPasswordInput" style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 1rem; border-radius: 10px; border: 1.5px solid #CBD5E1; font-size: 0.92rem; outline: none; box-sizing: border-box;" required placeholder="Ulangi kata sandi baru...">
              <button type="button" onclick="togglePasswordVisibility('confirmPasswordInput', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94A3B8; cursor: pointer; padding: 0;" aria-label="Lihat kata sandi">
                <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
              </button>
            </div>
          </div>

          <button type="submit" id="btnSavePassword" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.8rem 1.25rem; background: #0F172A; color: #FFFFFF; font-weight: 700; font-size: 0.88rem; border: none; border-radius: 12px; cursor: pointer; transition: all 0.2s ease;">
            <i data-lucide="key" style="width: 16px; height: 16px;"></i>
            <span>Perbarui Kata Sandi</span>
          </button>
        </form>
      </div>

    </div>

  </div>
</div>

<script>
  function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
      input.type = 'text';
      btn.innerHTML = '<i data-lucide="eye-off" style="width: 17px; height: 17px;"></i>';
    } else {
      input.type = 'password';
      btn.innerHTML = '<i data-lucide="eye" style="width: 17px; height: 17px;"></i>';
    }
    if (window.lucide) lucide.createIcons();
  }

  function showProfileAlert(message, isSuccess = true) {
    const alertBox = document.getElementById('userProfileAlert');
    alertBox.style.display = 'block';
    if (isSuccess) {
      alertBox.style.background = '#ECFDF5';
      alertBox.style.color = '#065F46';
      alertBox.style.border = '1px solid #A7F3D0';
      alertBox.innerHTML = `<div style="display:flex;align-items:center;gap:0.5rem;"><i data-lucide="check-circle" style="width:18px;height:18px;color:#10B981;"></i><span>${message}</span></div>`;
    } else {
      alertBox.style.background = '#FEF2F2';
      alertBox.style.color = '#991B1B';
      alertBox.style.border = '1px solid #FECACA';
      alertBox.innerHTML = `<div style="display:flex;align-items:center;gap:0.5rem;"><i data-lucide="alert-triangle" style="width:18px;height:18px;color:#EF4444;"></i><span>${message}</span></div>`;
    }
    if (window.lucide) lucide.createIcons();
    window.scrollTo({ top: alertBox.offsetTop - 100, behavior: 'smooth' });
  }

  async function handleSaveProfile(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSaveProfile');
    const nameInput = document.getElementById('userNameInput');
    const name = nameInput.value.trim();

    if (!name) return;

    btn.disabled = true;
    btn.innerHTML = '<span>Menyimpan...</span>';

    try {
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const res = await fetch("{{ route('user.updateProfile') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ name: name })
      });
      const data = await res.json();

      if (res.ok && data.success) {
        showProfileAlert(data.message || 'Profil berhasil diperbarui!', true);
        document.getElementById('heroUserName').textContent = name;
      } else {
        showProfileAlert(data.message || 'Gagal menyimpan profil.', false);
      }
    } catch (err) {
      showProfileAlert('Terjadi kesalahan jaringan.', false);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i data-lucide="save" style="width: 16px; height: 16px;"></i><span>Simpan Nama Profil</span>';
      if (window.lucide) lucide.createIcons();
    }
  }

  async function handleSavePassword(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSavePassword');
    const currentPass = document.getElementById('currentPasswordInput').value;
    const newPass = document.getElementById('newPasswordInput').value;
    const confirmPass = document.getElementById('confirmPasswordInput').value;

    if (newPass.length < 6) {
      showProfileAlert('Kata sandi baru minimal 6 karakter.', false);
      return;
    }

    if (newPass !== confirmPass) {
      showProfileAlert('Konfirmasi kata sandi baru tidak cocok.', false);
      return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span>Memperbarui Sandi...</span>';

    try {
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const res = await fetch("{{ route('user.updatePassword') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          current_password: currentPass,
          new_password: newPass,
          confirm_password: confirmPass
        })
      });
      const data = await res.json();

      if (res.ok && data.success) {
        showProfileAlert(data.message || 'Kata sandi berhasil diperbarui!', true);
        document.getElementById('currentPasswordInput').value = '';
        document.getElementById('newPasswordInput').value = '';
        document.getElementById('confirmPasswordInput').value = '';
      } else {
        showProfileAlert(data.message || 'Gagal memperbarui kata sandi.', false);
      }
    } catch (err) {
      showProfileAlert('Terjadi kesalahan jaringan.', false);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<i data-lucide="key" style="width: 16px; height: 16px;"></i><span>Perbarui Kata Sandi</span>';
      if (window.lucide) lucide.createIcons();
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) lucide.createIcons();
  });
</script>
@endsection
