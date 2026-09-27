<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buku Dipinjam Saya - Perpustakaan SMKN 1 Kamal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body class="bg-slate-50 text-slate-800">

    <?php include 'includes/sidebar.php'; ?>

    <div class="ml-[235px] min-h-screen">

        <?php include 'includes/header.php'; ?>

        <main class="p-7">

            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-800 via-blue-900 to-blue-700 px-10 py-8 text-white shadow-sm">

                <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-400/20"></div>
                <div class="absolute -bottom-20 right-32 h-44 w-44 rounded-full bg-white/5"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="mb-2 flex items-center gap-2 text-blue-200">
                            <i class="fa-solid fa-user-gear text-xs"></i>
                            <span class="text-xs font-medium">
                                Area Anggota Perpustakaan
                            </span>
                        </div>

                        <h1 class="mb-2 text-2xl font-bold">
                            Buku Dipinjam Saya 📖
                        </h1>

                        <p class="max-w-lg text-sm text-blue-100">
                            Pantau daftar buku yang sedang Anda pinjam, tanggal jatuh tempo, dan perpanjang durasi peminjaman Anda.
                        </p>
                    </div>

                    <a
                        href="cari-buku.php"
                        class="inline-flex items-center gap-2 self-start md:self-auto rounded-lg bg-white px-5 py-2.5 text-xs font-semibold text-blue-800 transition hover:bg-blue-50 shadow-sm"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari Buku Lain
                    </a>
                </div>

            </section>


            <!-- =========================
                 USER SUMMARY CARDS
            ========================== -->
            <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-5">

                <!-- Sedang Dipinjam -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">
                                Sedang Dipinjam
                            </p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                2 <span class="text-xs font-normal text-slate-400">/ 3 buku (maks)</span>
                            </h3>
                            <p class="mt-2 text-[11px] text-blue-600 font-medium">
                                Masih bisa meminjam 1 buku lagi
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
                            <p class="text-xs font-medium text-slate-500">
                                Batas Kembalikan Terdekat
                            </p>
                            <h3 class="mt-2 text-xl font-bold text-amber-600">
                                2 Hari Lagi
                            </h3>
                            <p class="mt-2 text-[11px] text-slate-400">
                                Tanggal: 18 Sep 2024
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <i class="fa-solid fa-clock text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman Selesai -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500">
                                Total Pernah Dipinjam
                            </p>
                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                5
                            </h3>
                            <p class="mt-2 text-[11px] text-emerald-600 font-medium">
                                Track record peminjaman baik
                            </p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="fa-solid fa-box-archive text-lg"></i>
                        </div>
                    </div>
                </div>

            </section>


            <!-- =========================
                 WARNING / NOTICE BOX
            ========================== -->
            <div class="mt-6 flex items-center gap-3 rounded-xl border border-amber-200 bg-amber-50/80 p-4 text-xs text-amber-800">
                <i class="fa-solid fa-circle-exclamation text-base text-amber-600"></i>
                <div>
                    <span class="font-semibold">Catatan Penting:</span> Harap kembalikan buku tepat waktu sebelum tanggal jatuh tempo untuk menghindari denda keterlambatan Rp1.000 / hari.
                </div>
            </div>


            <!-- =========================
                 SECTION TITLE & TABS
            ========================== -->
            <div class="mb-5 mt-8 flex items-center justify-between border-b border-slate-200 pb-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Daftar Pinjaman Saya
                    </h2>
                    <p class="mt-0.5 text-xs text-slate-500">
                        Buku yang saat ini ada di tangan Anda.
                    </p>
                </div>

                <!-- Filter Tabs -->
                <div class="flex gap-2">
                    <button class="rounded-lg bg-blue-600 px-3.5 py-1.5 text-xs font-medium text-white shadow-sm">
                        Sedang Dipinjam
                    </button>
                    <button class="rounded-lg border border-slate-200 bg-white px-3.5 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50">
                        Riwayat
                    </button>
                </div>
            </div>


            <!-- =========================
                 MY BORROWED BOOKS GRID
            ========================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Book Item 1 -->
                <div class="flex flex-col sm:flex-row rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <!-- Book Cover Mockup -->
                   <div class="h-40 w-28 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100 border border-slate-200">
                    <img src="assets/bumi.jpg" alt="Cover Buku Bumi"
                        class="h-full w-full object-cover">
                    </div>

                    <!-- Book Info -->
                    <div class="mt-4 sm:mt-0 sm:ml-5 flex flex-1 flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <span class="rounded-md bg-blue-50 px-2 py-0.5 text-[10px] font-semibold text-blue-700 uppercase">
                                    Fantasi
                                </span>
                                <span class="text-[11px] font-medium text-amber-600">
                                    <i class="fa-solid fa-hourglass-half mr-1"></i> Sisa 2 Hari
                                </span>
                            </div>

                            <h3 class="mt-2 text-sm font-bold text-slate-800 leading-snug">
                                Bumi
                            </h3>
                            <p class="mt-1 text-xs text-slate-500">
                                Penulis: Tere Liye
                            </p>
                        </div>

                        <!-- Date Info & Action -->
                        <div class="mt-4 border-t border-slate-100 pt-3">
                            <div class="mb-3 grid grid-cols-2 gap-2 text-[11px]">
                                <div>
                                    <span class="text-slate-400">Tgl Pinjam:</span>
                                    <p class="font-medium text-slate-700">11 Sep 2024</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Jatuh Tempo:</span>
                                    <p class="font-medium text-slate-700">18 Sep 2024</p>
                                </div>
                            </div>

                            <button class="w-full rounded-lg border border-blue-600 bg-white py-2 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">
                                <i class="fa-solid fa-rotate-right mr-1"></i> Ajukan Perpanjangan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Book Item 2 -->
                <div class="flex flex-col sm:flex-row rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <!-- Book Cover Mockup -->
                    <div class="h-40 w-28 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100 border border-slate-200">
                    <img src="assets/bulan.jpg" alt="Cover buku bulan" class="h-full w-full object-cover"
                    >
                    </div>

                    <!-- Book Info -->
                    <div class="mt-4 sm:mt-0 sm:ml-5 flex flex-1 flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <span class="rounded-md bg-indigo-50 px-2 py-0.5 text-[10px] font-semibold text-indigo-700 uppercase">
                                    Fantasi
                                </span>
                                <span class="text-[11px] font-medium text-slate-500">
                                    <i class="fa-solid fa-hourglass-start mr-1"></i> Sisa 5 Hari
                                </span>
                            </div>

                            <h3 class="mt-2 text-sm font-bold text-slate-800 leading-snug">
                                Bulan
                            </h3>
                            <p class="mt-1 text-xs text-slate-500">
                                Penulis: Tere Liye
                            </p>
                        </div>

                        <!-- Date Info & Action -->
                        <div class="mt-4 border-t border-slate-100 pt-3">
                            <div class="mb-3 grid grid-cols-2 gap-2 text-[11px]">
                                <div>
                                    <span class="text-slate-400">Tgl Pinjam:</span>
                                    <p class="font-medium text-slate-700">14 Sep 2024</p>
                                </div>
                                <div>
                                    <span class="text-slate-400">Jatuh Tempo:</span>
                                    <p class="font-medium text-slate-700">21 Sep 2024</p>
                                </div>
                            </div>

                            <button class="w-full rounded-lg border border-blue-600 bg-white py-2 text-xs font-semibold text-blue-600 transition hover:bg-blue-50">
                                <i class="fa-solid fa-rotate-right mr-1"></i> Ajukan Perpanjangan
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>

</body>
</html>