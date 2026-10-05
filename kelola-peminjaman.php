<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userRole'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id_petugas = $_SESSION['admin_data']['id_petugas'];

// ==========================================
// 1. PROSES APPROVE REQUEST
// ==========================================
if (isset($_GET['approve'])) {
    $id_peminjaman = (int)$_GET['approve'];
    
    // Cek ID Buku dan Stoknya
    $cek = $conn->query("SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id_peminjaman AND STATUS = 'Menunggu'")->fetch_assoc();
    if ($cek) {
        $id_buku = $cek['id_buku'];
        $stok = $conn->query("SELECT stok FROM buku WHERE id_buku = $id_buku")->fetch_assoc()['stok'];
        
        if ($stok > 0) {
            // Setujui, kurangi stok, tandai siapa admin yang menyetujui, dan atur tanggal pinjam dari hari ini
            $conn->query("UPDATE buku SET stok = stok - 1 WHERE id_buku = $id_buku");
            $conn->query("UPDATE peminjaman SET STATUS = 'Dipinjam', id_petugas = $id_petugas, tanggal_pinjam = CURDATE() WHERE id_peminjaman = $id_peminjaman");
        } else {
            // Tolak otomatis jika buku habis sebelum disetujui
            $conn->query("UPDATE peminjaman SET STATUS = 'Ditolak' WHERE id_peminjaman = $id_peminjaman");
        }
    }
    header("Location: kelola-peminjaman.php");
    exit;
}

// ==========================================
// 2. PROSES REJECT REQUEST
// ==========================================
if (isset($_GET['reject'])) {
    $id_peminjaman = (int)$_GET['reject'];
    $conn->query("UPDATE peminjaman SET STATUS = 'Ditolak' WHERE id_peminjaman = $id_peminjaman");
    header("Location: kelola-peminjaman.php");
    exit;
}

// ==========================================
// 3. PROSES KEMBALIKAN BUKU 
// ==========================================
if (isset($_GET['kembali'])) {
    $id_peminjaman = (int)$_GET['kembali'];
    $getData = $conn->query("SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id_peminjaman AND STATUS = 'Dipinjam'")->fetch_assoc();
    
    if ($getData) {
        $id_buku = $getData['id_buku'];
        $tanggal_kembali = date('Y-m-d');
        if ($conn->query("UPDATE peminjaman SET STATUS = 'Dikembalikan', tanggal_kembali = '$tanggal_kembali' WHERE id_peminjaman = $id_peminjaman")) {
            $conn->query("UPDATE buku SET stok = stok + 1 WHERE id_buku = $id_buku");
        }
    }
    header("Location: kelola-peminjaman.php");
    exit;
}

// Ambil Data Request Masuk
$queryRequest = $conn->query("SELECT p.id_peminjaman, b.judul_buku, a.nama, p.tanggal_pinjam, p.tanggal_tenggat FROM peminjaman p JOIN buku b ON p.id_buku = b.id_buku JOIN peminjam a ON p.NIS = a.NIS WHERE p.STATUS = 'Menunggu' ORDER BY p.id_peminjaman ASC");

// Ambil Data Aktif (Dipinjam / Dikembalikan)
$queryTransaksi = $conn->query("SELECT p.id_peminjaman, b.judul_buku, a.nama, p.tanggal_pinjam, p.tanggal_tenggat, p.tanggal_kembali, p.STATUS FROM peminjaman p JOIN buku b ON p.id_buku = b.id_buku JOIN peminjam a ON p.NIS = a.NIS WHERE p.STATUS IN ('Dipinjam', 'Dikembalikan') ORDER BY p.id_peminjaman DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Peminjaman - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">
    <!-- Sidebar di-copy sesuai format asli Admin sebelumnya -->
    <aside class="fixed left-0 top-0 h-full w-[235px] bg-white border-r border-slate-200 z-20 flex flex-col justify-between p-4">
        <div>
            <div class="flex items-center gap-3 px-2 py-3 border-b border-slate-100">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white font-bold"><i class="fa-solid fa-book-bookmark text-lg"></i></div>
                <div><h1 class="text-sm font-bold text-slate-800">PERPUS SMKN 1</h1><p class="text-[10px] text-slate-500">Panel Admin</p></div>
            </div>
            <nav class="mt-6 space-y-1">
                <a href="dashboardadmin.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-chart-pie w-4 text-center"></i> Dashboard</a>
                <a href="kelola-buku.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-book w-4 text-center"></i> Data Buku</a>
                <a href="kelola-peminjaman.php" class="flex items-center gap-3 rounded-lg bg-blue-50 px-3 py-2.5 text-xs font-semibold text-blue-700"><i class="fa-solid fa-hand-holding-hand w-4 text-center"></i> Transaksi Pinjam</a>
                <a href="kelola-anggota.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50"><i class="fa-solid fa-users w-4 text-center"></i> Data Anggota</a>
                <a href="logout.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-red-600 hover:bg-red-50 mt-4"><i class="fa-solid fa-right-from-bracket w-4 text-center"></i> Keluar</a>
            </nav>
        </div>
    </aside>

    <div class="ml-[235px] p-7">
        <header class="mb-6">
            <h2 class="text-xl font-bold">Manajemen Transaksi & Persetujuan</h2>
            <p class="text-xs text-slate-500 mt-1">Setujui pengajuan buku siswa dan atur status pengembalian di sini.</p>
        </header>

        <!-- ======================= -->
        <!-- TABEL 1: REQUEST MASUK  -->
        <!-- ======================= -->
        <h3 class="font-bold text-sm text-slate-800 mb-3"><i class="fa-solid fa-bell text-amber-500 mr-2"></i> Menunggu Persetujuan</h3>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto mb-8">
            <table class="w-full text-left text-xs text-slate-700 whitespace-nowrap">
                <thead class="bg-amber-50 text-slate-600 font-semibold border-b border-amber-100">
                    <tr>
                        <th class="px-5 py-3.5">ID Request</th>
                        <th class="px-5 py-3.5">Peminjam</th>
                        <th class="px-5 py-3.5">Buku Dipesan</th>
                        <th class="px-5 py-3.5">Aksi Persetujuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if($queryRequest->num_rows > 0): ?>
                        <?php while($req = $queryRequest->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 font-mono font-bold text-amber-600">#REQ-<?= $req['id_peminjaman']; ?></td>
                            <td class="px-5 py-4 font-semibold"><?= htmlspecialchars($req['nama']); ?></td>
                            <td class="px-5 py-4"><?= htmlspecialchars($req['judul_buku']); ?></td>
                            <td class="px-5 py-4 flex gap-2">
                                <a href="kelola-peminjaman.php?approve=<?= $req['id_peminjaman']; ?>" class="bg-emerald-600 text-white px-3 py-1.5 rounded-md text-[10px] hover:bg-emerald-700 font-medium transition"><i class="fa-solid fa-check mr-1"></i> Setujui</a>
                                <a href="kelola-peminjaman.php?reject=<?= $req['id_peminjaman']; ?>" class="bg-rose-100 text-rose-700 px-3 py-1.5 rounded-md text-[10px] hover:bg-rose-200 font-medium transition" onclick="return confirm('Tolak pengajuan pinjam ini?');"><i class="fa-solid fa-xmark mr-1"></i> Tolak</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="px-5 py-6 text-center text-slate-400 italic">Tidak ada pengajuan pinjam baru.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- ======================= -->
        <!-- TABEL 2: AKTIF / SELESAI-->
        <!-- ======================= -->
        <h3 class="font-bold text-sm text-slate-800 mb-3"><i class="fa-solid fa-clock-rotate-left text-blue-500 mr-2"></i> Peminjaman Aktif & Riwayat</h3>
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b">
                    <tr>
                        <th class="px-5 py-3.5">ID Pinjam</th>
                        <th class="px-5 py-3.5">Peminjam</th>
                        <th class="px-5 py-3.5">Buku</th>
                        <th class="px-5 py-3.5">Tenggat</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php while($row = $queryTransaksi->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4 font-mono font-bold text-blue-600">#PJM-<?= $row['id_peminjaman']; ?></td>
                        <td class="px-5 py-4 font-semibold"><?= htmlspecialchars($row['nama']); ?></td>
                        <td class="px-5 py-4"><?= htmlspecialchars($row['judul_buku']); ?></td>
                        <td class="px-5 py-4 text-red-600 font-medium"><?= date('d M Y', strtotime($row['tanggal_tenggat'])); ?></td>
                        <td class="px-5 py-4">
                            <?php if($row['STATUS'] == 'Dikembalikan'): ?>
                                <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-1 rounded-md text-[10px] font-bold">Dikembalikan</span>
                            <?php else: ?>
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 px-2 py-1 rounded-md text-[10px] font-bold">Dipinjam</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4">
                            <?php if($row['STATUS'] == 'Dipinjam'): ?>
                                <a href="kelola-peminjaman.php?kembali=<?= $row['id_peminjaman']; ?>" onclick="return confirm('Tandai buku sudah dikembalikan? Stok akan bertambah.')" class="bg-slate-800 text-white px-3 py-1.5 rounded-md text-[10px] font-medium hover:bg-slate-700 transition">Set Kembalikan</a>
                            <?php else: ?>
                                <span class="text-slate-400 text-[10px] italic">Tuntas: <?= date('d M Y', strtotime($row['tanggal_kembali'])); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>