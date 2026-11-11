
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM-Surat')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50">

    @auth
    <div class="min-h-screen md:flex">

        <!-- SIDEBAR -->
        <aside class="w-full shrink-0 bg-[#102A43] text-white md:fixed md:inset-y-0 md:left-0 md:w-64 md:flex md:flex-col">

            <!-- LOGO -->
            <div class="border-b border-white/10 px-6 py-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500 text-xl font-bold text-white shadow-lg">
                        S
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-white">SIM-Surat</h2>
                        <p class="text-xs text-blue-200">Smart Office System</p>
                    </div>
                </div>
            </div>

            <!-- MENU -->
            <div class="flex-1 px-4 py-6">
                <p class="mb-3 px-4 text-xs font-bold uppercase tracking-widest text-slate-400">
                    Menu Utama
                </p>

                <nav class="space-y-2">

                    <a href="{{ route('dashboard') }}"
                       class="nav-item {{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">
                        <span>▦</span>
                        Dashboard
                    </a>

                    <a href="{{ route('surat-masuk.index') }}"
                       class="nav-item {{ request()->routeIs('surat-masuk.*') ? 'nav-active' : '' }}">
                        <span>📥</span>
                        Surat Masuk
                    </a>

                    <a href="{{ route('surat-keluar.index') }}"
                       class="nav-item {{ request()->routeIs('surat-keluar.*') ? 'nav-active' : '' }}">
                        <span>📤</span>
                        Surat Keluar
                    </a>

                </nav>
            </div>

            <!-- PROFIL DAN LOGOUT -->
            <div class="border-t border-white/10 px-6 py-5">

                <div class="mb-4 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-500 font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold">
                            {{ auth()->user()->name ?? 'Petugas' }}
                        </p>
                        <p class="text-xs text-blue-200">Petugas SIM-Surat</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-xl bg-red-500/10 px-4 py-3 text-left text-sm font-semibold text-red-300 hover:bg-red-500 hover:text-white">
                        ↪ Keluar dari aplikasi
                    </button>
                </form>
            </div>

        </aside>

        <!-- AREA KONTEN -->
        <div class="min-w-0 flex-1 md:ml-64">

            <!-- TOPBAR -->
            <header class="sticky top-0 z-20 flex items-center justify-between border-b border-slate-200 bg-white/90 px-6 py-4 shadow-sm backdrop-blur">

                <div>
                    <p class="text-sm font-semibold text-slate-800">
                        Sistem Informasi Surat
                    </p>
                    <p class="text-xs text-slate-400">
                        Pengelolaan administrasi surat digital
                    </p>
                </div>

                <div class="hidden items-center gap-2 rounded-full bg-blue-50 px-4 py-2 text-xs font-semibold text-blue-700 sm:flex">
                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                    Sistem Aktif
                </div>

            </header>

            <!-- MAIN CONTENT -->
            <main class="min-h-[calc(100vh-130px)] px-5 py-8 md:px-8">

                @yield('content')

            </main>

            <!-- FOOTER -->
            <footer class="border-t border-slate-200 bg-white px-6 py-5 text-center">
                <p class="text-xs text-slate-500">
                    SIM-Surat &copy; {{ date('Y') }} · Sistem Informasi Pengelolaan Surat
                </p>
            </footer>

        </div>
    </div>

    @else

    <!-- LAYOUT HALAMAN LOGIN -->
    <main class="min-h-screen bg-slate-50">

        @yield('content')

        <footer class="border-t border-slate-200 bg-white px-6 py-5 text-center">
            <p class="text-xs text-slate-500">
                SIM-Surat &copy; {{ date('Y') }} · Sistem Informasi Pengelolaan Surat
            </p>
        </footer>

    </main>

    @endauth

</body>
</html>
