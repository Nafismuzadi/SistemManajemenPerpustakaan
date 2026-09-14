<?php
// Deteksi nama file halaman yang sedang dibuka secara presisi
$page_saat_ini = $page_saat_ini ?? basename($_SERVER['SCRIPT_NAME'] ?? $_SERVER['PHP_SELF']);
?>

<aside
    class="fixed left-0 top-0 z-50 flex h-screen w-[235px] flex-col border-r border-slate-200 bg-white"
>

    <!-- =========================
         BRAND
    ========================== -->

    <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5">

        <div
            class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm"
        >
            <i class="fa-solid fa-book-open-reader"></i>
        </div>

        <div>

            <h2 class="text-[15px] font-bold text-slate-800">
                Perpustakaan SMKN 1 Kamal
            </h2>

            <p class="text-[9px] text-slate-400">
                Management System
            </p>

        </div>

    </div>


    <!-- =========================
         NAVIGATION
    ========================== -->

    <div class="px-3 py-6">

        <p class="mb-3 px-3 text-[9px] font-semibold uppercase tracking-wider text-slate-400">
            Menu Utama
        </p>


        <nav class="space-y-1">


            <!-- Dashboard -->

            <a
                href="dashboard.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-semibold transition <?= ($page_saat_ini == 'dashboard.php' || $page_saat_ini == '') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' ?>"
            >

                <i class="fa-solid fa-house w-5 text-center <?= ($page_saat_ini == 'dashboard.php' || $page_saat_ini == '') ? 'text-white' : 'text-slate-400' ?>"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- Cari Buku -->

            <a
                href="cari-buku.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-semibold transition <?= ($page_saat_ini == 'cari-buku.php') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' ?>"
            >

                <i class="fa-solid fa-magnifying-glass w-5 text-center <?= ($page_saat_ini == 'cari-buku.php') ? 'text-white' : 'text-slate-400' ?>"></i>

                <span>
                    Cari Buku
                </span>

            </a>


            <!-- Buku Dipinjam -->

            <a
                href="buku-dipinjam.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-semibold transition <?= ($page_saat_ini == 'buku-dipinjam.php') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' ?>"
            >

                <i class="fa-solid fa-bookmark w-5 text-center <?= ($page_saat_ini == 'buku-dipinjam.php') ? 'text-white' : 'text-slate-400' ?>"></i>

                <span>
                    Buku Dipinjam
                </span>

            </a>


            <!-- Daftar Tunggu -->

            <a
                href="daftar-tunggu.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-semibold transition <?= ($page_saat_ini == 'daftar-tunggu.php') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' ?>"
            >

                <i class="fa-solid fa-list-check w-5 text-center <?= ($page_saat_ini == 'daftar-tunggu.php') ? 'text-white' : 'text-slate-400' ?>"></i>

                <span>
                    Daftar Tunggu
                </span>

            </a>


            <!-- Profil -->

            <a
                href="profil.php"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-semibold transition <?= ($page_saat_ini == 'profil.php') ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100' ?>"
            >

                <i class="fa-solid fa-id-card w-5 text-center <?= ($page_saat_ini == 'profil.php') ? 'text-white' : 'text-slate-400' ?>"></i>

                <span>
                    Profil
                </span>

            </a>

        </nav>

    </div>


    <!-- =========================
         SIDEBAR BOTTOM
    ========================== -->

    <div class="mt-auto border-t border-slate-100 p-3">

        <a
            href="rolelogin.php"
            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-xs font-semibold text-red-500 transition hover:bg-red-50"
        >

            <i class="fa-solid fa-power-off w-5 text-center"></i>

            <span>
                Keluar
            </span>

        </a>

    </div>

</aside>