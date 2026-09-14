<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cari Buku - Sistem Manajemen Perpustakaan</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>


    <!-- Main Content -->
    <div class="ml-[235px] min-h-screen">

        <!-- Header -->
        <?php include 'includes/header.php'; ?>


        <!-- Cari Buku Content -->
        <main class="p-7">

            <!-- =========================
                 SECTION TITLE & FILTER
            ========================== -->

            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h1 class="text-xl font-bold text-slate-800">
                        Katalog & Cari Buku
                    </h1>

                    <p class="mt-1 text-xs text-slate-500">
                        Temukan koleksi buku yang tersedia di Perpustakaan SMKN 1 Kamal.
                    </p>
                </div>

                <!-- Form Filter & Pencarian Cepat -->
                <div class="flex items-center gap-3">
                    <div class="relative w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input
                            type="text"
                            placeholder="Cari judul, penulis, ISBN..."
                            class="w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-4 text-xs text-slate-700 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                        >
                    </div>

                    <button class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-medium text-slate-600 transition hover:bg-slate-50">
                        <i class="fa-solid fa-filter text-slate-400"></i>
                        Filter
                    </button>
                </div>

            </div>


            <!-- =========================
                 KATALOG BUKU GRID
            ========================== -->

            <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                <!-- Item Buku 1 -->
                <div class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div>
                        <!-- Thumbnail / Cover Buku -->
                        <div class="relative mb-3 flex aspect-[3/4] w-full items-center justify-center overflow-hidden rounded-lg bg-slate-100 text-slate-300">
                            <i class="fa-solid fa-book text-4xl"></i>
                            
                            <!-- Badge Stok -->
                            <span class="absolute right-2 top-2 rounded-md bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-600 border border-emerald-100">
                                5 Tersedia
                            </span>
                        </div>

                        <!-- Info Buku -->
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600">
                            Pemrograman
                        </span>

                        <h3 class="mt-1 text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition">
                            Belajar HTML & CSS Dasar
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Penulis: Ahmad Rivai
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Rak: A-01 | 2023
                        </p>
                    </div>

                    <!-- Akses / Aksi -->
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">
                            Kode: BK-001
                        </span>

                        <button class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-600 hover:text-white">
                            <i class="fa-solid fa-bookmark text-[10px]"></i>
                            Pinjam
                        </button>
                    </div>
                </div>

                <!-- Item Buku 2 -->
                <div class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div>
                        <div class="relative mb-3 flex aspect-[3/4] w-full items-center justify-center overflow-hidden rounded-lg bg-slate-100 text-slate-300">
                            <i class="fa-solid fa-book text-4xl"></i>
                            
                            <span class="absolute right-2 top-2 rounded-md bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-600 border border-emerald-100">
                                2 Tersedia
                            </span>
                        </div>

                        <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600">
                            Jaringan
                        </span>

                        <h3 class="mt-1 text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition">
                            Mikrotik MikroTik Certified Network
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Penulis: Dian Pratama
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Rak: B-03 | 2022
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">
                            Kode: BK-002
                        </span>

                        <button class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-600 hover:text-white">
                            <i class="fa-solid fa-bookmark text-[10px]"></i>
                            Pinjam
                        </button>
                    </div>
                </div>

                <!-- Item Buku 3 (Stok Habis) -->
                <div class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div>
                        <div class="relative mb-3 flex aspect-[3/4] w-full items-center justify-center overflow-hidden rounded-lg bg-slate-100 text-slate-300">
                            <i class="fa-solid fa-book text-4xl"></i>
                            
                            <span class="absolute right-2 top-2 rounded-md bg-rose-50 px-2 py-1 text-[10px] font-semibold text-rose-600 border border-rose-100">
                                Habis
                            </span>
                        </div>

                        <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600">
                            Fiksi / Novel
                        </span>

                        <h3 class="mt-1 text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition">
                            Laskar Pelangi
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Penulis: Andrea Hirata
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Rak: C-01 | 2008
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">
                            Kode: BK-003
                        </span>

                        <button disabled class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-400 cursor-not-allowed">
                            Habis
                        </button>
                    </div>
                </div>

                <!-- Item Buku 4 -->
                <div class="group flex flex-col justify-between rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div>
                        <div class="relative mb-3 flex aspect-[3/4] w-full items-center justify-center overflow-hidden rounded-lg bg-slate-100 text-slate-300">
                            <i class="fa-solid fa-book text-4xl"></i>
                            
                            <span class="absolute right-2 top-2 rounded-md bg-emerald-50 px-2 py-1 text-[10px] font-semibold text-emerald-600 border border-emerald-100">
                                8 Tersedia
                            </span>
                        </div>

                        <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600">
                            Sains & Matematika
                        </span>

                        <h3 class="mt-1 text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-blue-600 transition">
                            Matematika Terapan SMK
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Penulis: Budi Santoso
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Rak: D-02 | 2021
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">
                            Kode: BK-004
                        </span>

                        <button class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-600 hover:text-white">
                            <i class="fa-solid fa-bookmark text-[10px]"></i>
                            Pinjam
                        </button>
                    </div>
                </div>

            </section>


            <!-- =========================
                 EMPTY STATE (Jika Buku Tidak Ditemukan)
                 *Bisa di-uncomment jika menggunakan logika PHP*
            ========================== -->
            <!-- 
            <section class="mt-7 rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                    <i class="fa-solid fa-book-open text-xl"></i>
                </div>
                <h3 class="mt-4 text-sm font-semibold text-slate-700">
                    Buku tidak ditemukan
                </h3>
                <p class="mx-auto mt-1 max-w-md text-xs leading-5 text-slate-400">
                    Coba masukkan kata kunci pencarian yang lain atau periksa filter kategori yang dipilih.
                </p>
            </section> 
            -->

        </main>

    </div>

</body>
</html>