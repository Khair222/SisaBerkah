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

    <!-- Danger Zone Card: Hapus Akun -->
    <div style="margin-top: 2rem; background: #FFF5F5; border: 1.5px solid #FECACA; border-radius: 18px; padding: 2rem; box-shadow: 0 4px 16px rgba(239, 68, 68, 0.05); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
      <div style="display: flex; align-items: flex-start; gap: 1rem; max-width: 650px;">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: #FEE2E2; color: #DC2626; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
          <i data-lucide="alert-octagon" style="width: 22px; height: 22px;"></i>
        </div>
        <div>
          <div style="display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(239, 68, 68, 0.12); color: #DC2626; padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.35rem;">
            Zona Berbahaya
          </div>
          <h3 style="font-family: var(--font-heading); font-size: 1.15rem; font-weight: 800; color: #991B1B; margin: 0 0 0.3rem;">
            Hapus Akun Pengguna Secara Permanen
          </h3>
          <p style="font-size: 0.85rem; color: #7F1D1D; margin: 0; line-height: 1.5;">
            Tindakan ini tidak dapat dibatalkan. Seluruh data profil akun personal Anda akan dihapus secara permanen dari basis data SisaBerkah.
          </p>
        </div>
      </div>

      <button type="button" onclick="openDeleteModal()" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #DC2626; color: #FFFFFF; padding: 0.8rem 1.4rem; border-radius: 12px; font-weight: 700; font-size: 0.88rem; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(220, 38, 38, 0.25); transition: background 0.2s ease;">
        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
        <span>Hapus Akun Saya</span>
      </button>
    </div>

  </div>
</div>

<!-- Modal Konfirmasi Hapus Akun -->
<div id="deleteUserModal" style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(0, 0, 0, 0.65); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 1.5rem;">
  <div style="background: #FFFFFF; border-radius: 20px; max-width: 460px; width: 100%; padding: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center; position: relative;">
    
    <div style="width: 56px; height: 56px; border-radius: 50%; background: #FEE2E2; color: #DC2626; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">
      <i data-lucide="alert-triangle" style="width: 28px; height: 28px;"></i>
    </div>

    <h3 style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; color: #0F172A; margin: 0 0 0.5rem;">
      Konfirmasi Hapus Akun
    </h3>
    <p style="font-size: 0.88rem; color: #64748B; margin: 0 0 1.5rem; line-height: 1.5;">
      Apakah Anda yakin ingin menghapus akun <strong>{{ $user->email }}</strong>? Untuk keamanan, silakan masukkan kata sandi Anda:
    </p>

    <div id="deleteModalAlert" style="display: none; padding: 0.75rem 1rem; border-radius: 10px; background: #FEF2F2; color: #991B1B; font-size: 0.82rem; font-weight: 600; margin-bottom: 1.2rem; text-align: left;"></div>

    <form onsubmit="handleConfirmDelete(event)">
      <div style="margin-bottom: 1.5rem; text-align: left;">
        <label for="deleteConfirmPassword" style="display: block; font-size: 0.82rem; font-weight: 700; color: #334155; margin-bottom: 0.45rem;">
          Kata Sandi Akun
        </label>
        <div style="position: relative;">
          <input type="password" id="deleteConfirmPassword" required placeholder="Masukkan kata sandi Anda..." style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 1rem; border-radius: 10px; border: 1.5px solid #CBD5E1; font-size: 0.92rem; outline: none; box-sizing: border-box;">
          <button type="button" onclick="togglePasswordVisibility('deleteConfirmPassword', this)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94A3B8; cursor: pointer; padding: 0;" aria-label="Lihat kata sandi">
            <i data-lucide="eye" style="width: 17px; height: 17px;"></i>
          </button>
        </div>
      </div>

      <div style="display: flex; gap: 0.75rem;">
        <button type="button" onclick="closeDeleteModal()" style="flex: 1; padding: 0.8rem 1rem; border-radius: 10px; border: 1px solid #CBD5E1; background: #FFFFFF; color: #475569; font-weight: 700; font-size: 0.88rem; cursor: pointer;">
          Batal
        </button>
        <button type="submit" id="btnConfirmDelete" style="flex: 1.2; padding: 0.8rem 1rem; border-radius: 10px; border: none; background: #DC2626; color: #FFFFFF; font-weight: 700; font-size: 0.88rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.4rem;">
          <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
          <span>Ya, Hapus Akun</span>
        </button>
      </div>
    </form>
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

  function openDeleteModal() {
    const modal = document.getElementById('deleteUserModal');
    const pwdInput = document.getElementById('deleteConfirmPassword');
    const alertBox = document.getElementById('deleteModalAlert');
    pwdInput.value = '';
    alertBox.style.display = 'none';
    modal.style.display = 'flex';
    if (window.lucide) lucide.createIcons();
    setTimeout(() => pwdInput.focus(), 100);
  }

  function closeDeleteModal() {
    document.getElementById('deleteUserModal').style.display = 'none';
  }

  async function handleConfirmDelete(e) {
    e.preventDefault();
    const btn = document.getElementById('btnConfirmDelete');
    const pwdInput = document.getElementById('deleteConfirmPassword');
    const alertBox = document.getElementById('deleteModalAlert');
    const password = pwdInput.value.trim();

    if (!password) {
      alertBox.textContent = 'Silakan ketikkan kata sandi Anda.';
      alertBox.style.display = 'block';
      return;
    }

    btn.disabled = true;
    btn.innerHTML = '<span>Menghapus Akun...</span>';
    alertBox.style.display = 'none';

    try {
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const res = await fetch("{{ route('user.delete') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        },
        body: JSON.stringify({ password: password })
      });
      const data = await res.json();

      if (res.ok && data.success) {
        closeDeleteModal();
        showProfileAlert(data.message || 'Akun Anda berhasil dihapus.', true);
        setTimeout(() => {
          window.location.href = data.redirect || "{{ route('login') }}";
        }, 1200);
      } else {
        alertBox.textContent = data.message || 'Gagal menghapus akun. Periksa kata sandi Anda.';
        alertBox.style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<i data-lucide="trash-2" style="width: 16px; height: 16px;"></i><span>Ya, Hapus Akun</span>';
        if (window.lucide) lucide.createIcons();
      }
    } catch (err) {
      alertBox.textContent = 'Terjadi kesalahan jaringan atau server.';
      alertBox.style.display = 'block';
      btn.disabled = false;
      btn.innerHTML = '<i data-lucide="trash-2" style="width: 16px; height: 16px;"></i><span>Ya, Hapus Akun</span>';
      if (window.lucide) lucide.createIcons();
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) lucide.createIcons();
  });
</script>
@endsection
