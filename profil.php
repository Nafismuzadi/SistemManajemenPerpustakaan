<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: index.php");
    exit;
}

$user_data = $_SESSION['peminjam_data'] ?? null;
$pesan = '';

// Proses Ganti Password
if (isset($_POST['update_profil'])) {
    $nis = $user_data['NIS'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];

    if ($password_baru === $konfirmasi) {
        $stmt = $conn->prepare("UPDATE peminjam SET password = ? WHERE NIS = ?");
        $stmt->bind_param("si", $password_baru, $nis);
        if ($stmt->execute()) {
            $pesan = '<div class="mb-4 p-3 rounded-lg bg-emerald-50 text-emerald-700 text-xs border border-emerald-200"><i class="fa-solid fa-check-circle mr-1"></i> Kata sandi berhasil diperbarui!</div>';
        } else {
            $pesan = '<div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-xs border border-red-200"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Gagal memperbarui kata sandi.</div>';
        }
    } else {
        $pesan = '<div class="mb-4 p-3 rounded-lg bg-amber-50 text-amber-700 text-xs border border-amber-200"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Konfirmasi kata sandi tidak cocok!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Perpustakaan SMKN 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="ml-[235px] min-h-screen">
        
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <main class="p-7">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800">Profil Saya</h2>
                <p class="text-xs text-slate-500 mt-1">Kelola informasi akun dan keamanan Anda.</p>
            </div>

            <?= $pesan; ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Kartu Info Profil -->
                <div class="col-span-1 bg-white rounded-xl border border-slate-200 shadow-sm p-6 text-center">
                    <div class="h-20 w-20 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-3xl font-bold mb-4">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <h3 class="font-bold text-lg text-slate-800"><?= htmlspecialchars($user_data['nama'] ?? 'Siswa'); ?></h3>
                    <p class="text-xs text-slate-500 mt-1">Siswa / Peminjam</p>
                    
                    <div class="mt-6 border-t border-slate-100 pt-4 text-left space-y-3">
                        <div>
                            <p class="text-[10px] text-slate-400 font-semibold uppercase">Nomor Induk Siswa (NIS)</p>
                            <p class="text-sm font-medium text-slate-700"><?= htmlspecialchars($user_data['NIS'] ?? '-'); ?></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 font-semibold uppercase">Username Login</p>
                            <p class="text-sm font-medium text-slate-700"><?= htmlspecialchars($user_data['username'] ?? '-'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Form Ganti Password -->
                <div class="col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <h3 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Pengaturan Keamanan</h3>
                    <form method="POST" class="space-y-4 max-w-md text-xs">
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                            <input type="password" name="password_baru" required placeholder="Masukkan kata sandi baru" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-600 focus:bg-white transition">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                            <input type="password" name="konfirmasi_password" required placeholder="Ulangi kata sandi baru" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-blue-600 focus:bg-white transition">
                        </div>
                        <div class="pt-2">
                            <button type="submit" name="update_profil" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-lg transition shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>
</body>
</html>