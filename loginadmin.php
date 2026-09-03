<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - Perpustakaan SMKN 1 Kamal</title>
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
        <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl"><i class="ph ph-user-gear text-2xl"></i></div>
        <span class="font-bold text-lg">Portal Administrator</span>
      </div>
      <h1 class="text-xl font-bold">Masuk Admin 👋</h1>
      <p class="text-blue-100 text-xs mt-1">Gunakan akun utama administrator perpustakaan.</p>
    </div>

    <!-- Alert Message -->
    <div id="alertMsg" class="hidden mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2"></div>

    <!-- Form Login Admin -->
    <form id="adminLoginForm" class="p-6 space-y-4">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username Admin</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-user text-lg"></i></span>
          <input type="text" id="adminUsername" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600 focus:bg-white" placeholder="Username Admin">
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-lock-key text-lg"></i></span>
          <input type="password" id="adminPassword" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600 focus:bg-white" placeholder="••••••••">
        </div>
      </div>

      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-blue-600/20 flex items-center justify-center gap-2">
        <span>Masuk sebagai Admin</span>
        <i class="ph ph-arrow-right font-bold"></i>
      </button>
    </form>
  </div>

  <script src="database.js"></script>
  <script>
    document.getElementById('adminLoginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const user = document.getElementById('adminUsername').value.trim();
      const pass = document.getElementById('adminPassword').value.trim();
      const alertMsg = document.getElementById('alertMsg');

      if (user === 'admin' && pass === 'admin123') {
        alertMsg.className = "mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200";
        alertMsg.innerHTML = `<i class="ph ph-check-circle text-base"></i> Login Admin Berhasil! Mengalihkan...`;
        alertMsg.classList.remove('hidden');

        localStorage.setItem('userRole', 'admin');
        localStorage.setItem('isLoggedIn', 'true');
        setTimeout(() => { window.location.href = 'dashboardadmin.php'; }, 1000);
      } else {
        alertMsg.className = "mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-rose-50 text-rose-700 border border-rose-200";
        alertMsg.innerHTML = `<i class="ph ph-warning-circle text-base"></i> Username / Password Admin salah!`;
        alertMsg.classList.remove('hidden');
      }
    });
  </script>
</body>
</html>