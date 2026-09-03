<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Akses - Sistem Manajemen Perpustakaan SMKN 1 Kamal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

  <!-- Background Ornaments -->
  <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

  <div class="w-full max-w-md bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden relative z-10">
    
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 p-8 text-white relative overflow-hidden text-center">
      <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-md pointer-events-none"></div>
      
      <div class="inline-flex p-3 bg-white/10 backdrop-blur-md rounded-2xl mb-3 text-white">
        <i class="ph ph-book-bookmark text-3xl"></i>
      </div>
      <h1 class="text-xl font-bold">Perpustakaan SMKN 1 Kamal</h1>
      <p class="text-blue-100 text-xs mt-1">Selamat datang! Silakan pilih jenis akses masuk Anda.</p>
    </div>

    <!-- Role Selection Card Options -->
    <div class="p-6 space-y-4">
      
      <!-- Opsi masuk sebagai Administrator -->
      <a href="loginadmin.php" 
        class="group flex items-center gap-4 p-4 rounded-xl border border-slate-200 hover:border-blue-600 bg-slate-50/50 hover:bg-blue-50/50 transition duration-200 cursor-pointer">
        <div class="p-3 bg-blue-100 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition duration-200">
          <i class="ph ph-user-gear text-2xl"></i>
        </div>
        <div class="flex-1">
          <h2 class="font-bold text-sm text-slate-800 group-hover:text-blue-900">Masuk sebagai Admin</h2>
          <p class="text-[11px] text-slate-500">Khusus pengelola dan staf perpustakaan</p>
        </div>
        <i class="ph ph-caret-right text-slate-400 group-hover:text-blue-600 text-lg transition"></i>
      </a>

      <!-- Opsi masuk sebagai Peminjam -->
      <a href="loginpeminjam.php" 
        class="group flex items-center gap-4 p-4 rounded-xl border border-slate-200 hover:border-blue-600 bg-slate-50/50 hover:bg-blue-50/50 transition duration-200 cursor-pointer">
        <div class="p-3 bg-blue-100 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition duration-200">
          <i class="ph ph-student text-2xl"></i>
        </div>
        <div class="flex-1">
          <h2 class="font-bold text-sm text-slate-800 group-hover:text-blue-900">Masuk sebagai Peminjam</h2>
          <p class="text-[11px] text-slate-500">Siswa, mahasiswa, atau anggota umum</p>
        </div>
        <i class="ph ph-caret-right text-slate-400 group-hover:text-blue-600 text-lg transition"></i>
      </a>

    </div>

    <!-- Footer Card -->
    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 text-center text-[11px] text-slate-400">
      &copy; 2026 Sistem Manajemen Perpustakaan SMKN 1 Kamal. All rights reserved.
    </div>

  </div>

</body>
</html>