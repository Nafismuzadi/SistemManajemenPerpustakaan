<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true || $_SESSION['userRole'] !== 'peminjam') {
    header("Location: index.php");
    exit;
}

$pesan = '';

// PROSES PENGAJUAN PINJAM OLEH SISWA
if (isset($_POST['request_pinjam'])) {
    $id_buku = $_POST['id_buku'];
    $nis = $_SESSION['peminjam_data']['NIS'];
    $tanggal_pinjam = date('Y-m-d');
    $tanggal_tenggat = date('Y-m-d', strtotime('+7 days'));

    // Cek apakah siswa sudah punya request atau sedang meminjam buku yang sama
    $cek_aktif = $conn->query("SELECT id_peminjaman FROM peminjaman WHERE NIS = $nis AND id_buku = $id_buku AND STATUS IN ('Menunggu', 'Dipinjam')");
    
    if ($cek_aktif->num_rows > 0) {
        $pesan = '<div class="mb-6 p-3 rounded-xl bg-rose-50 text-rose-700 text-xs border border-rose-200"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Anda sudah mengajukan atau sedang meminjam buku ini.</div>';
    } else {
        $stmt = $conn->prepare("INSERT INTO peminjaman (id_buku, NIS, tanggal_pinjam, tanggal_tenggat, STATUS) VALUES (?, ?, ?, ?, 'Menunggu')");
        $stmt->bind_param("iiss", $id_buku, $nis, $tanggal_pinjam, $tanggal_tenggat);
        if ($stmt->execute()) {
            $pesan = '<div class="mb-6 p-3 rounded-xl bg-emerald-50 text-emerald-700 text-xs border border-emerald-200"><i class="fa-solid fa-check mr-1"></i> Pengajuan pinjam berhasil dikirim ke Admin. Silakan cek menu Daftar Tunggu.</div>';
        }
    }
}

$search = '';
$query_sql = "SELECT * FROM buku ORDER BY id_buku DESC";

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $query_sql = "SELECT * FROM buku WHERE judul_buku LIKE '%$search%' OR pengarang LIKE '%$search%' OR penerbit LIKE '%$search%' ORDER BY id_buku DESC";
}
$daftar_buku = $conn->query($query_sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Buku - Sistem Manajemen Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

    <?php include 'includes/sidebar.php'; ?>

    <div class="ml-[235px] min-h-screen">
        <?php include 'includes/header.php'; ?>

        <main class="p-7">
            <?= $pesan; ?>

            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Katalog & Cari Buku</h1>
                    <p class="mt-1 text-xs text-slate-500">Temukan koleksi buku yang tersedia di Perpustakaan SMKN 1 Kamal.</p>
                </div>
                <form method="GET" action="" class="flex items-center gap-3">
                    <div class="relative w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400"><i class="fa-solid fa-magnifying-glass text-xs"></i></span>
                        <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Cari judul, penulis..." class="w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-4 text-xs text-slate-700 outline-none transition focus:border-blue-600">
                    </div>
                    <button type="submit" class="rounded-xl bg-blue-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-blue-700">Cari</button>
                    <?php if($search != ''): ?>
                        <a href="cari-buku.php" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-xmark"></i></a>
                    <?php endif; ?>
                </form>
            </div>

            <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <?php if ($daftar_buku->num_rows > 0): ?>
                    <?php while ($row = $daftar_buku->fetch_assoc()): ?>
                        <?php $is_tersedia = $row['stok'] > 0; ?>
                        
                        <div class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                            <div>
                                <div class="relative mb-3 flex aspect-[3/4] w-full items-center justify-center rounded-lg bg-slate-100 text-slate-300">
                                    <i class="fa-solid fa-book text-4xl"></i>
                                    <span class="absolute right-2 top-2 rounded-md <?= $is_tersedia ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100'; ?> px-2 py-1 text-[10px] font-semibold border">
                                        <?= $is_tersedia ? $row['stok'] . ' Tersedia' : 'Habis'; ?>
                                    </span>
                                </div>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600">Buku Umum</span>
                                <h3 class="mt-1 text-sm font-bold text-slate-800 line-clamp-1"><?= htmlspecialchars($row['judul_buku']); ?></h3>
                                <p class="mt-1 text-xs text-slate-500 line-clamp-1">Penulis: <?= htmlspecialchars($row['pengarang']); ?></p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[11px] font-bold text-slate-400">ID: <?= $row['id_buku']; ?></span>

                                <?php if ($is_tersedia): ?>
                                    <!-- TOMBOL REQUEST BERUBAH MENJADI FORM POST -->
                                    <form method="POST" action="">
                                        <input type="hidden" name="id_buku" value="<?= $row['id_buku']; ?>">
                                        <button type="submit" name="request_pinjam" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-600 hover:text-white">
                                            <i class="fa-solid fa-bookmark text-[10px]"></i> Pinjam
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button disabled class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-400 cursor-not-allowed">Habis</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>