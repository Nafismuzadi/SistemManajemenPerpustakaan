<?php
session_start();
require 'koneksi.php';

$error = '';
$success = '';
$view = 'login'; // Default tampilan adalah form login

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ==========================================
    // PROSES REGISTER PEMINJAM
    // ==========================================
    if (isset($_POST['action']) && $_POST['action'] == 'register') {
        $nama      = $_POST['regNama'];
        $user      = $_POST['regUser'];
        $pass      = $_POST['regPass']; // Idealnya gunakan password_hash()
        $identitas = $_POST['regIdentitas'];
        $telepon   = $_POST['regNoTelp'];
        $alamat    = $_POST['regAlamat'];

        // Cek apakah username atau nomor identitas sudah dipakai
        $cek = $conn->prepare("SELECT username FROM peminjam WHERE username = ? OR nomor_identitas = ?");
        $cek->bind_param("ss", $user, $identitas);
        $cek->execute();
        
        if ($cek->get_result()->num_rows > 0) {
            $error = "Username atau Nomor Identitas sudah terdaftar!";
            $view = 'register'; // Buka kembali form register
        } else {
            // Insert data baru ke database lengkap
            $stmt = $conn->prepare("INSERT INTO peminjam (nama_peminjam, username, password, nomor_identitas, alamat, no_telepon) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nama, $user, $pass, $identitas, $alamat, $telepon);
            
            if ($stmt->execute()) {
                $success = "Registrasi Berhasil! Silakan masuk menggunakan akun Anda.";
                $view = 'login'; // Pindah ke form login
            } else {
                $error = "Gagal mendaftar: " . $conn->error;
                $view = 'register';
            }
        }
    } 
    // ==========================================
    // PROSES LOGIN PEMINJAM
    // ==========================================
    elseif (isset($_POST['action']) && $_POST['action'] == 'login') {
        $user = $_POST['loginUser'];
        $pass = $_POST['loginPass'];

        $stmt = $conn->prepare("SELECT * FROM peminjam WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION['userRole'] = 'peminjam';
            $_SESSION['peminjam_data'] = $data;
            $_SESSION['isLoggedIn'] = true;
            
            // Pindah ke halaman dashboard (pastikan file dashboard.php ada)
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Peminjam - Perpustakaan SMKN 1 Kamal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
  <div class="w-full max-w-md bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden z-10 my-8">
    
    <!-- Header Banner -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-700 to-blue-600 p-8 text-white relative">
      <a href="index.php" class="inline-flex items-center gap-1.5 text-xs text-blue-200 hover:text-white mb-4 transition">
        <i class="ph ph-arrow-left"></i> Kembali
      </a>
      <div class="flex items-center gap-3 mb-2">
        <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl"><i class="ph ph-student text-2xl"></i></div>
        <span class="font-bold text-lg">Portal Peminjam</span>
      </div>
      <h1 id="titleHeader" class="text-xl font-bold"><?= ($view == 'register') ? 'Buat Akun Baru 📝' : 'Masuk Akun 👋' ?></h1>
    </div>

    <!-- Alert PHP -->
    <?php if($error != ''): ?>
    <div class="mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-rose-50 text-rose-700 border border-rose-200">
      <i class="ph ph-warning-circle text-base"></i> <?= $error; ?>
    </div>
    <?php endif; ?>
    
    <?php if($success != ''): ?>
    <div class="mx-6 mt-6 p-3 rounded-xl text-xs flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-200">
      <i class="ph ph-check-circle text-base"></i> <?= $success; ?>
    </div>
    <?php endif; ?>

    <!-- ========================================== -->
    <!-- FORM LOGIN -->
    <!-- ========================================== -->
    <form method="POST" id="loginForm" class="p-6 space-y-4 <?= ($view == 'register') ? 'hidden' : ''; ?>">
      <input type="hidden" name="action" value="login">
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Username</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-user"></i></span>
          <input type="text" name="loginUser" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Masukkan username">
        </div>
      </div>
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i class="ph ph-lock-key"></i></span>
          <input type="password" name="loginPass" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="••••••••">
        </div>
      </div>
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-xs transition duration-200 flex items-center justify-center gap-2">
        <span>Masuk</span> <i class="ph ph-arrow-right font-bold"></i>
      </button>
      <div class="text-center text-xs text-slate-500 pt-2">
        Belum punya akun? <button type="button" onclick="toggleView('register')" class="text-blue-600 font-semibold hover:underline">Daftar Sekarang</button>
      </div>
    </form>

    <!-- ========================================== -->
    <!-- FORM REGISTER (Kini Lebih Lengkap) -->
    <!-- ========================================== -->
    <form method="POST" id="registerForm" class="p-6 space-y-3 <?= ($view == 'login') ? 'hidden' : ''; ?> max-h-[60vh] overflow-y-auto">
      <input type="hidden" name="action" value="register">
      
      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
        <input type="text" name="regNama" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Nama lengkap Anda">
      </div>
      
      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">NIS/NIK</label>
          <input type="text" name="regIdentitas" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Nomor Identitas">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">No. WhatsApp</label>
          <input type="text" name="regNoTelp" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="0812...">
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat</label>
        <textarea name="regAlamat" rows="2" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Alamat lengkap"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Username</label>
          <input type="text" name="regUser" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="Untuk login">
        </div>
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi</label>
          <input type="password" name="regPass" required class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-blue-600" placeholder="••••••••">
        </div>
      </div>

      <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-xs transition duration-200 mt-2 flex items-center justify-center gap-2">
        <span>Daftar Menjadi Anggota</span> <i class="ph ph-user-plus font-bold"></i>
      </button>
      
      <div class="text-center text-xs text-slate-500 pt-2 pb-2">
        Sudah punya akun? <button type="button" onclick="toggleView('login')" class="text-blue-600 font-semibold hover:underline">Masuk di sini</button>
      </div>
    </form>

  </div>

  <script>
    // Fungsi untuk mengganti tampilan form tanpa reload
    function toggleView(mode) {
      const loginForm = document.getElementById('loginForm');
      const regForm = document.getElementById('registerForm');
      const titleHeader = document.getElementById('titleHeader');
      
      if (mode === 'register') {
        loginForm.classList.add('hidden');
        regForm.classList.remove('hidden');
        titleHeader.innerText = "Buat Akun Baru 📝";
      } else {
        regForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        titleHeader.innerText = "Masuk Akun 👋";
      }
    }
  </script>
</body>
</html>