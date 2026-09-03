<header
    class="flex h-[65px] items-center justify-between border-b border-slate-200 bg-white px-7"
>

    <!-- =========================
         SEARCH
    ========================== -->

    <div
        class="flex h-9 w-[370px] items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 px-3.5"
    >

        <i class="fa-solid fa-magnifying-glass text-xs text-slate-400"></i>

        <input
            type="text"
            placeholder="Cari buku, penulis, atau kode..."
            class="w-full bg-transparent text-xs text-slate-700 outline-none placeholder:text-slate-400"
        >

    </div>


    <!-- =========================
         HEADER RIGHT
    ========================== -->

    <div class="flex items-center gap-5">


        <!-- Notification -->

        <button
            class="relative flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
        >

            <i class="fa-regular fa-bell text-sm"></i>

            <span
                class="absolute right-1 top-1 h-1.5 w-1.5 rounded-full bg-blue-600"
            ></span>

        </button>


        <!-- Divider -->

        <div class="h-7 w-px bg-slate-200"></div>


        <!-- User -->

        <div class="flex items-center gap-3">

            <div
                class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700"
            >
                U
            </div>

            <div>

                <p class="text-[10px] text-slate-400">
                    Selamat datang,
                </p>

                <p class="text-xs font-semibold text-slate-700">
                    User
                </p>

            </div>

            <i class="fa-solid fa-chevron-down ml-1 text-[9px] text-slate-400"></i>

        </div>

    </div>

</header>