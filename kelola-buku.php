<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userRole'] !== 'admin') {
    header("Location: index.php");
    exit;
}
$nama_admin = $_SESSION['admin_data']['nama_petugas'] ?? 'Administrator';

// Proses Tambah Buku
if (isset($_POST['tambah_buku'])) {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $stmt = $conn->prepare("INSERT INTO buku (judul_buku, pengarang, penerbit, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $judul, $pengarang, $penerbit, $tahun, $stok);
    $stmt->execute();
    header("Location: kelola-buku.php");
    exit;
}

// Proses Hapus Buku
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM buku WHERE id_buku = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: kelola-buku.php");
    exit;
}

$queryBuku = $conn->query("SELECT * FROM buku ORDER BY id_buku DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800">
    <!-- Sidebar -->
<!-- Sidebar -->
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
            <!-- Catatan: Pindahkan class 'bg-blue-50 text-blue-700' ke menu yang sedang aktif di masing-masing halaman -->
            <a href="dashboardadmin.php" class="flex items-center gap-3 rounded-lg bg-blue-50 px-3 py-2.5 text-xs font-semibold text-blue-700 transition">
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
    <div class="border-t border-slate-100 pt-3 flex items-center gap-3 px-2 mt-auto">
        <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-sm">
            ADM
        </div>
        <div class="overflow-hidden">
            <!-- Nama admin dipanggil dinamis dari session -->
            <p class="text-xs font-semibold text-slate-800 truncate"><?= htmlspecialchars($_SESSION['admin_data']['nama_petugas'] ?? 'Administrator'); ?></p>
            <p class="text-[10px] text-slate-400 truncate">Administrator</p>
        </div>
    </div>
</aside>

    <div class="ml-[235px] p-7">
        <header class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Kelola Data Buku</h2>
            <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-blue-700"><i class="fa-solid fa-plus mr-1"></i> Tambah Buku</button>
        </header>

        <!-- Tabel Buku -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-500 font-semibold border-b">
                    <tr>
                        <th class="px-5 py-3.5">ID</th>
                        <th class="px-5 py-3.5">Judul Buku</th>
                        <th class="px-5 py-3.5">Pengarang & Penerbit</th>
                        <th class="px-5 py-3.5">Tahun</th>
                        <th class="px-5 py-3.5">Stok</th>
                        <th class="px-5 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php while($row = $queryBuku->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-4 font-mono font-bold text-blue-600"><?= $row['id_buku']; ?></td>
                        <td class="px-5 py-4 font-semibold"><?= htmlspecialchars($row['judul_buku']); ?></td>
                        <td class="px-5 py-4"><?= htmlspecialchars($row['pengarang']); ?><br><span class="text-[10px] text-slate-400"><?= htmlspecialchars($row['penerbit']); ?></span></td>
                        <td class="px-5 py-4"><?= $row['tahun_terbit']; ?></td>
                        <td class="px-5 py-4 font-bold"><?= $row['stok']; ?></td>
                        <td class="px-5 py-4">
                            <a href="kelola-buku.php?hapus=<?= $row['id_buku']; ?>" onclick="return confirm('Hapus buku ini?')" class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-md p-6">
            <h3 class="font-bold text-lg mb-4">Tambah Buku Baru</h3>
            <form method="POST" class="space-y-4 text-xs">
                <div><label class="font-semibold">Judul Buku</label><input type="text" name="judul" required class="w-full border rounded-lg p-2 mt-1"></div>
                <div><label class="font-semibold">Pengarang</label><input type="text" name="pengarang" required class="w-full border rounded-lg p-2 mt-1"></div>
                <div><label class="font-semibold">Penerbit</label><input type="text" name="penerbit" required class="w-full border rounded-lg p-2 mt-1"></div>
                <div class="flex gap-4">
                    <div class="w-1/2"><label class="font-semibold">Tahun Terbit</label><input type="number" name="tahun" required class="w-full border rounded-lg p-2 mt-1"></div>
                    <div class="w-1/2"><label class="font-semibold">Stok Awal</label><input type="number" name="stok" required class="w-full border rounded-lg p-2 mt-1"></div>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 bg-slate-100 rounded-lg">Batal</button>
                    <button type="submit" name="tambah_buku" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>