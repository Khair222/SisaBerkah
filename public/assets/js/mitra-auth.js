/**
 * SISABERKAH — Mitra Management & Authentication Store
 * Handles session management, profile data persistence, and synchronization
 * across Public Directory (mitra.html), Home (index.html), and Dashboard (kelola-mitra.html).
 */

const DEFAULT_MITRA_DATABASE = {
  doni: {
    id: 'doni',
    name: 'Peternakan Pak Doni',
    owner: 'Pak Doni Prasetyo',
    cat: 'Peternakan',
    loc: 'Pakem, Sleman',
    fullLoc: 'Jl. Kaliurang Km 18, Pakem, Sleman, D.I. Yogyakarta',
    img: 'assets/images/partner_doni.jpg',
    need: 'Ampas tahu segar, ampas kelapa, & sisa sayuran hijau (sawi, kangkung, kubis)',
    amount: '150 – 500 Kg / minggu',
    terms: 'Ampas tahu maksimal 24 jam setelah produksi, bebas kantong kresek.',
    desc: 'Peternakan kambing etawa dan domba pedesaan dengan kandang panggung modern, mengutamakan pakan berbasis hijauan dan ampas organik.',
    wa: '6283193738711',
    status: 'active',
    operatingHours: 'Senin - Sabtu, 07:00 - 16:00 WIB',
    email: 'doni@sisaberkah.id',
    username: 'doni',
    password: 'mitra123'
  },
  budi: {
    id: 'budi',
    name: 'Peternakan Pak Budi',
    owner: 'Pak Budi Santoso',
    cat: 'Peternakan',
    loc: 'Cisarua, Bogor',
    fullLoc: 'Cisarua, Bogor, Jawa Barat',
    img: 'assets/images/partner_budi.jpg',
    need: 'Roti afkir & sisa bahan roti yang tidak berjamur',
    amount: '100 – 300 Kg / minggu',
    terms: 'Bebas staples, kantong plastik, dan jamur hitam beracun.',
    desc: 'Peternakan sapi perah & potong yang membuka peluang kerja sama dengan pemasok bahan organik terpilah yang sesuai untuk kebutuhan pakan ternaknya.',
    wa: '6283193738711',
    status: 'active',
    operatingHours: 'Setiap hari, 06:00 - 17:00 WIB'
  },
  adam: {
    id: 'adam',
    name: 'Peternakan Pak Adam',
    owner: 'Pak Adam Firmansyah',
    cat: 'Peternakan',
    loc: 'Karangploso, Malang',
    fullLoc: 'Karangploso, Malang, Jawa Timur',
    img: 'assets/images/partner_adam.jpg',
    need: 'Sisa sayuran segar pasar, buah afkir (pepaya, semangka, pisang), & sisa karbohidrat bersih',
    amount: '50 – 200 Kg / minggu',
    terms: 'Belum busuk berlendir parah, tidak tercampur minyak jelantah kotor.',
    desc: 'Peternakan ayam kampung dan unggas semi-umbaran ramah lingkungan dengan formulasi pakan alami bernutrisi seimbang.',
    wa: '6283193738711',
    status: 'active',
    operatingHours: 'Senin - Sabtu, 08:00 - 15:00 WIB'
  },
  haris: {
    id: 'haris',
    name: 'Peternakan Pak Haris',
    owner: 'Pak Haris Maulana',
    cat: 'Peternakan',
    loc: 'Cipondoh, Tangerang',
    fullLoc: 'Cipondoh, Tangerang, Banten',
    img: 'assets/images/partner_haris.jpg',
    need: 'Sisa makanan katering, sisa dapur restoran, & sisa potongan sayur hotel',
    amount: '300 – 800 Kg / minggu',
    terms: 'Wajib terpisah dari tusuk sate, plastik, dan tulang sapi besar.',
    desc: 'Sentra biokonversi Maggot Black Soldier Fly (BSF) perkotaan. Mengolah limbah makanan organik basah menjadi pakan berprotein tinggi.',
    wa: '6283193738711',
    status: 'active',
    operatingHours: 'Setiap hari, 08:00 - 17:00 WIB'
  },
  andi: {
    id: 'andi',
    name: 'Pertanian Pak Andi',
    owner: 'Pak Andi Wijaya',
    cat: 'Pertanian',
    loc: 'Cisaat, Sukabumi',
    fullLoc: 'Cisaat, Sukabumi, Jawa Barat',
    img: 'assets/images/about_organic.jpg',
    need: 'Daun gugur kering, serasah kebun, kulit buah manis, & pangkasan tanaman',
    amount: '200 – 600 Kg / minggu',
    terms: 'Bebas dari pestisida kimia sintetis, bersih dalam karung goni.',
    desc: 'Lahan perkebunan hortikultura organik dan tanaman buah tropis. Menggunakan sistem pertanian regeneratif dan pembuatan pupuk organik cair (POC).',
    wa: '6283193738711',
    status: 'active',
    operatingHours: 'Senin - Jumat, 07:00 - 15:00 WIB'
  },
  dedi: {
    id: 'dedi',
    name: 'Pengolahan Kompos Pak Dedi',
    owner: 'Pak Dedi Kusuma',
    cat: 'Pengolahan Kompos',
    loc: 'Lembang, Bandung',
    fullLoc: 'Lembang, Bandung, Jawa Barat',
    img: 'assets/images/hero_compost.jpg',
    need: 'Ampas kopi espresso/tubruk, sisa teh celup lepas, & sisa sayuran pasar',
    amount: '500 – 1.200 Kg / minggu',
    terms: 'Bebas puntung rokok, kantong teh sintetis, dan staples.',
    desc: 'Pusat produksi kompos organik granular dan vermikompos untuk penghijauan kota. Menerima bahan kaya nitrogen dan karbon dari berbagai usaha.',
    wa: '6283193738711',
    status: 'active',
    operatingHours: 'Setiap hari, 07:00 - 16:30 WIB'
  }
};

const MitraAuth = {
  STORAGE_PREFIX: 'sisaberkah_mitra_',
  SESSION_KEY: 'sisaberkah_current_user',

  /**
   * Retrieves partner profile by ID, merged with any saved customizations
   */
  getProfile(id) {
    const defaultData = DEFAULT_MITRA_DATABASE[id] || {
      id: id,
      name: 'Mitra SisaBerkah',
      owner: 'Pengelola',
      cat: 'Peternakan',
      loc: 'Indonesia',
      fullLoc: 'Indonesia',
      img: 'assets/images/partner_doni.jpg',
      need: 'Bahan limbah organik terpilah',
      amount: '100 Kg / minggu',
      terms: 'Bebas sampah anorganik.',
      desc: 'Mitra penerima pemanfaatan bahan organik SisaBerkah.',
      wa: '6283193738711',
      status: 'active',
      operatingHours: '08:00 - 17:00 WIB'
    };

    try {
      const saved = localStorage.getItem(this.STORAGE_PREFIX + id + '_profile');
      if (saved) {
        const parsed = JSON.parse(saved);
        return { ...defaultData, ...parsed };
      }
    } catch (e) {
      console.warn('Error reading profile for ' + id, e);
    }

    return defaultData;
  },

  /**
   * Saves partner profile modifications to LocalStorage
   */
  saveProfile(id, profileData) {
    try {
      const current = this.getProfile(id);
      const updated = {
        ...current,
        ...profileData,
        id: id,
        lastUpdated: new Date().toISOString()
      };
      localStorage.setItem(this.STORAGE_PREFIX + id + '_profile', JSON.stringify(updated));
      
      // Also update session user if saving currently logged-in user
      const user = this.getCurrentUser();
      if (user && user.id === id) {
        user.name = updated.name;
        user.owner = updated.owner;
        localStorage.setItem(this.SESSION_KEY, JSON.stringify(user));
      }

      window.dispatchEvent(new CustomEvent('sisaberkah:profile-updated', { detail: { id, data: updated } }));
      return updated;
    } catch (e) {
      console.error('Failed to save profile for ' + id, e);
      return null;
    }
  },

  /**
   * Resets a partner profile to factory default
   */
  resetProfile(id) {
    try {
      localStorage.removeItem(this.STORAGE_PREFIX + id + '_profile');
      window.dispatchEvent(new CustomEvent('sisaberkah:profile-updated', { detail: { id, data: DEFAULT_MITRA_DATABASE[id] } }));
      return DEFAULT_MITRA_DATABASE[id];
    } catch (e) {
      console.error('Failed to reset profile for ' + id, e);
      return null;
    }
  },

  /**
   * Gets dictionary of all profiles with their stored modifications
   */
  getAllProfiles() {
    const result = {};
    for (const id in DEFAULT_MITRA_DATABASE) {
      result[id] = this.getProfile(id);
    }
    // Also include any registered custom partner profiles in localStorage
    try {
      for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        if (key && key.startsWith(this.STORAGE_PREFIX) && key.endsWith('_profile')) {
          const id = key.substring(this.STORAGE_PREFIX.length, key.length - '_profile'.length);
          if (!result[id]) {
            result[id] = this.getProfile(id);
          }
        }
      }
    } catch (e) {
      console.warn('Error reading extra profiles from storage', e);
    }
    return result;
  },

  /**
   * Fetches partner profiles from MySQL database (XAMPP) via api/mitra.php
   */
  async fetchProfilesFromApi() {
    try {
      const res = await fetch('api/mitra.php');
      const json = await res.json();
      if (json && json.success && Array.isArray(json.data)) {
        json.data.forEach(p => {
          if (p && p.id) {
            localStorage.setItem(this.STORAGE_PREFIX + p.id + '_profile', JSON.stringify(p));
          }
        });
        return json.data;
      }
    } catch (e) {
      console.warn('Could not fetch profiles from API, using local storage cache', e);
    }
    return Object.values(this.getAllProfiles());
  },

  /**
   * Saves partner profile modifications to LocalStorage AND MySQL Database via api/mitra.php
   */
  async saveProfileToApi(id, profileData) {
    // 1. Save locally first for instant UI response
    const localUpdated = this.saveProfile(id, profileData);

    // 2. Persist to MySQL database (XAMPP)
    try {
      const res = await fetch('api/mitra.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, ...profileData })
      });
      const data = await res.json();
      if (data && data.success) {
        if (data.data) {
          localStorage.setItem(this.STORAGE_PREFIX + id + '_profile', JSON.stringify(data.data));
        }
        return { success: true, data: data.data, message: data.message };
      } else {
        return { success: false, message: data ? data.message : 'Gagal menyimpan perubahan profil.' };
      }
    } catch (err) {
      console.warn('API save failed or offline, data safely stored in browser', err);
      return { success: true, localOnly: true, data: localUpdated, message: 'Tersimpan secara lokal di browser.' };
    }
  },

  /**
   * Session / Authentication methods
   */
  LOCAL_USERS_KEY: 'sisaberkah_registered_users',

  getLocalUsers() {
    try {
      const raw = localStorage.getItem(this.LOCAL_USERS_KEY);
      if (raw) {
        const parsed = JSON.parse(raw);
        if (Array.isArray(parsed) && parsed.length > 0) return parsed;
      }
    } catch (e) {
      console.warn('Error reading local users', e);
    }

    // Default seeded accounts: 1 Mitra (Peternakan Pak Doni), 1 User (Pengguna SisaBerkah)
    const initialUsers = [
      {
        id: 'doni',
        mitra_id: 'doni',
        name: 'Peternakan Pak Doni',
        owner: 'Pak Doni Prasetyo',
        email: 'doni@sisaberkah.id',
        username: 'doni',
        password: 'mitra123',
        role: 'mitra',
        cat: 'Peternakan',
        category: 'Peternakan',
        location: 'Pakem, Sleman',
        whatsapp: '6283193738711',
        materials_needed: 'Ampas tahu segar, ampas kelapa, & sisa sayuran hijau (sawi, kangkung, kubis)'
      },
      {
        id: 'user_1',
        name: 'Pengguna SisaBerkah',
        owner: 'Pengguna SisaBerkah',
        email: 'user@sisaberkah.id',
        username: 'user',
        password: 'user123',
        role: 'user'
      }
    ];

    try {
      localStorage.setItem(this.LOCAL_USERS_KEY, JSON.stringify(initialUsers));
    } catch (e) {}
    return initialUsers;
  },

  saveLocalUser(userObj) {
    const list = this.getLocalUsers();
    const idx = list.findIndex(u => (u.email && userObj.email && u.email.toLowerCase() === userObj.email.toLowerCase()));
    if (idx >= 0) {
      list[idx] = { ...list[idx], ...userObj };
    } else {
      list.push(userObj);
    }
    try {
      localStorage.setItem(this.LOCAL_USERS_KEY, JSON.stringify(list));
    } catch (e) {}
    return userObj;
  },

  getCurrentUser() {
    try {
      const userStr = localStorage.getItem(this.SESSION_KEY);
      if (userStr) return JSON.parse(userStr);
    } catch (e) {
      console.warn('Error reading user session', e);
    }
    return null;
  },

  isLoggedIn() {
    return !!this.getCurrentUser();
  },

  /**
   * Local verification without bypass (Strict check for local fallback)
   */
  loginLocal(identifier, password, expectedRole = null) {
    const trimmedId = (identifier || '').trim().toLowerCase();
    const trimmedPwd = (password || '').trim();

    if (!trimmedId || !trimmedPwd) {
      return { success: false, message: 'Email dan kata sandi wajib diisi.' };
    }

    const users = this.getLocalUsers();
    const found = users.find(u => 
      (u.email && u.email.toLowerCase() === trimmedId) ||
      (u.username && u.username.toLowerCase() === trimmedId) ||
      (u.id && u.id.toLowerCase() === trimmedId)
    );

    if (!found) {
      return {
        success: false,
        message: 'Akun tidak ditemukan. Periksa kembali email Anda atau lakukan registrasi akun baru.'
      };
    }

    // Role check if provided
    if (expectedRole && found.role && found.role !== expectedRole) {
      const targetRoleName = found.role === 'mitra' ? 'Admin Mitra' : 'User (Pengguna)';
      return {
        success: false,
        message: `Akun ini terdaftar sebagai ${targetRoleName}. Silakan ubah pilihan peran ke "${targetRoleName}".`
      };
    }

    // Strict password match
    if (found.password !== trimmedPwd) {
      return {
        success: false,
        message: 'Kata sandi yang Anda masukkan salah.'
      };
    }

    const userObj = {
      id: found.mitra_id || found.id,
      mitra_id: found.mitra_id || (found.role === 'mitra' ? found.id : undefined),
      name: found.name,
      owner: found.owner || found.name,
      email: found.email,
      role: found.role || expectedRole || 'user',
      cat: found.category || found.cat || 'Peternakan',
      loggedInAt: new Date().toISOString()
    };

    localStorage.setItem(this.SESSION_KEY, JSON.stringify(userObj));

    let profile = null;
    if (userObj.role === 'mitra') {
      profile = this.getProfile(userObj.mitra_id || userObj.id);
    }

    return {
      success: true,
      user: userObj,
      profile: profile,
      message: 'Login berhasil!'
    };
  },

  async loginWithApi(emailOrUsername, password, role = 'mitra') {
    const trimmed = (emailOrUsername || '').trim();
    const trimmedPwd = (password || '').trim();

    if (!trimmed || !trimmedPwd) {
      return { success: false, message: 'Email dan kata sandi wajib diisi.' };
    }

    // 1. Primary: Authenticate with MySQL Database via API
    try {
      const res = await fetch('api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: trimmed, password: trimmedPwd, role: role })
      });
      const data = await res.json();
      if (data && data.success) {
        localStorage.setItem(this.SESSION_KEY, JSON.stringify(data.user));
        if (data.profile) {
          const profileId = data.profile.id || 'doni';
          localStorage.setItem(this.STORAGE_PREFIX + profileId + '_profile', JSON.stringify(data.profile));
        }
        // Sync into local users table
        this.saveLocalUser({
          id: data.user.id,
          mitra_id: data.user.mitra_id || data.user.id,
          name: data.user.name,
          owner: data.user.owner || data.user.name,
          email: data.user.email,
          password: trimmedPwd,
          role: data.user.role
        });
        return { success: true, user: data.user, profile: data.profile, message: data.message };
      } else {
        // Backend replied with error; check if this account exists in local store (e.g. offline registration)
        const localCheck = this.loginLocal(trimmed, trimmedPwd, role);
        if (localCheck.success) {
          return localCheck;
        }
        return { success: false, message: (data && data.message) ? data.message : 'Login gagal, periksa email dan kata sandi Anda.' };
      }
    } catch (err) {
      console.warn('Backend database API offline/unreachable, verifying via local store', err);
      // 2. Offline / local fallback ("pakai lokal aja dulu")
      return this.loginLocal(trimmed, trimmedPwd, role);
    }
  },

  async registerWithApi(payload) {
    const email = (payload.email || '').trim().toLowerCase();
    const password = (payload.password || '').trim();
    const role = payload.role || 'user';

    if (!email || !password) {
      return { success: false, message: 'Email dan kata sandi wajib diisi.' };
    }
    if (password.length < 4) {
      return { success: false, message: 'Kata sandi minimal 4 karakter.' };
    }

    // 1. Primary: Register to MySQL database via API
    try {
      const res = await fetch('api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (data && data.success) {
        localStorage.setItem(this.SESSION_KEY, JSON.stringify(data.user));

        const newMitraId = data.mitra_id || (role === 'mitra' ? 'mitra_' + Date.now() : null);

        // Also persist locally for offline resilience
        const localRecord = {
          id: data.user.id || newMitraId,
          mitra_id: newMitraId,
          name: payload.name,
          owner: payload.owner || payload.name,
          email: email,
          password: password,
          role: role,
          category: payload.category || 'Peternakan',
          location: payload.location,
          whatsapp: payload.whatsapp,
          materials_needed: payload.materials_needed
        };
        this.saveLocalUser(localRecord);

        if (role === 'mitra' && newMitraId) {
          const profileData = {
            id: newMitraId,
            name: payload.name,
            owner: payload.owner || payload.name,
            cat: payload.category || 'Peternakan',
            category: payload.category || 'Peternakan',
            loc: payload.location || 'Indonesia',
            location: payload.location || 'Indonesia',
            fullLoc: payload.location || 'Indonesia',
            wa: payload.whatsapp || '6283193738711',
            whatsapp: payload.whatsapp || '6283193738711',
            need: payload.materials_needed || 'Bahan limbah organik',
            materials_needed: payload.materials_needed || 'Bahan limbah organik',
            amount: '100 – 300 Kg / minggu',
            terms: 'Bebas kontaminan non-organik.',
            desc: 'Mitra penerima pasokan bahan organik terdaftar SisaBerkah.',
            status: 'active',
            img: 'assets/images/partner_doni.jpg'
          };
          localStorage.setItem(this.STORAGE_PREFIX + newMitraId + '_profile', JSON.stringify(profileData));
          window.dispatchEvent(new CustomEvent('sisaberkah:profile-updated', { detail: { id: newMitraId, data: profileData } }));
        }

        return { success: true, user: data.user, message: data.message, mitra_id: newMitraId };
      } else {
        return { success: false, message: (data && data.message) ? data.message : 'Pendaftaran gagal.' };
      }
    } catch (err) {
      console.warn('Backend register API offline, storing locally ("pakai lokal aja dulu")', err);

      // 2. Offline / Local Registration Fallback
      const users = this.getLocalUsers();
      if (users.some(u => u.email && u.email.toLowerCase() === email)) {
        return { success: false, message: `Email "${email}" sudah terdaftar. Silakan langsung masuk.` };
      }

      if (role === 'mitra') {
        const newId = 'mitra_' + Date.now();
        const u = {
          id: newId,
          mitra_id: newId,
          name: payload.name,
          owner: payload.owner || payload.name,
          email: email,
          password: password,
          role: 'mitra',
          cat: payload.category || 'Peternakan',
          category: payload.category || 'Peternakan',
          location: payload.location || 'Indonesia',
          whatsapp: payload.whatsapp || '6283193738711',
          materials_needed: payload.materials_needed || 'Bahan limbah organik'
        };
        this.saveLocalUser(u);
        localStorage.setItem(this.SESSION_KEY, JSON.stringify(u));

        const profileData = {
          id: newId,
          name: payload.name,
          owner: payload.owner || payload.name,
          cat: payload.category || 'Peternakan',
          category: payload.category || 'Peternakan',
          loc: payload.location || 'Indonesia',
          location: payload.location || 'Indonesia',
          fullLoc: payload.location || 'Indonesia',
          wa: payload.whatsapp || '6283193738711',
          whatsapp: payload.whatsapp || '6283193738711',
          need: payload.materials_needed || 'Bahan limbah organik terpilah',
          materials_needed: payload.materials_needed || 'Bahan limbah organik terpilah',
          amount: '100 – 300 Kg / minggu',
          terms: 'Bebas kontaminan non-organik.',
          desc: 'Mitra penerima pasokan bahan organik terdaftar SisaBerkah.',
          status: 'active',
          img: 'assets/images/partner_doni.jpg'
        };
        localStorage.setItem(this.STORAGE_PREFIX + newId + '_profile', JSON.stringify(profileData));
        window.dispatchEvent(new CustomEvent('sisaberkah:profile-updated', { detail: { id: newId, data: profileData } }));

        return { success: true, user: u, mitra_id: newId, message: 'Pendaftaran akun mitra berhasil (tersimpan lokal)!' };
      } else {
        const newId = 'user_' + Date.now();
        const u = {
          id: newId,
          name: payload.name || 'Pengguna Baru',
          owner: payload.name || 'Pengguna Baru',
          email: email,
          password: password,
          role: 'user'
        };
        this.saveLocalUser(u);
        localStorage.setItem(this.SESSION_KEY, JSON.stringify(u));

        return { success: true, user: u, message: 'Pendaftaran akun pengguna berhasil (tersimpan lokal)!' };
      }
    }
  },

  async changePasswordWithApi(oldPassword, newPassword) {
    const user = this.getCurrentUser();
    if (!user) {
      return { success: false, message: 'Sesi login tidak valid. Silakan login kembali.' };
    }

    try {
      const res = await fetch('api/change-password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          user_id: user.id,
          email: user.email,
          old_password: oldPassword,
          new_password: newPassword
        })
      });
      const data = await res.json();
      if (data && data.success) {
        // Also sync local storage users
        const users = this.getLocalUsers();
        const found = users.find(u => u.id === user.id || (u.email && user.email && u.email.toLowerCase() === user.email.toLowerCase()));
        if (found) {
          found.password = newPassword;
          this.saveLocalUser(found);
        }
        return { success: true, message: data.message };
      } else {
        return { success: false, message: data ? data.message : 'Gagal memperbarui kata sandi.' };
      }
    } catch (err) {
      console.warn('API change-password fallback to local', err);
      // Offline fallback
      const users = this.getLocalUsers();
      const found = users.find(u => u.id === user.id || (u.email && user.email && u.email.toLowerCase() === user.email.toLowerCase()));
      if (found) {
        if (found.password && found.password !== oldPassword) {
          return { success: false, message: 'Kata sandi lama yang Anda masukkan tidak sesuai.' };
        }
        found.password = newPassword;
        this.saveLocalUser(found);
        return { success: true, message: 'Kata sandi berhasil diperbarui (tersimpan lokal)!' };
      }
      return { success: false, message: 'Akun tidak ditemukan.' };
    }
  },

  login(identifier, password) {
    return this.loginLocal(identifier, password);
  },

  loginAs(partnerId) {
    const profile = this.getProfile(partnerId);
    if (!profile) return { success: false, message: 'Mitra tidak ditemukan' };

    const userObj = {
      role: 'mitra',
      id: partnerId,
      mitra_id: partnerId,
      name: profile.name,
      owner: profile.owner,
      email: profile.email || `${partnerId}@sisaberkah.id`,
      cat: profile.cat,
      loggedInAt: new Date().toISOString()
    };
    localStorage.setItem(this.SESSION_KEY, JSON.stringify(userObj));
    return { success: true, user: userObj };
  },

  loginAsUser(userName = 'Pengguna SisaBerkah', email = 'user@sisaberkah.id') {
    const userObj = {
      role: 'user',
      id: 'reg_user',
      name: userName,
      owner: userName,
      email: email,
      loggedInAt: new Date().toISOString()
    };
    localStorage.setItem(this.SESSION_KEY, JSON.stringify(userObj));
    return { success: true, user: userObj };
  },

  logout() {
    localStorage.removeItem(this.SESSION_KEY);
    window.location.href = 'login.html';
  },

  /**
   * Updates partner cards in the DOM automatically (for mitra.html and index.html)
   */
  syncCards() {
    const profiles = this.getAllProfiles();

    // 1. Update cards on mitra.html
    for (const id in profiles) {
      const data = profiles[id];
      const card = document.getElementById(id);
      if (card) {
        // Update Title
        const titleEl = card.querySelector('.home-partner-title');
        if (titleEl) titleEl.textContent = data.name;

        // Update Meta (Owner & Location)
        const metaEl = card.querySelector('.home-partner-meta');
        if (metaEl) {
          metaEl.innerHTML = `<i data-lucide="store" style="width:14px;height:14px;"></i><span>${data.owner}</span><span>•</span><span>${data.loc}</span>`;
        }

        // Update Category Badge
        const badgeEl = card.querySelector('.home-partner-badge');
        if (badgeEl) badgeEl.textContent = data.cat;

        // Update Image
        const imgEl = card.querySelector('.home-partner-img img');
        if (imgEl && data.img) {
          imgEl.src = data.img;
          imgEl.alt = data.name;
        }

        // Update Need Box
        const needDescEl = card.querySelector('.home-partner-need-desc');
        if (needDescEl) needDescEl.textContent = data.need;

        // Update Card description if exists
        const descEl = card.querySelector('p:not(.home-partner-need-desc)');
        if (descEl) descEl.textContent = data.desc;

        // Update WhatsApp button URL
        const waBtn = card.querySelector('.btn-partner-whatsapp');
        if (waBtn && data.wa) {
          const prefill = encodeURIComponent(
            `Halo ${data.owner} (${data.name}), salam kenal.\n\n` +
            `Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${data.need}".\n\n` +
            `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${data.name}.\n\n` +
            `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
          );
          waBtn.href = `https://wa.me/${data.wa}?text=${prefill}`;
        }
      } else if (document.getElementById('mitraCardsContainer')) {
        // Dynamically inject card for newly registered partner from database
        const container = document.getElementById('mitraCardsContainer');
        const prefill = encodeURIComponent(
          `Halo ${data.owner} (${data.name}), salam kenal.\n\n` +
          `Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${data.need}".\n\n` +
          `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${data.name}.\n\n` +
          `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
        );
        const cardDiv = document.createElement('div');
        cardDiv.className = 'home-partner-card';
        cardDiv.id = id;
        cardDiv.dataset.category = data.cat || 'Peternakan';
        cardDiv.innerHTML = `
          <div class="home-partner-img">
            <img src="${data.img || 'assets/images/partner_doni.jpg'}" alt="${data.name}" loading="lazy">
            <span class="home-partner-badge">${data.cat || 'Peternakan'}</span>
          </div>
          <div class="home-partner-body">
            <h3 class="home-partner-title">${data.name}</h3>
            <div class="home-partner-meta">
              <i data-lucide="store" style="width:14px;height:14px;"></i>
              <span>${data.owner}</span>
              <span>•</span>
              <span>${data.loc || 'Indonesia'}</span>
            </div>
            <p style="font-size:0.85rem;color:var(--color-charcoal-light);line-height:1.5;margin-bottom:1rem;">
              ${data.desc || 'Mitra penerima pasokan bahan organik terdaftar SisaBerkah.'}
            </p>
            <div class="home-partner-need-box">
              <span class="home-partner-need-label">KEBUTUHAN BAHAN:</span>
              <p class="home-partner-need-desc">${data.need || 'Bahan limbah organik terpilah'}</p>
            </div>
            <div style="font-size:0.82rem;color:var(--color-muted);margin-bottom:0.75rem;">
              <strong>Estimasi Kebutuhan:</strong> ${data.amount || '100 – 300 Kg / minggu'}
            </div>
            <div style="background:rgba(217,119,6,0.08);border-left:3px solid #D97706;padding:0.5rem 0.75rem;font-size:0.78rem;color:#92400E;border-radius:4px;margin-bottom:1.25rem;">
              <strong>Ketentuan:</strong> ${data.terms || 'Bebas kontaminan non-organik.'}
            </div>
            <div class="home-partner-actions">
              <button type="button" class="btn-partner-profile" onclick="openDetailModal('${id}')">Lihat Profil</button>
              <a href="https://wa.me/${data.wa}?text=${prefill}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp">
                <i data-lucide="message-circle" style="width:15px;height:15px;"></i>
                <span>WhatsApp</span>
              </a>
            </div>
          </div>
        `;
        container.insertBefore(cardDiv, container.firstChild);
      }

      // Also check index.html cards if they have specific attributes
      const homeDoniCard = document.querySelector('.home-partner-grid [data-partner-id="' + id + '"]') ||
                           (id === 'doni' ? document.querySelectorAll('.home-partner-grid .home-partner-card')[1] : null);
      if (homeDoniCard && id === 'doni') {
        const title = homeDoniCard.querySelector('.home-partner-title');
        if (title) title.textContent = data.name;
        const meta = homeDoniCard.querySelector('.home-partner-meta');
        if (meta) {
          meta.innerHTML = `<i data-lucide="store" style="width:14px;height:14px;"></i><span>${data.owner}</span><span>•</span><span>${data.loc.split(',')[0]}</span>`;
        }
        const need = homeDoniCard.querySelector('.home-partner-need-desc');
        if (need) need.textContent = data.need;
        const wa = homeDoniCard.querySelector('.btn-partner-whatsapp');
        if (wa && data.wa) {
          const prefill = encodeURIComponent(
            `Halo ${data.owner} (${data.name}), salam kenal.\n\n` +
            `Saya mendapatkan informasi kontak Bapak melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${data.need || 'ampas tahu segar dan sisa sayuran hijau'}".\n\n` +
            `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${data.name}.\n\n` +
            `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
          );
          wa.href = `https://wa.me/${data.wa}?text=${prefill}`;
        }
      }
    }

    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  },

  /**
   * Fetches latest database updates in background and synchronizes DOM cards
   */
  async syncCardsFromApi() {
    await this.fetchProfilesFromApi();
    this.syncCards();
  },

  /**
   * Synchronize the Navbar with Login / Portal Mitra status
   */
  syncNavbar() {
    const user = this.getCurrentUser();
    const navbarActions = document.querySelector('.navbar-actions');
    if (!navbarActions) return;

    if (user) {
      if (user.role === 'mitra') {
        const shortName = user.owner ? user.owner.split(' ')[0] : (user.name ? user.name.split(' ')[0] : 'Mitra');
        navbarActions.innerHTML = `
          <a href="kelola-mitra.html" class="nav-login-btn logged-in-mitra" style="background:#22C55E;color:#04140D;font-weight:700;display:inline-flex;align-items:center;gap:0.4rem;padding:0.45rem 1.05rem;border-radius:9999px;text-decoration:none;border:none;" title="Buka Dashboard Admin Mitra">
            <i data-lucide="layout-dashboard" style="width:15px;height:15px;"></i>
            <span>Dashboard Mitra (${shortName})</span>
          </a>
          <button type="button" onclick="MitraAuth.logout()" class="nav-logout-btn" title="Keluar dari akun">
            <i data-lucide="log-out" style="width:13px;height:13px;"></i>
            <span>Keluar</span>
          </button>
        `;
      } else {
        // Regular User: Show interactive user profile chip + logout
        const userName = user.name || 'Pengguna';
        const initial = userName.charAt(0).toUpperCase();
        navbarActions.innerHTML = `
          <button type="button" onclick="MitraAuth.openUserProfileModal()" class="nav-user-badge" id="btnOpenUserProfile" title="Buka Profil Akun Pengguna (${userName})">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:50%;background:#22C55E;color:#04140D;font-size:0.75rem;font-weight:800;">
              ${initial}
            </span>
            <span>${userName}</span>
            <span style="font-size:0.72rem;background:#E7EFE3;color:#245C43;padding:2px 7px;border-radius:999px;font-weight:600;">Profil Saya</span>
          </button>
          <button type="button" onclick="MitraAuth.logout()" class="nav-logout-btn" title="Keluar dari akun">
            <i data-lucide="log-out" style="width:13px;height:13px;"></i>
            <span>Keluar</span>
          </button>
        `;
      }
    } else {
      navbarActions.innerHTML = `
        <a href="login.html" class="nav-login-btn" id="navPortalMitraBtn">
          <i data-lucide="log-in" style="width:14px;height:14px;"></i>
          <span>Masuk</span>
        </a>
      `;
    }

    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  },

  /**
   * User Profile Modal: Allows regular user to view account details, change password, and manage session
   */
  ensureUserProfileModal() {
    let modal = document.getElementById('userProfileModal');
    if (modal) return modal;

    modal = document.createElement('div');
    modal.id = 'userProfileModal';
    modal.className = 'modal-overlay';
    modal.onclick = (e) => {
      if (e.target === modal) MitraAuth.closeUserProfileModal();
    };

    modal.innerHTML = `
      <div class="modal-card" style="max-width:540px;position:relative;" onclick="event.stopPropagation()">
        <button type="button" class="modal-close-btn" onclick="MitraAuth.closeUserProfileModal()" style="position:absolute;top:18px;right:18px;width:34px;height:34px;border-radius:50%;background:#F3F4F6;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:20px;color:#4B5563;line-height:1;">&times;</button>
        
        <div id="userProfileModalContent"></div>
      </div>
    `;

    document.body.appendChild(modal);
    return modal;
  },

  openUserProfileModal() {
    const user = this.getCurrentUser();
    if (!user) {
      window.location.href = 'login.html';
      return;
    }

    const modal = this.ensureUserProfileModal();
    const content = document.getElementById('userProfileModalContent');
    const initial = (user.name || 'P').charAt(0).toUpperCase();

    content.innerHTML = `
      <div style="text-align:center;padding-bottom:1.25rem;border-bottom:1px solid #E5E7EB;margin-bottom:1.25rem;">
        <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg, #22C55E, #15803D);color:#FFFFFF;font-size:1.85rem;font-weight:800;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(34,197,94,0.3);margin-bottom:0.75rem;">
          ${initial}
        </div>
        <h3 style="font-family:var(--font-heading);font-size:1.35rem;font-weight:800;color:#111827;margin:0 0 0.25rem;">
          ${user.name || 'Pengguna'}
        </h3>
        <p style="font-size:0.88rem;color:#6B7280;margin:0 0 0.6rem;">${user.email || 'Email tidak tersedia'}</p>
        <span style="display:inline-flex;align-items:center;gap:0.35rem;background:rgba(34,197,94,0.12);color:#15803D;padding:0.25rem 0.85rem;border-radius:9999px;font-size:0.78rem;font-weight:700;">
          <i data-lucide="check-circle" style="width:13px;height:13px;"></i>
          <span>Akun Pengguna SisaBerkah</span>
        </span>
      </div>

      <!-- Detail Akun -->
      <div style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:14px;padding:1.15rem;margin-bottom:1.15rem;">
        <div style="font-size:0.75rem;font-weight:700;text-transform:uppercase;color:#6B7280;letter-spacing:0.05em;margin-bottom:0.75rem;">
          Informasi Akun
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;font-size:0.88rem;">
          <div>
            <div style="color:#9CA3AF;font-size:0.75rem;">Peran Akun</div>
            <div style="font-weight:600;color:#1F2937;">Penyalur Bahan Organik</div>
          </div>
          <div>
            <div style="color:#9CA3AF;font-size:0.75rem;">Status Keaktifan</div>
            <div style="font-weight:600;color:#16A34A;display:flex;align-items:center;gap:4px;">
              <span style="width:7px;height:7px;border-radius:50%;background:#16A34A;"></span> Aktif
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Action: Jelajahi Mitra -->
      <div style="background:rgba(34,197,94,0.06);border:1px solid rgba(34,197,94,0.2);border-radius:14px;padding:1rem;margin-bottom:1.15rem;display:flex;align-items:center;justify-content:space-between;gap:0.75rem;">
        <div>
          <div style="font-weight:700;font-size:0.9rem;color:#14532D;margin-bottom:2px;">Mau salurkan sisa makanan?</div>
          <div style="font-size:0.78rem;color:#4B5563;">Hubungi peternakan, pertanian, atau unit kompos.</div>
        </div>
        <a href="mitra.html" class="btn-primary" style="padding:0.45rem 0.95rem;font-size:0.82rem;text-decoration:none;border-radius:9999px;white-space:nowrap;background:#245C43;color:#FFFFFF;font-weight:600;">
          Lihat Mitra
        </a>
      </div>

      <!-- Form Ganti Password -->
      <div style="border:1px solid #E5E7EB;border-radius:14px;padding:1.15rem;margin-bottom:1.25rem;">
        <div style="font-size:0.85rem;font-weight:700;color:#1F2937;margin-bottom:0.75rem;display:flex;align-items:center;gap:0.4rem;">
          <i data-lucide="key" style="width:14px;height:14px;color:#16A34A;"></i>
          <span>Ganti Kata Sandi Akun</span>
        </div>
        <form onsubmit="MitraAuth.handleUserChangePassword(event)" style="display:flex;flex-direction:column;gap:0.6rem;">
          <div id="userPwdAlert" style="display:none;padding:0.5rem 0.75rem;border-radius:8px;font-size:0.8rem;margin-bottom:0.25rem;"></div>
          <div>
            <label style="display:block;font-size:0.75rem;color:#4B5563;font-weight:600;margin-bottom:3px;">Kata Sandi Lama</label>
            <input type="password" id="userOldPwd" required placeholder="Masukkan kata sandi lama" style="width:100%;box-sizing:border-box;padding:0.55rem 0.75rem;border:1px solid #D1D5DB;border-radius:8px;font-size:0.85rem;">
          </div>
          <div>
            <label style="display:block;font-size:0.75rem;color:#4B5563;font-weight:600;margin-bottom:3px;">Kata Sandi Baru</label>
            <input type="password" id="userNewPwd" required placeholder="Minimal 4 karakter" style="width:100%;box-sizing:border-box;padding:0.55rem 0.75rem;border:1px solid #D1D5DB;border-radius:8px;font-size:0.85rem;">
          </div>
          <button type="submit" id="btnUserSavePwd" style="background:#245C43;color:#FFFFFF;border:none;padding:0.6rem;border-radius:8px;font-size:0.85rem;font-weight:600;cursor:pointer;margin-top:0.25rem;">
            Simpan Kata Sandi Baru
          </button>
        </form>
      </div>

      <!-- Logout Button -->
      <button type="button" onclick="MitraAuth.logout()" style="width:100%;padding:0.65rem;background:#FEE2E2;color:#DC2626;border:1px solid #FECACA;border-radius:10px;font-size:0.88rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:0.4rem;transition:all 0.2s ease;">
        <i data-lucide="log-out" style="width:15px;height:15px;"></i>
        <span>Keluar dari Akun (Logout)</span>
      </button>
    `;

    modal.classList.add('active');
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
  },

  closeUserProfileModal() {
    const modal = document.getElementById('userProfileModal');
    if (modal) modal.classList.remove('active');
  },

  async handleUserChangePassword(e) {
    e.preventDefault();
    const oldPwd = document.getElementById('userOldPwd').value.trim();
    const newPwd = document.getElementById('userNewPwd').value.trim();
    const btn = document.getElementById('btnUserSavePwd');
    const alertBox = document.getElementById('userPwdAlert');

    if (!oldPwd || !newPwd) return;
    if (newPwd.length < 4) {
      alertBox.style.display = 'block';
      alertBox.style.background = '#FEE2E2';
      alertBox.style.color = '#B91C1C';
      alertBox.textContent = 'Kata sandi baru minimal 4 karakter.';
      return;
    }

    btn.disabled = true;
    btn.textContent = 'Menyimpan...';

    const res = await this.changePasswordWithApi(oldPwd, newPwd);

    btn.disabled = false;
    btn.textContent = 'Simpan Kata Sandi Baru';

    alertBox.style.display = 'block';
    if (res.success) {
      alertBox.style.background = '#DCFCE7';
      alertBox.style.color = '#15803D';
      alertBox.textContent = res.message || 'Kata sandi berhasil diperbarui!';
      document.getElementById('userOldPwd').value = '';
      document.getElementById('userNewPwd').value = '';
    } else {
      alertBox.style.background = '#FEE2E2';
      alertBox.style.color = '#B91C1C';
      alertBox.textContent = res.message || 'Gagal mengubah kata sandi.';
    }
  }
};

// Auto-run card & navbar sync on DOM ready
document.addEventListener('DOMContentLoaded', () => {
  MitraAuth.syncNavbar();
  MitraAuth.syncCards();
  MitraAuth.syncCardsFromApi();
});

// Listen for storage events across tabs or local dispatch
window.addEventListener('storage', () => {
  MitraAuth.syncNavbar();
  MitraAuth.syncCards();
});
window.addEventListener('sisaberkah:profile-updated', () => {
  MitraAuth.syncCards();
  MitraAuth.syncNavbar();
});
