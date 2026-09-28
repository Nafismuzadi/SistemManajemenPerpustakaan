<?php
session_start();
require 'koneksi.php'; // Opsional, tambahkan jika di file tersebut butuh ambil data database

// Cek apakah user sudah login
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    // Jika belum login, tendang kembali ke halaman pilihan akses
    header("Location: index.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Peminjaman Buku - Perpustakaan SMKN 1 Kamal</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Sidebar Mockup -->
    <aside class="fixed left-0 top-0 h-full w-[235px] bg-white border-r border-slate-200 z-20 flex flex-col justify-between p-4">
        <div>
            <!-- Brand -->
            <div class="flex items-center gap-3 px-2 py-3 border-b border-slate-100">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white font-bold shadow-md shadow-blue-500/20">
                    <i class="fa-solid fa-book-bookmark text-lg"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold text-slate-800 leading-tight">PERPUS SMKN 1</h1>
                    <p class="text-[10px] text-slate-500">Perpustakaan Digital</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-6 space-y-1">
                <a href="dashboard.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-house w-4 text-center"></i>
                    Dashboard
                </a>
                <a href="buku-dipinjam.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-book-reader w-4 text-center"></i>
                    Buku Dipinjam Saya
                </a>
                <a href="pinjam-buku.php" class="flex items-center gap-3 rounded-lg bg-blue-50 px-3 py-2.5 text-xs font-semibold text-blue-700 transition">
                    <i class="fa-solid fa-hand-holding-hand w-4 text-center"></i>
                    Pinjam Buku Baru
                </a>
                <a href="riwayat.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-clock-rotate-left w-4 text-center"></i>
                    Riwayat Transaksi
                </a>
            </nav>
        </div>

        <!-- User Profile Footer -->
        <div class="border-t border-slate-100 pt-3 flex items-center gap-3 px-2">
            <div class="h-8 w-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 text-xs font-bold">
                A
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-slate-800 truncate">Ahmad Rizky</p>
                <p class="text-[10px] text-slate-400 truncate">NISN: 005481203</p>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="ml-[235px] min-h-screen">

        <!-- Header Mockup -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-slate-200 px-7 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span>Perpustakaan</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="font-medium text-slate-800">Form Peminjaman</span>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative text-slate-500 hover:text-slate-700">
                    <i class="fa-regular fa-bell text-base"></i>
                    <span class="absolute -top-1 -right-1 flex h-2 w-2 rounded-full bg-red-500"></span>
                </button>
            </div>
        </header>

        <!-- Main User Section -->
        <main class="p-7">

            <!-- =========================
                 WELCOME / USER BANNER
            ========================== -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-800 via-blue-900 to-blue-700 px-10 py-8 text-white shadow-sm">
                <!-- Decorative Circles -->
                <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-400/20"></div>
                <div class="absolute -bottom-20 right-32 h-44 w-44 rounded-full bg-white/5"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="mb-2 flex items-center gap-2 text-blue-200">
                            <i class="fa-solid fa-book-bookmark text-xs"></i>
                            <span class="text-xs font-medium">Formulir Peminjaman Digital</span>
                        </div>

                        <h1 class="mb-2 text-2xl font-bold">
                            Ajukan Peminjaman Buku 📝
                        </h1>

                        <p class="max-w-lg text-sm text-blue-100">
                            Pilih buku yang ingin Anda pinjam, tentukan durasi peminjaman, dan konfirmasi permohonan Anda.
                        </p>
                    </div>

                    <a href="buku-dipinjam.php" class="inline-flex items-center gap-2 self-start md:self-auto rounded-lg bg-white/10 border border-white/20 px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-white/20 shadow-sm backdrop-blur-sm">
                        <i class="fa-solid fa-book-reader"></i>
                        Lihat Buku Dipinjam Saya
                    </a>
                </div>
            </section>

            <!-- =========================
                 SUMMARY / STATUS CARDS
            ========================== -->
            <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Status Sisa Kuota -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Sisa Kuota Peminjaman</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                1 <span class="text-xs font-normal text-slate-400">/ 3 buku lagi</span>
                            </h3>
                            <p class="mt-2 text-[11px] text-blue-600 font-medium">
                                Anda sudah meminjam 2 dari 3 maksimal buku
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-layer-group text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Durasi Peminjaman Standar -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Maksimal Durasi</p>
                            <h3 class="mt-2 text-2xl font-bold text-slate-800">7 Hari Kerja</h3>
                            <p class="mt-2 text-[11px] text-emerald-600 font-medium">
                                Dapat diperpanjang 1x (7 hari lagi)
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-calendar-check text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Denda & Ketentuan -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Denda Keterlambatan</p>
                            <h3 class="mt-2 text-2xl font-bold text-slate-800">Rp1.000 <span class="text-xs font-normal text-slate-400">/ hari</span></h3>
                            <p class="mt-2 text-[11px] text-amber-600 font-medium">
                                Bebas denda jika dikembalikan tepat waktu
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- =========================
                 FORM & PREVIEW SECTION
            ========================== -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Form Area (Left / 2 Cols) -->
                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                    <div class="border-b border-slate-200 pb-4 mb-6">
                        <h2 class="text-base font-bold text-slate-800">Form Permohonan Pinjam</h2>
                        <p class="text-xs text-slate-500 mt-1">Lengkapi data di bawah ini untuk memproses peminjaman buku ke petugas.</p>
                    </div>

                    <form action="proses-pinjam.php" method="POST" class="space-y-5">
                        
                        <!-- Peminjam Info (Disabled / Readonly) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Anggota</label>
                                <input type="text" value="Ahmad Rizky Pratama" readonly class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-medium text-slate-600 focus:outline-none cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">NISN / Kelas</label>
                                <input type="text" value="005481203 - XII RPL 1" readonly class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-medium text-slate-600 focus:outline-none cursor-not-allowed">
                            </div>
                        </div>

                        <!-- Pilih Buku -->
                        <div>
                            <label for="buku" class="block text-xs font-semibold text-slate-700 mb-1.5">
                                Pilih Buku <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="buku" name="buku_id" required class="w-full appearance-none rounded-lg border border-slate-200 bg-white px-3.5 py-2.5 text-xs text-slate-800 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="" disabled selected>-- Cari Kode atau Judul Buku --</option>
                                    <option value="BK-001">BK-001 | Sistem Terdistribusi dan Cloud Computing (Tersedia: 4)</option>
                                    <option value="BK-002">BK-002 | Desain Grafis & UI/UX untuk Pemula (Tersedia: 2)</option>
                                    <option value="BK-003">BK-003 | Pemrograman Python & Machine Learning (Tersedia: 1)</option>
                                    <option value="BK-004">BK-004 | Manajemen Basis Data MySQL (Tersedia: 3)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Dates Row -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="tgl_pinjam" class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Peminjaman</label>
                                <input type="date" id="tgl_pinjam" name="tgl_pinjam" value="2024-09-16" class="w-full rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-xs text-slate-800 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                            </div>
                            <div>
                                <label for="tgl_kembali" class="block text-xs font-semibold text-slate-700 mb-1.5">Estimasi Tanggal Kembalikan</label>
                                <input type="date" id="tgl_kembali" name="tgl_kembali" value="2024-09-23" readonly class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-semibold text-blue-700 focus:outline-none cursor-not-allowed">
                            </div>
                        </div>

                        <!-- Durasi Selection -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Durasi Peminjaman</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="flex items-center justify-center gap-2 rounded-lg border border-blue-600 bg-blue-50/50 p-2 text-xs font-semibold text-blue-700 cursor-pointer">
                                    <input type="radio" name="durasi" value="7" checked class="text-blue-600 focus:ring-blue-500">
                                    7 Hari (Standar)
                                </label>
                                <label class="flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white p-2 text-xs font-medium text-slate-600 cursor-pointer hover:bg-slate-50">
                                    <input type="radio" name="durasi" value="3" class="text-blue-600 focus:ring-blue-500">
                                    3 Hari
                                </label>
                                <label class="flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white p-2 text-xs font-medium text-slate-600 cursor-pointer hover:bg-slate-50">
                                    <input type="radio" name="durasi" value="14" class="text-blue-600 focus:ring-blue-500">
                                    14 Hari (Khusus Tesis)
                                </label>
                            </div>
                        </div>

                        <!-- Catatan / Tujuan -->
                        <div>
                            <label for="catatan" class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Tambahan (Opsional)</label>
                            <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: Dipinjam untuk pengerjaan tugas akhir Mapel RPL..." class="w-full rounded-lg border border-slate-200 p-3 text-xs text-slate-800 placeholder-slate-400 focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600"></textarea>
                        </div>

                        <!-- Persetujuan -->
                        <div class="flex items-start gap-2.5 pt-2">
                            <input type="checkbox" id="syarat" required class="mt-0.5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <label for="syarat" class="text-xs text-slate-600 leading-normal">
                                Saya berjanji akan menjaga kondisi buku fisik tetap baik dan mengembalikannya sebelum/pada tanggal jatuh tempo.
                            </label>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                            <a href="dashboard.php" class="rounded-lg border border-slate-200 px-5 py-2.5 text-xs font-medium text-slate-600 transition hover:bg-slate-50">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-2.5 text-xs font-semibold text-white transition hover:bg-blue-700 shadow-sm shadow-blue-500/20">
                                <i class="fa-solid fa-paper-plane"></i>
                                Kirim Permohonan
                            </button>
                        </div>

                    </form>
                </div>

                <!-- Preview Selected Book (Right / 1 Col) -->
                <div class="space-y-6">
                    <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Preview Buku Dipilih
                        </h3>

                        <div class="mt-4 flex flex-col items-center text-center">
                            <!-- Cover Mockup -->
                            <div class="h-44 w-32 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 shadow-sm relative overflow-hidden group">
                                <i class="fa-solid fa-book-open text-4xl group-hover:scale-110 transition duration-300"></i>
                                <span class="absolute top-2 right-2 rounded bg-emerald-100 px-1.5 py-0.5 text-[9px] font-bold text-emerald-700">Tersedia</span>
                            </div>

                            <h4 class="mt-4 text-sm font-bold text-slate-800">Sistem Terdistribusi dan Cloud Computing</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Penulis: Prof. Dr. Eko Mulyadi</p>
                            
                            <div class="mt-3 flex flex-wrap justify-center gap-1.5">
                                <span class="rounded-md bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-700 uppercase">Teknologi</span>
                                <span class="rounded-md bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Rak A-03</span>
                            </div>
                        </div>

                        <!-- Info Detail Mini Table -->
                        <div class="mt-5 border-t border-slate-100 pt-4 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Kode Buku:</span>
                                <span class="font-semibold text-slate-700">BK-001</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Penerbit:</span>
                                <span class="font-medium text-slate-700">Informatika Press</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Tahun Terbit:</span>
                                <span class="font-medium text-slate-700">2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Stok Perpustakaan:</span>
                                <span class="font-semibold text-slate-800">4 Eksemplar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Help Box -->
                    <div class="rounded-xl border border-blue-100 bg-blue-50/50 p-4 text-xs text-blue-800 flex items-start gap-3">
                        <i class="fa-solid fa-circle-info text-base text-blue-600 mt-0.5"></i>
                        <div>
                            <span class="font-semibold block mb-0.5">Petunjuk Peminjaman:</span>
                            Setelah permohonan dikirim, silakan tunjukkan QR/Kode Transaksi di perpustakaan untuk mengambil buku fisik ke petugas.
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>

</body>
</html>