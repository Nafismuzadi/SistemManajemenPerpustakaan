<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Peminjaman - Perpustakaan SMKN 1 Kamal</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Sidebar Mockup (Admin) -->
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
                <a href="admin-dashboard.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
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
                <a href="laporan-peminjaman.php" class="flex items-center gap-3 rounded-lg bg-blue-50 px-3 py-2.5 text-xs font-semibold text-blue-700 transition">
                    <i class="fa-solid fa-file-invoice w-4 text-center"></i>
                    Laporan Peminjaman
                </a>
                <a href="kelola-anggota.php" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                    <i class="fa-solid fa-users w-4 text-center"></i>
                    Data Anggota
                </a>
            </nav>
        </div>

        <!-- Admin Profile Footer -->
        <div class="border-t border-slate-100 pt-3 flex items-center gap-3 px-2">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shadow-sm">
                ADM
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-slate-800 truncate">Bambang S.Pd.</p>
                <p class="text-[10px] text-slate-400 truncate">NIP: 198503122010</p>
            </div>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="ml-[235px] min-h-screen">

        <!-- Header Mockup -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-slate-200 px-7 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <span>Admin Panel</span>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="font-medium text-slate-800">Laporan Peminjaman</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-medium text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Petugas Aktif
                </span>
                <button class="relative text-slate-500 hover:text-slate-700">
                    <i class="fa-regular fa-bell text-base"></i>
                    <span class="absolute -top-1 -right-1 flex h-2 w-2 rounded-full bg-blue-600"></span>
                </button>
            </div>
        </header>

        <!-- Main Admin Section -->
        <main class="p-7">

            <!-- =========================
                 WELCOME / ADMIN BANNER
            ========================== -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-800 via-blue-900 to-blue-700 px-10 py-8 text-white shadow-sm">
                <!-- Decorative Circles -->
                <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-400/20"></div>
                <div class="absolute -bottom-20 right-32 h-44 w-44 rounded-full bg-white/5"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="mb-2 flex items-center gap-2 text-blue-200">
                            <i class="fa-solid fa-chart-column text-xs"></i>
                            <span class="text-xs font-medium">Panel Pelaporan & Analisis</span>
                        </div>

                        <h1 class="mb-2 text-2xl font-bold">
                            Laporan Data Peminjaman Buku 📊
                        </h1>

                        <p class="max-w-lg text-sm text-blue-100">
                            Rekapitulasi riwayat peminjaman, statistik bulanan, status keterlambatan, dan denda anggota perpustakaan.
                        </p>
                    </div>

                    <!-- Action Export Buttons -->
                    <div class="flex flex-wrap items-center gap-2.5 self-start md:self-auto">
                        <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg bg-white/10 border border-white/20 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-white/20 shadow-sm backdrop-blur-sm">
                            <i class="fa-solid fa-print"></i>
                            Cetak
                        </button>
                        <a href="export-excel.php" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-emerald-700 shadow-sm">
                            <i class="fa-solid fa-file-excel"></i>
                            Export Excel
                        </a>
                        <a href="export-pdf.php" class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-semibold text-blue-800 transition hover:bg-blue-50 shadow-sm">
                            <i class="fa-solid fa-file-pdf text-red-600"></i>
                            Export PDF
                        </a>
                    </div>
                </div>
            </section>

            <!-- =========================
                 ADMIN SUMMARY CARDS
            ========================== -->
            <section class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-5">
                <!-- Total Transaksi -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Total Peminjaman</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800">128</h3>
                            <p class="mt-2 text-[11px] text-blue-600 font-medium">
                                <i class="fa-solid fa-arrow-trend-up mr-1"></i> +12% dari bulan lalu
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <i class="fa-solid fa-book-reader text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Sedang Dipinjam -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Sedang Dipinjam</p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800">34</h3>
                            <p class="mt-2 text-[11px] text-indigo-600 font-medium">Buku belum dikembalikan</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <i class="fa-solid fa-clock text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Keterlambatan -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Terlambat</p>
                            <h3 class="mt-2 text-3xl font-bold text-red-600">6</h3>
                            <p class="mt-2 text-[11px] text-red-500 font-medium">Perlu tindak lanjut</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <i class="fa-solid fa-circle-exclamation text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Denda Terkumpul -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">Denda Terkumpul</p>
                            <h3 class="mt-2 text-2xl font-bold text-emerald-600">Rp45.000</h3>
                            <p class="mt-2 text-[11px] text-slate-400">Periode Bulan Ini</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-hand-holding-dollar text-lg"></i>
                        </div>
                    </div>
                </div>
            </section>

            <!-- =========================
                 FILTER & SEARCH BAR
            ========================== -->
            <div class="mt-8 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <form action="" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search Input -->
                    <div class="lg:col-span-2">
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">CARI ANGGOTA / JUDUL / KODE</label>
                        <div class="relative">
                            <input type="text" name="search" placeholder="Masukkan NISN, Nama, atau Judul Buku..." class="w-full rounded-lg border border-slate-200 bg-slate-50 pl-9 pr-3.5 py-2 text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
                        </div>
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">STATUS PINJAM</label>
                        <select name="status" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-800 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="">Semua Status</option>
                            <option value="dipinjam">Sedang Dipinjam</option>
                            <option value="kembali">Selesai / Dikembalikan</option>
                            <option value="terlambat">Terlambat</option>
                        </select>
                    </div>

                    <!-- Filter Dari Tanggal -->
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 mb-1">DARI TANGGAL</label>
                        <input type="date" name="tgl_mulai" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-800 focus:bg-white focus:border-blue-600 focus:outline-none">
                    </div>

                    <!-- Filter Sampai Tanggal / Button -->
                    <div class="flex items-end gap-2">
                        <div class="flex-1">
                            <label class="block text-[11px] font-semibold text-slate-500 mb-1">SAMPAI TANGGAL</label>
                            <input type="date" name="tgl_selesai" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-800 focus:bg-white focus:border-blue-600 focus:outline-none">
                        </div>
                        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700 transition shadow-sm h-[34px] flex items-center justify-center">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- =========================
                 DATA TABLE SECTION
            ========================== -->
            <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                <!-- Table Header Title & Tabs -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-slate-200 p-5 gap-3">
                    <div>
                        <h2 class="text-base font-bold text-slate-800">Data Transaksi Peminjaman</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Menampilkan seluruh rekaman transaksi permohonan dan pengembalian.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-slate-500">Tampilkan:</span>
                        <select class="rounded-lg border border-slate-200 px-2.5 py-1 text-xs text-slate-700 focus:outline-none">
                            <option>10 data</option>
                            <option>25 data</option>
                            <option>50 data</option>
                        </select>
                    </div>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-700">
                        <thead class="bg-slate-50 text-[11px] uppercase text-slate-500 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-3.5">ID Pinjam</th>
                                <th class="px-5 py-3.5">Anggota / Peminjam</th>
                                <th class="px-5 py-3.5">Buku & Kode</th>
                                <th class="px-5 py-3.5">Tgl Pinjam</th>
                                <th class="px-5 py-3.5">Jatuh Tempo</th>
                                <th class="px-5 py-3.5">Status</th>
                                <th class="px-5 py-3.5">Denda</th>
                                <th class="px-5 py-3.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            
                            <!-- Row 1: Terlambat -->
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-5 py-4 font-mono font-bold text-blue-700">#PJM-2024-001</td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-slate-800">Ahmad Rizky Pratama</div>
                                    <div class="text-[10px] text-slate-400">NISN: 005481203 • XII RPL 1</div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-800 max-w-xs truncate">Pemrograman Web Modern dengan Tailwind CSS</div>
                                    <div class="text-[10px] text-slate-400">Kode: BK-001 • Rak A-01</div>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap text-slate-600">11 Sep 2024</td>
                                <td class="px-5 py-4 whitespace-nowrap text-slate-600">18 Sep 2024</td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-md bg-red-50 px-2.5 py-1 text-[10px] font-semibold text-red-700 border border-red-200">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Terlambat (2 Hari)
                                    </span>
                                </td>
                                <td class="px-5 py-4 font-semibold text-red-600 whitespace-nowrap">Rp2.000</td>
                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button title="Proses Pengembalian" class="rounded-lg bg-emerald-50 p-2 text-emerald-600 hover:bg-emerald-100 transition">
                                            <i class="fa-solid fa-arrow-rotate-left"></i>
                                        </button>
                                        <button title="Detail Transaksi" class="rounded-lg bg-slate-100 p-2 text-slate-600 hover:bg-slate-200 transition">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2: Dipinjam (Aman) -->
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-5 py-4 font-mono font-bold text-blue-700">#PJM-2024-002</td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-slate-800">Siti Nurhaliza</div>
                                    <div class="text-[10px] text-slate-400">NISN: 005481209 • XI TKJ 2</div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-800 max-w-xs truncate">Dasar-Dasar Jaringan Komputer & MikroTik</div>
                                    <div class="text-[10px] text-slate-400">Kode: BK-002 • Rak B-04</div>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap text-slate-600">14 Sep 2024</td>
                                <td class="px-5 py-4 whitespace-nowrap text-slate-600">21 Sep 2024</td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2.5 py-1 text-[10px] font-semibold text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-book-open"></i> Sedang Dipinjam
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-slate-400 whitespace-nowrap">-</td>
                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button title="Proses Pengembalian" class="rounded-lg bg-emerald-50 p-2 text-emerald-600 hover:bg-emerald-100 transition">
                                            <i class="fa-solid fa-arrow-rotate-left"></i>
                                        </button>
                                        <button title="Detail Transaksi" class="rounded-lg bg-slate-100 p-2 text-slate-600 hover:bg-slate-200 transition">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3: Dikembalikan / Selesai -->
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-5 py-4 font-mono font-bold text-blue-700">#PJM-2024-003</td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-slate-800">Budi Santoso</div>
                                    <div class="text-[10px] text-slate-400">NISN: 005481215 • X TKR 1</div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-800 max-w-xs truncate">Manajemen Basis Data MySQL Untuk Pemula</div>
                                    <div class="text-[10px] text-slate-400">Kode: BK-004 • Rak C-02</div>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap text-slate-600">01 Sep 2024</td>
                                <td class="px-5 py-4 whitespace-nowrap text-slate-600">08 Sep 2024</td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2.5 py-1 text-[10px] font-semibold text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-circle-check"></i> Selesai
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-slate-400 whitespace-nowrap">Rp0</td>
                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button title="Detail Transaksi" class="rounded-lg bg-slate-100 p-2 text-slate-600 hover:bg-slate-200 transition">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Table Footer & Pagination -->
                <div class="flex flex-col sm:flex-row items-center justify-between border-t border-slate-200 px-5 py-3.5 text-xs text-slate-500 gap-3">
                    <span>Menampilkan 1-3 dari total 128 peminjaman</span>
                    <div class="flex items-center gap-1">
                        <button class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 font-medium text-slate-600 hover:bg-slate-50 disabled:opacity-50" disabled>
                            <i class="fa-solid fa-chevron-left text-[10px]"></i> Prev
                        </button>
                        <button class="rounded-lg bg-blue-600 px-3 py-1.5 font-semibold text-white">1</button>
                        <button class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 font-medium text-slate-600 hover:bg-slate-50">2</button>
                        <button class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 font-medium text-slate-600 hover:bg-slate-50">3</button>
                        <button class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 font-medium text-slate-600 hover:bg-slate-50">
                            Next <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

        </main>

    </div>

</body>
</html>