<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Manajemen Perpustakaan</title>

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


        <!-- Dashboard Content -->
        <main class="p-7">

            <!-- =========================
                 WELCOME BANNER
            ========================== -->

            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-800 via-blue-900 to-blue-700 px-10 py-8 text-white shadow-sm">

                <!-- Decorative Circle -->
                <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-blue-400/20"></div>

                <div class="absolute -bottom-20 right-32 h-44 w-44 rounded-full bg-white/5"></div>


                <!-- Content -->
                <div class="relative z-10">

                    <div class="mb-2 flex items-center gap-2 text-blue-200">
                        <i class="fa-solid fa-book-open-reader text-sm"></i>

                        <span class="text-xs font-medium">
                            Sistem Manajemen Perpustakaan SMKN 1 Kamal
                        </span>
                    </div>


                    <h1 class="mb-2 text-2xl font-bold">
                        Selamat Datang! 👋
                    </h1>


                    <p class="mb-5 max-w-lg text-sm text-blue-100">
                        Kelola koleksi buku dan aktivitas perpustakaan
                        dengan mudah melalui sistem ini.
                    </p>


                    <a
                        href="cari-buku.php"
                        class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-2.5 text-xs font-semibold text-blue-800 transition hover:bg-blue-50"
                    >
                        <i class="fa-solid fa-compass"></i>

                        Jelajahi Buku
                    </a>

                </div>

            </section>


            <!-- =========================
                 SECTION TITLE
            ========================== -->

            <div class="mb-5 mt-8">

                <h2 class="text-lg font-bold text-slate-800">
                    Ringkasan Perpustakaan
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Informasi aktivitas perpustakaan saat ini.
                </p>

            </div>


            <!-- =========================
                 STATISTICS
            ========================== -->

            <section class="grid grid-cols-3 gap-5">


                <!-- Total Buku -->

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-xs font-medium text-slate-500">
                                Total Buku
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-[11px] text-slate-400">
                                Belum ada data buku
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                            <i class="fa-solid fa-layer-group text-lg"></i>

                        </div>

                    </div>

                </div>


                <!-- Buku Dipinjam -->

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-xs font-medium text-slate-500">
                                Buku Dipinjam
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-[11px] text-slate-400">
                                Belum ada peminjaman
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                            <i class="fa-solid fa-arrow-up-right-from-square text-lg"></i>

                        </div>

                    </div>

                </div>


                <!-- Anggota Aktif -->

                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-xs font-medium text-slate-500">
                                Anggota Aktif
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-[11px] text-slate-400">
                                Belum ada anggota
                            </p>

                        </div>


                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">

                            <i class="fa-solid fa-user-group text-lg"></i>

                        </div>

                    </div>

                </div>


            </section>


            <!-- =========================
                 EMPTY STATE
            ========================== -->

            <section class="mt-7 rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                    <i class="fa-solid fa-database text-xl"></i>

                </div>

                <h3 class="mt-4 text-sm font-semibold text-slate-700">
                    Belum ada aktivitas
                </h3>

                <p class="mx-auto mt-1 max-w-md text-xs leading-5 text-slate-400">
                    Data perpustakaan akan muncul di dashboard
                    setelah buku, anggota, dan transaksi ditambahkan.
                </p>

            </section>

        </main>

    </div>

</body>
</html>