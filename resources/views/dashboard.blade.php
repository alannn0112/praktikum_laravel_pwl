@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- HEADER BANNER SELAMAT DATANG --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-700 to-blue-500 p-8 text-white shadow-lg">
        <div class="relative z-10 max-w-3xl">
            <p class="text-xs font-semibold tracking-wider text-blue-100 uppercase">
                Sistem Informasi Pengelolaan Surat
            </p>

            <h1 class="mt-2 text-3xl font-bold">
                Selamat Datang, {{ auth()->user()->name ?? 'Petugas SIM-Surat' }}!
            </h1>

            <p class="mt-3 text-sm text-blue-100 leading-relaxed">
                Kelola administrasi surat masuk dan surat keluar dengan lebih mudah, cepat, dan terorganisir dalam satu platform digital.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('surat-masuk.index') }}"
                   class="rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-blue-700 shadow transition hover:bg-blue-50">
                    + Surat Masuk
                </a>

                <a href="{{ route('surat-keluar.index') }}"
                   class="rounded-lg border border-white/50 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">
                    + Surat Keluar
                </a>
            </div>
        </div>

        <div class="absolute -right-10 -top-16 h-64 w-64 rounded-full bg-white/10 pointer-events-none"></div>
        <div class="absolute -bottom-24 right-36 h-56 w-56 rounded-full bg-white/10 pointer-events-none"></div>
    </div>


    {{-- AKSES CEPAT (DIPERLEBAR PENUH) --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
        <h2 class="text-lg font-bold text-slate-800">
            Akses Cepat Menu Utama
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Pilih menu di bawah ini untuk mulai mengelola arsip surat masuk dan surat keluar.
        </p>

        {{-- GRID TOMBOL AKSES CEPAT MENJADI 2 KOLOM SEJAJAR --}}
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <a href="{{ route('surat-masuk.index') }}"
               class="group flex items-center gap-4 rounded-xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/50 shadow-sm">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                    📥
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-semibold text-slate-800 group-hover:text-blue-600 transition">Surat Masuk</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola data surat yang diterima instansi</p>
                </div>
                <span class="text-slate-400 group-hover:text-blue-600 text-lg font-bold">→</span>
            </a>

            <a href="{{ route('surat-keluar.index') }}"
               class="group flex items-center gap-4 rounded-xl border border-slate-200 p-5 transition hover:border-green-300 hover:bg-green-50/50 shadow-sm">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-2xl">
                    📤
                </div>
                <div class="flex-1">
                    <h3 class="text-base font-semibold text-slate-800 group-hover:text-green-600 transition">Surat Keluar</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola data surat yang dikirim keluar</p>
                </div>
                <span class="text-slate-400 group-hover:text-green-600 text-lg font-bold">→</span>
            </a>

        </div>

        {{-- INFORMASI SISTEM --}}
        <div class="mt-6 rounded-xl bg-blue-50 p-4 border border-blue-100 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <span class="h-3 w-3 rounded-full bg-green-500 animate-pulse"></span>
                <div>
                    <h3 class="text-sm font-semibold text-blue-900">
                        Sistem Berjalan Normal & Stabil
                    </h3>
                    <p class="text-xs text-slate-600 mt-0.5">
                        Semua modul direktori arsip digital siap digunakan.
                    </p>
                </div>
            </div>
            <span class="text-xs font-medium text-blue-700 bg-blue-100 px-3 py-1 rounded-full">
                Laravel v12 & Tailwind CSS
            </span>
        </div>

    </div>


    {{-- FOOTER DASHBOARD --}}
    <div class="flex flex-wrap items-center justify-between gap-2 border-t border-slate-200 pt-5 text-xs text-slate-400">
        <p>SIM-Surat · Smart Office System</p>
        <p>{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>

</div>
@endsection