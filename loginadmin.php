<?php
session_start();
require 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM petugas WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION['userRole'] = 'admin';
        $_SESSION['admin_data'] = $data;
        $_SESSION['isLoggedIn'] = true;
        
        header("Location: dashboardadmin.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
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
    <div class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 p-8 text-white relative">
      <a href="index.php" class="inline-flex items-center gap-1.5 text-xs text-blue-200 hover:text-white mb-4 transition">
        <i class="ph ph-arrow-left"></i> Kembali ke Pilihan Akses
      </a>
      <div class="flex items-center gap-3 mb-2">
        <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl"><i class="ph ph-user-gear text-2xl"></i></div>
        <span class="font-bold text-lg">Portal Administrator</span>
      </div>
      <h1 class="text-xl font-bold">Masuk Admin 👋</h1>
      <p class="text-blue-100 text-xs mt-1">Gunakan akun utama administrator perpustakaan.</p>
    </div>

    <?php if($error != ''): ?>
    <div class="mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-rose-50 text-rose-700 border border-rose-200">
      <i class="ph ph-warning-circle text-base"></i> <?= $error; ?>
    </div>
    <?php endif; ?>

    <!-- Perhatikan method="POST" dan atribut name="" -->
    <form method="POST" action="" class="p-6 space-y-4">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username Admin</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-user text-lg"></i></span>
          <input type="text" name="username" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600 focus:bg-white" placeholder="Username Admin">
        </div>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-lock-key text-lg"></i></span>
          <input type="password" name="password" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600 focus:bg-white" placeholder="••••••••">
        </div>
      </div>
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-blue-600/20 flex items-center justify-center gap-2">
        <span>Masuk sebagai Admin</span>
        <i class="ph ph-arrow-right font-bold"></i>
      </button>
    </form>
  </div>
</body>
</html>