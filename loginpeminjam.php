<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Peminjam - Perpustakaan SMKN 1 Kamal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

  <div class="w-full max-w-md bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden z-10">
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 p-8 text-white relative">
      <a href="rolelogin.php" class="inline-flex items-center gap-1.5 text-xs text-blue-200 hover:text-white mb-4 transition">
        <i class="ph ph-arrow-left"></i> Kembali ke Pilihan Akses
      </a>
      <div class="flex items-center gap-3 mb-2">
        <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl"><i class="ph ph-student text-2xl"></i></div>
        <span class="font-bold text-lg">Portal Peminjam</span>
      </div>
      <h1 id="titleHeader" class="text-xl font-bold">Masuk Peminjam 👋</h1>
      <p id="subHeader" class="text-blue-100 text-xs mt-1">Silakan masuk untuk meminjam buku perpustakaan.</p>
    </div>

    <!-- Alert Notification -->
    <div id="alertMsg" class="hidden mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2"></div>

    <!-- Form Login Peminjam -->
    <form id="loginPeminjamForm" class="p-6 space-y-4">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-user text-lg"></i></span>
          <input type="text" id="loginUser" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600 focus:bg-white" placeholder="Masukkan username">
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-lock-key text-lg"></i></span>
          <input type="password" id="loginPass" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600 focus:bg-white" placeholder="••••••••">
        </div>
      </div>

      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-blue-600/20 flex items-center justify-center gap-2">
        <span>Masuk Peminjam</span>
        <i class="ph ph-arrow-right font-bold"></i>
      </button>

      <div class="text-center text-xs text-slate-500 pt-2">
        Belum punya akun? <button type="button" onclick="toggleView('register')" class="text-blue-600 font-semibold hover:underline">Daftar Akun Baru</button>
      </div>
    </form>

    <!-- Form Register Peminjam -->
    <form id="registerPeminjamForm" class="p-6 space-y-4 hidden">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
        <input type="text" id="regNama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Nama Anda">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username Baru</label>
        <input type="text" id="regUser" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Username peminjam">
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
        <input type="password" id="regPass" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="••••••••">
      </div>

      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-blue-600/20 flex items-center justify-center gap-2">
        <span>Buat Akun Baru</span>
        <i class="ph ph-user-plus font-bold"></i>
      </button>

      <div class="text-center text-xs text-slate-500 pt-2">
        Sudah punya akun? <button type="button" onclick="toggleView('login')" class="text-blue-600 font-semibold hover:underline">Kembali ke Login</button>
      </div>
    </form>
  </div>

  <script src="database.js"></script>
  <script>
    function toggleView(mode) {
      const loginForm = document.getElementById('loginPeminjamForm');
      const regForm = document.getElementById('registerPeminjamForm');
      const alertMsg = document.getElementById('alertMsg');
      alertMsg.classList.add('hidden');

      if (mode === 'register') {
        loginForm.classList.add('hidden');
        regForm.classList.remove('hidden');
        document.getElementById('titleHeader').innerText = "Buat Akun Peminjam 📝";
      } else {
        regForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        document.getElementById('titleHeader').innerText = "Masuk Peminjam 👋";
      }
    }

    // Process Login Peminjam
    document.getElementById('loginPeminjamForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const u = document.getElementById('loginUser').value.trim();
      const p = document.getElementById('loginPass').value.trim();
      const alertMsg = document.getElementById('alertMsg');

      const users = JSON.parse(localStorage.getItem('peminjamUsers')) || [];
      const match = users.find(item => item.username === u && item.password === p);

      if (match) {
        alertMsg.className = "mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200";
        alertMsg.innerHTML = `<i class="ph ph-check-circle text-base"></i> Selamat datang, ${match.nama}! Mengalihkan...`;
        alertMsg.classList.remove('hidden');

        localStorage.setItem('userRole', 'peminjam');
        localStorage.setItem('currentUser', JSON.stringify(match));
        localStorage.setItem('isLoggedIn', 'true');
        setTimeout(() => { window.location.href = 'dashboard.php'; }, 1000);
      } else {
        alertMsg.className = "mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-rose-50 text-rose-700 border border-rose-200";
        alertMsg.innerHTML = `<i class="ph ph-warning-circle text-base"></i> Akun tidak ditemukan / password salah!`;
        alertMsg.classList.remove('hidden');
      }
    });

    // Process Register Peminjam Baru
    document.getElementById('registerPeminjamForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const nama = document.getElementById('regNama').value.trim();
      const user = document.getElementById('regUser').value.trim();
      const pass = document.getElementById('regPass').value.trim();
      const alertMsg = document.getElementById('alertMsg');

      const users = JSON.parse(localStorage.getItem('peminjamUsers')) || [];

      if (user.toLowerCase() === 'admin' || users.some(u => u.username === user)) {
        alertMsg.className = "mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-rose-50 text-rose-700 border border-rose-200";
        alertMsg.innerHTML = `<i class="ph ph-warning-circle text-base"></i> Username sudah terpakai!`;
        alertMsg.classList.remove('hidden');
        return;
      }

      users.push({ nama, username: user, password: pass });
      localStorage.setItem('peminjamUsers', JSON.stringify(users));

      alertMsg.className = "mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200";
      alertMsg.innerHTML = `<i class="ph ph-check-circle text-base"></i> Registrasi Berhasil! Silakan Login.`;
      alertMsg.classList.remove('hidden');

      setTimeout(() => { toggleView('login'); }, 1200);
    });
  </script>
</body>
</html>