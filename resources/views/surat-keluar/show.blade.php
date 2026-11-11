@extends('layouts.app')

@section('title', 'Detail Surat Keluar')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Surat Keluar</h1>
            <p class="text-sm text-slate-500 mt-1">Informasi lengkap arsip surat keluar digital.</p>
        </div>
        <a href="{{ route('surat-keluar.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-medium rounded-lg transition duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-6 sm:p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border-b border-slate-100 pb-4">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Nomor Surat</span>
                    <span class="mt-1 text-base font-medium text-slate-800">{{ $surat->nomor_surat }}</span>
                </div>
                <div class="border-b border-slate-100 pb-4">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Tanggal Surat</span>
                    <span class="mt-1 text-base font-medium text-slate-800">{{ $surat->tanggal }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="border-b border-slate-100 pb-4">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Pengirim</span>
                    <span class="mt-1 text-base font-medium text-slate-800">{{ $surat->pengirim }}</span>
                </div>
                <div class="border-b border-slate-100 pb-4">
                    <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Perihal</span>
                    <span class="mt-1 text-base font-semibold text-blue-600">{{ $surat->perihal }}</span>
                </div>
            </div>

            <div>
                <span class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Keterangan</span>
                <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 text-slate-700 text-sm leading-relaxed">
                    {{ $surat->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection