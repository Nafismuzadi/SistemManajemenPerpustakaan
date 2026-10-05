<?php
session_start();
require 'koneksi.php';

// Cek apakah user sudah login dan role-nya adalah peminjam
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true || $_SESSION['userRole'] !== 'peminjam') {
    header("Location: index.php");
    exit;
}

$nis = $_SESSION['peminjam_data']['NIS'];

// 1. Hitung jumlah buku yang sedang dipinjam
$stmt1 = $conn->prepare("SELECT COUNT(*) as total FROM peminjaman WHERE NIS = ? AND STATUS = 'Dipinjam'");
$stmt1->bind_param("i", $nis);
$stmt1->execute();
$sedang_dipinjam = $stmt1->get_result()->fetch_assoc()['total'];

// 2. Cari tanggal jatuh tempo terdekat dari buku yang sedang dipinjam
$stmt2 = $conn->prepare("SELECT MIN(tanggal_tenggat) as terdekat FROM peminjaman WHERE NIS = ? AND STATUS = 'Dipinjam'");
$stmt2->bind_param("i", $nis);
$stmt2->execute();
$tenggat_terdekat = $stmt2->get_result()->fetch_assoc()['terdekat'];

$sisa_hari_terdekat = "-";
$tanggal_terdekat_format = "-";
if ($tenggat_terdekat) {
    $sekarang = new DateTime(date('Y-m-d'));
    $tenggat = new DateTime($tenggat_terdekat);
    $selisih = $sekarang->diff($tenggat);
    $tanggal_terdekat_format = date('d M Y', strtotime($tenggat_terdekat));
    
    if ($sekarang > $tenggat) {
        $sisa_hari_terdekat = "Terlambat " . $selisih->days . " Hari";
    } else {
        $sisa_hari_terdekat = $selisih->days . " Hari Lagi";
    }
} else {
    $sisa_hari_terdekat = "Aman";
}

// 3. Hitung total buku yang pernah dipinjam (Riwayat)
$stmt3 = $conn->prepare("SELECT COUNT(*) as total FROM peminjaman WHERE NIS = ? AND STATUS = 'Dikembalikan'");
$stmt3->bind_param("i", $nis);
$stmt3->execute();
$total_selesai = $stmt3->get_result()->fetch_assoc()['total'];

// 4. Ambil daftar buku yang saat ini sedang dipinjam
$stmt4 = $conn->prepare("
    SELECT p.id_peminjaman, p.tanggal_pinjam, p.tanggal_tenggat, b.judul_buku, b.pengarang 
    FROM peminjaman p 
    JOIN buku b ON p.id_buku = b.id_buku 
    WHERE p.NIS = ? AND p.STATUS = 'Dipinjam' 
    ORDER BY p.tanggal_tenggat ASC
");
$stmt4->bind_param("i", $nis);
$stmt4->execute();
$daftar_pinjaman = $stmt4->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Dipinjam Saya - Perpustakaan SMKN 1 Kamal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

    <?php include 'includes/sidebar.php'; ?>

    <div class="ml-[235px] min-h-screen">
        <?php include 'includes/header.php'; ?>

        <main class="p-7">
            <!-- HEADER SECTION -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-800 via-blue-900 to-blue-700 px-10 py-8 text-white shadow-sm">
                <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-400/20"></div>
                <div class="absolute -bottom-20 right-32 h-44 w-44 rounded-full bg-white/5"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="mb-2 flex items-center gap-2 text-blue-200">
                            <i class="fa-solid fa-user-gear text-xs"></i>
                            <span class="text-xs font-medium">Area Anggota Perpustakaan</span>
                        </div>
                        <h1 class="mb-2 text-2xl font-bold">Buku Dipinjam Saya 📖</h1>
                        <p class="max-w-lg text-sm text-blue-100">Pantau daftar buku yang sedang Anda pinjam, tanggal jatuh tempo, dan perpanjang durasi peminjaman Anda.</p>
                    </div>
                    <a href="cari-buku.php" class="inline-flex items-center gap-2 self-start md:self-auto rounded-lg bg-white px-5 py-2.5 text-xs font-semibold text-blue-800 transition hover:bg-blue-50 shadow-sm">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari Buku Lain
                    </a>
                </div>
            </section>

            <!-- STATISTIK -->
            <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Sedang Dipinjam -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Sedang Dipinjam</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                <?= $sedang_dipinjam; ?> <span class="text-xs font-normal text-slate-400">/ 3 buku (maks)</span>
                            </h3>
                            <p class="mt-2 text-[11px] text-blue-600 font-medium">
                                Masih bisa meminjam <?= (3 - $sedang_dipinjam) < 0 ? 0 : (3 - $sedang_dipinjam); ?> buku lagi
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-book-reader text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Jatuh Tempo Terdekat -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Batas Kembalikan Terdekat</p>
                            <h3 class="mt-2 text-xl font-bold <?= (strpos($sisa_hari_terdekat, 'Terlambat') !== false) ? 'text-red-600' : 'text-amber-600'; ?>">
                                <?= $sisa_hari_terdekat; ?>
                            </h3>
                            <p class="mt-2 text-[11px] text-slate-400">
                                Tanggal: <?= $tanggal_terdekat_format; ?>
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl <?= (strpos($sisa_hari_terdekat, 'Terlambat') !== false) ? 'bg-red-50 text-red-600' : 'bg-amber-50 text-amber-600'; ?>">
                            <i class="fa-solid <?= (strpos($sisa_hari_terdekat, 'Terlambat') !== false) ? 'fa-triangle-exclamation' : 'fa-clock'; ?> text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman Selesai -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Total Pernah Dipinjam</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800"><?= $total_selesai; ?></h3>
                            <p class="mt-2 text-[11px] text-emerald-600 font-medium">Buku telah dikembalikan</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-box-archive text-lg"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- WARNING BOX -->
            <div class="mt-6 flex items-center gap-3 rounded-xl border border-amber-200 bg-amber-50/80 p-4 text-xs text-amber-800">
                <i class="fa-solid fa-circle-exclamation text-base text-amber-600"></i>
                <div>
                    <span class="font-semibold">Catatan Penting:</span> Harap kembalikan buku tepat waktu sebelum tanggal jatuh tempo untuk menghindari denda keterlambatan Rp1.000 / hari.
                </div>
            </div>

            <!-- TITLE & TABS -->
            <div class="mb-5 mt-8 flex items-center justify-between border-b border-slate-200 pb-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Daftar Pinjaman Saya</h2>
                    <p class="mt-0.5 text-xs text-slate-500">Buku yang saat ini ada di tangan Anda.</p>
                </div>
                <!-- Filter Tabs -->
                <div class="flex gap-2">
                    <button class="rounded-lg bg-blue-600 px-3.5 py-1.5 text-xs font-medium text-white shadow-sm">Sedang Dipinjam</button>
                    <!-- Tombol ini bisa dihubungkan ke halaman riwayat nantinya -->
                    <button class="rounded-lg border border-slate-200 bg-white px-3.5 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50">Riwayat</button>
                </div>
            </div>

            <!-- GRID BUKU DIPINJAM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if ($daftar_pinjaman->num_rows > 0): ?>
                    <?php while($row = $daftar_pinjaman->fetch_assoc()): ?>
                        <?php 
                            // Hitung sisa hari per buku
                            $tgl_tenggat_buku = new DateTime($row['tanggal_tenggat']);
                            $tgl_sekarang = new DateTime(date('Y-m-d'));
                            $diff = $tgl_sekarang->diff($tgl_tenggat_buku);
                            
                            $is_terlambat = false;
                            if ($tgl_sekarang > $tgl_tenggat_buku) {
                                $is_terlambat = true;
                                $status_text = "Terlambat " . $diff->days . " Hari";
                                $status_color = "text-red-600";
                            } else {
                                $status_text = "Sisa " . $diff->days . " Hari";
                                $status_color = "text-amber-600";
                            }
                        ?>
                        <div class="flex flex-col sm:flex-row rounded-xl border <?= $is_terlambat ? 'border-red-300 bg-red-50/20' : 'border-slate-200 bg-white'; ?> p-5 shadow-sm transition hover:shadow-md">
                            <!-- Cover Placeholder (Karena database tidak punya gambar cover) -->
                            <div class="h-40 w-28 flex-shrink-0 flex items-center justify-center rounded-lg bg-slate-100 border border-slate-200 text-slate-300">
                                <i class="fa-solid fa-book text-4xl"></i>
                            </div>

                            <!-- Info Buku -->
                            <div class="mt-4 sm:mt-0 sm:ml-5 flex flex-1 flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between">
                                        <span class="rounded-md bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-700 uppercase">
                                            #PJM-<?= $row['id_peminjaman']; ?>
                                        </span>
                                        <span class="text-[11px] font-medium <?= $status_color; ?>">
                                            <i class="fa-solid <?= $is_terlambat ? 'fa-circle-xmark' : 'fa-hourglass-half'; ?> mr-1"></i> <?= $status_text; ?>
                                        </span>
                                    </div>
                                    <h3 class="mt-2 text-sm font-bold text-slate-800 leading-snug">
                                        <?= htmlspecialchars($row['judul_buku']); ?>
                                    </h3>
                                    <p class="mt-1 text-xs text-slate-500">
                                        Penulis: <?= htmlspecialchars($row['pengarang']); ?>
                                    </p>
                                </div>

                                <!-- Tanggal & Action -->
                                <div class="mt-4 border-t <?= $is_terlambat ? 'border-red-100' : 'border-slate-100'; ?> pt-3">
                                    <div class="mb-3 grid grid-cols-2 gap-2 text-[11px]">
                                        <div>
                                            <span class="text-slate-400">Tgl Pinjam:</span>
                                            <p class="font-medium text-slate-700"><?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?></p>
                                        </div>
                                        <div>
                                            <span class="<?= $is_terlambat ? 'text-red-400' : 'text-slate-400'; ?>">Jatuh Tempo:</span>
                                            <p class="font-medium <?= $is_terlambat ? 'text-red-700 font-bold' : 'text-slate-700'; ?>"><?= date('d M Y', strtotime($row['tanggal_tenggat'])); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- KONDISI JIKA TIDAK ADA BUKU YANG DIPINJAM -->
                    <div class="col-span-full mt-2 rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <i class="fa-solid fa-face-smile text-xl"></i>
                        </div>
                        <h3 class="mt-4 text-sm font-semibold text-slate-700">Tidak ada pinjaman aktif</h3>
                        <p class="mx-auto mt-1 max-w-md text-xs leading-5 text-slate-400">
                            Anda sudah mengembalikan semua buku. Silakan ke perpustakaan atau cari buku baru jika ingin meminjam.
                        </p>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>
</body>
</html>