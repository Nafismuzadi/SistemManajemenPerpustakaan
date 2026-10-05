<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true || $_SESSION['userRole'] !== 'peminjam') {
    header("Location: index.php");
    exit;
}

$nis = $_SESSION['peminjam_data']['NIS'];

// Ambil data yang berstatus Menunggu atau Ditolak
$stmt = $conn->prepare("
    SELECT p.id_peminjaman, p.tanggal_pinjam, p.STATUS, b.judul_buku 
    FROM peminjaman p 
    JOIN buku b ON p.id_buku = b.id_buku 
    WHERE p.NIS = ? AND p.STATUS IN ('Menunggu', 'Ditolak') 
    ORDER BY p.id_peminjaman DESC
");
$stmt->bind_param("i", $nis);
$stmt->execute();
$data_tunggu = $stmt->get_result();

// Hapus riwayat ditolak oleh siswa
if (isset($_GET['hapus_riwayat'])) {
    $id_hapus = $_GET['hapus_riwayat'];
    $conn->query("DELETE FROM peminjaman WHERE id_peminjaman = $id_hapus AND STATUS = 'Ditolak' AND NIS = $nis");
    header("Location: daftar-tunggu.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tunggu - Perpustakaan SMKN 1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">

    <?php include 'includes/sidebar.php'; ?>

    <div class="ml-[235px] min-h-screen">
        <?php include 'includes/header.php'; ?>

        <main class="p-7">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800">Daftar Tunggu & Pengajuan</h2>
                <p class="text-xs text-slate-500 mt-1">Pantau status buku yang sedang Anda ajukan untuk dipinjam.</p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-50 text-slate-500 font-semibold border-b">
                        <tr>
                            <th class="px-5 py-3.5">ID Request</th>
                            <th class="px-5 py-3.5">Judul Buku</th>
                            <th class="px-5 py-3.5">Tanggal Request</th>
                            <th class="px-5 py-3.5">Status</th>
                            <th class="px-5 py-3.5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if ($data_tunggu->num_rows > 0): ?>
                            <?php while($row = $data_tunggu->fetch_assoc()): ?>
                                <tr class="hover:bg-slate-50">
                                    <td class="px-5 py-4 font-mono font-bold text-blue-600">#REQ-<?= $row['id_peminjaman']; ?></td>
                                    <td class="px-5 py-4 font-semibold"><?= htmlspecialchars($row['judul_buku']); ?></td>
                                    <td class="px-5 py-4"><?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?></td>
                                    <td class="px-5 py-4">
                                        <?php if($row['STATUS'] == 'Menunggu'): ?>
                                            <span class="bg-amber-50 text-amber-700 px-2.5 py-1 rounded-md border border-amber-200 text-[10px] font-bold"><i class="fa-solid fa-clock mr-1"></i> Menunggu Admin</span>
                                        <?php else: ?>
                                            <span class="bg-rose-50 text-rose-700 px-2.5 py-1 rounded-md border border-rose-200 text-[10px] font-bold"><i class="fa-solid fa-ban mr-1"></i> Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4">
                                        <?php if($row['STATUS'] == 'Ditolak'): ?>
                                            <a href="daftar-tunggu.php?hapus_riwayat=<?= $row['id_peminjaman']; ?>" class="text-rose-500 hover:text-rose-700 underline text-[10px]">Hapus</a>
                                        <?php else: ?>
                                            <span class="text-slate-400 italic text-[10px]">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-slate-400 mb-3"><i class="fa-solid fa-clock-rotate-left text-lg"></i></div>
                                    <h3 class="text-sm font-semibold text-slate-700">Tidak ada daftar tunggu</h3>
                                    <p class="text-xs text-slate-400 mt-1">Anda belum mengajukan peminjaman buku apapun saat ini.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>