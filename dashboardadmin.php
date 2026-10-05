<?php
session_start();
require 'koneksi.php';

// Cek apakah user sudah login dan perannya adalah Admin
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userRole'] !== 'admin') {
    header("Location: hal-peminjaman.php");
    exit;
}

// Mengambil nama admin dari session (diset saat login)
$nama_admin = $_SESSION['admin_data']['nama_petugas'] ?? 'Administrator';

// 1. Mengambil Statistik Total Buku (Macam/Judul Buku)
$queryBuku = $conn->query("SELECT COUNT(id_buku) as total FROM buku");
$totalBuku = $queryBuku->fetch_assoc()['total'];

// 2. Mengambil Statistik Total Anggota (Peminjam)
$queryAnggota = $conn->query("SELECT COUNT(NIS) as total FROM peminjam");
$totalAnggota = $queryAnggota->fetch_assoc()['total'];

// 3. Mengambil Statistik Buku Sedang Dipinjam
$queryDipinjam = $conn->query("SELECT COUNT(id_peminjaman) as total FROM peminjaman WHERE STATUS = 'Dipinjam'");
$totalDipinjam = $queryDipinjam->fetch_assoc()['total'];

// 4. Mengambil Statistik Peminjaman Terlambat (Berdasarkan tanggal hari ini)
$queryTerlambat = $conn->query("SELECT COUNT(id_peminjaman) as total FROM peminjaman WHERE STATUS = 'Dipinjam' AND tanggal_tenggat < CURDATE()");
$totalTerlambat = $queryTerlambat->fetch_assoc()['total'];

// 5. Mengambil 5 Transaksi Terbaru
$queryTransaksi = $conn->query("
    SELECT p.id_peminjaman, b.judul_buku, a.nama, p.tanggal_pinjam, p.tanggal_tenggat, p.STATUS 
    FROM peminjaman p 
    JOIN buku b ON p.id_buku = b.id_buku 
    JOIN peminjam a ON p.NIS = a.NIS 
    ORDER BY p.id_peminjaman DESC 
    LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan SMKN 1 Kamal</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Sidebar (Admin) -->
    <aside class="fixed left-0 top-0 h-full w-[235px] bg-white border-r border-slate-200 z-20 flex flex-col justify-between p-4">
        <div>
            <!-- Brand -->
            <div class="flex items-center gap-3 px-2 py-3 border-b border-slate-100">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white font-bold shadow-md shadow-blue-500/20">
                    <i class="fa-solid fa-book-bookmark text-lg"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold text-slate-800 leading-tight">PERPUS SMKN 1</h1>
                    <p class="text-[10px] text-slate-500">Panel Admin / Petugas</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-6 space-y-1">
                <a href="dashboard-admin.php" class="flex items-center gap-3 rounded-lg bg-blue-50 px-3 py-2.5 text-xs font-semibold text-blue-700 transition">
                    <i class="fa-solid fa-chart-pie w-4 text-center"></i>
                    Dashboard Admin
                </a>
                <a href="kelola-buku.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-book w-4 text-center"></i>
                    Data Buku
                </a>
                <a href="kelola-peminjaman.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-hand-holding-hand w-4 text-center"></i>
                    Transaksi Pinjam
                </a>
                <a href="laporan-peminjaman.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-file-invoice w-4 text-center"></i>
                    Laporan Peminjaman
                </a>
                <a href="kelola-anggota.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-users w-4 text-center"></i>
                    Data Anggota
                </a>
                
                <!-- Tombol Logout -->
                <a href="logout.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-red-600 hover:bg-red-50 transition mt-4 border border-transparent hover:border-red-100">
                    <i class="fa-solid fa-right-from-bracket w-4 text-center"></i>
                    Keluar
                </a>
            </nav>
        </div>

        <!-- Admin Profile Footer -->
        <div class="border-t border-slate-100 pt-3 flex items-center gap-3 px-2">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-sm">
                ADM
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-slate-800 truncate"><?= htmlspecialchars($nama_admin); ?></p>
                <p class="text-[10px] text-slate-400 truncate">Administrator</p>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="ml-[235px] min-h-screen">

        <!-- Header -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-slate-200 px-7 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span>Admin Panel</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="font-medium text-slate-800">Dashboard Utama</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-medium text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Petugas Aktif
                </span>
                <button class="relative text-slate-500 hover:text-slate-700">
                    <i class="fa-regular fa-bell text-base"></i>
                    <?php if($totalTerlambat > 0): ?>
                    <span class="absolute -top-1 -right-1 flex h-2 w-2 rounded-full bg-red-500"></span>
                    <?php endif; ?>
                </button>
            </div>
        </header>

        <!-- Main Dashboard Section -->
        <main class="p-7">

            <!-- Welcome Banner -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-800 via-blue-900 to-blue-700 px-10 py-8 text-white shadow-sm">
                <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-400/20"></div>
                <div class="absolute -bottom-20 right-32 h-44 w-44 rounded-full bg-white/5"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="mb-2 flex items-center gap-2 text-blue-200">
                            <i class="fa-solid fa-shield-halved text-xs"></i>
                            <span class="text-xs font-medium">Sistem Manajemen Perpustakaan</span>
                        </div>
                        <h1 class="mb-2 text-2xl font-bold">
                            Selamat Datang, <?= htmlspecialchars($nama_admin); ?>! 👋
                        </h1>
                        <p class="max-w-lg text-sm text-blue-100">
                            Pantau aktivitas perpustakaan hari ini. Jangan lupa periksa peminjaman yang melewati batas waktu pengembalian.
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="kelola-peminjaman.php" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-emerald-700 shadow-sm">
                            <i class="fa-solid fa-plus"></i> Transaksi Baru
                        </a>
                    </div>
                </div>
            </section>

            <!-- Statistik Cards -->
            <section class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- Total Buku -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Total Judul Buku</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800"><?= $totalBuku; ?></h3>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-book text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Anggota -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Anggota Terdaftar</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800"><?= $totalAnggota; ?></h3>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                            <i class="fa-solid fa-users text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Buku Dipinjam -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Sedang Dipinjam</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800"><?= $totalDipinjam; ?></h3>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-hand-holding-hand text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Terlambat -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Terlambat</p>
                            <h3 class="mt-2 text-3xl font-bold text-red-600"><?= $totalTerlambat; ?></h3>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tabel Transaksi Terbaru -->
            <div class="mt-8 rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <div class="flex items-center justify-between border-b border-slate-200 p-5">
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Transaksi Terbaru</h2>
                        <p class="text-xs text-slate-500 mt-0.5">5 aktivitas peminjaman terakhir di perpustakaan.</p>
                    </div>
                    <a href="laporan-peminjaman.php" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lihat Semua <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-700">
                        <thead class="bg-slate-50 text-[11px] uppercase text-slate-500 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-3.5">ID Pinjam</th>
                                <th class="px-5 py-3.5">Nama Peminjam</th>
                                <th class="px-5 py-3.5">Buku</th>
                                <th class="px-5 py-3.5">Tgl Pinjam</th>
                                <th class="px-5 py-3.5">Jatuh Tempo</th>
                                <th class="px-5 py-3.5">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if($queryTransaksi->num_rows > 0): ?>
                                <?php while($row = $queryTransaksi->fetch_assoc()): ?>
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="px-5 py-4 font-mono font-bold text-blue-700">#PJM-<?= $row['id_peminjaman']; ?></td>
                                        <td class="px-5 py-4 font-semibold text-slate-800"><?= htmlspecialchars($row['nama']); ?></td>
                                        <td class="px-5 py-4 truncate max-w-[200px]"><?= htmlspecialchars($row['judul_buku']); ?></td>
                                        <td class="px-5 py-4"><?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?></td>
                                        <td class="px-5 py-4"><?= date('d M Y', strtotime($row['tanggal_tenggat'])); ?></td>
                                        <td class="px-5 py-4">
                                            <?php 
                                                $tenggat = strtotime($row['tanggal_tenggat']);
                                                $sekarang = strtotime(date('Y-m-d'));
                                                
                                                if($row['STATUS'] == 'Dikembalikan') {
                                                    echo '<span class="inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2.5 py-1 text-[10px] font-semibold text-emerald-700 border border-emerald-200"><i class="fa-solid fa-check"></i> Dikembalikan</span>';
                                                } else if ($row['STATUS'] == 'Dipinjam' && $sekarang > $tenggat) {
                                                    echo '<span class="inline-flex items-center gap-1 rounded-md bg-red-50 px-2.5 py-1 text-[10px] font-semibold text-red-700 border border-red-200"><i class="fa-solid fa-triangle-exclamation"></i> Terlambat</span>';
                                                } else {
                                                    echo '<span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2.5 py-1 text-[10px] font-semibold text-blue-700 border border-blue-200"><i class="fa-solid fa-clock"></i> Dipinjam</span>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-5 py-8 text-center text-slate-500">Belum ada data transaksi peminjaman.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</body>
</html>