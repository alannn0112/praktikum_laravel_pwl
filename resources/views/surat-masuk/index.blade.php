@extends('layouts.app')

@section('title', 'Daftar Surat Masuk')

@section('content')
<div class="bg-slate-50 min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200/80 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Daftar Surat Masuk
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Kelola dan pantau seluruh arsip surat masuk dengan mudah
                </p>
            </div>

            @if(auth()->user()->name !== 'Pembaca SIM-Surat')
                <a href="{{ route('surat-masuk.create') }}"
                   class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm shadow transition duration-200">
                    + Tambah Surat
                </a>
            @endif
        </div>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pencarian dan Filter --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80">

            <form action="{{ route('surat-masuk.index') }}" method="GET"
                  class="grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- Pencarian --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">
                        Cari Surat
                    </label>

                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari nomor surat, pengirim, atau perihal..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white"
                    >
                </div>

                {{-- Filter kategori --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-2">
                        Filter Kategori
                    </label>

                    <select
                        name="category_id"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600"
                    >
                        <option value="">Semua Kategori</option>

                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="md:col-span-3 flex flex-wrap gap-3">
                    <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm">
                        Cari / Filter
                    </button>

                    <a href="{{ route('surat-masuk.index') }}"
                       class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Tabel Data --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">

                    <thead class="bg-slate-50 text-slate-400 font-semibold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3.5">No</th>
                            <th class="px-6 py-3.5">Nomor Surat</th>
                            <th class="px-6 py-3.5">Tanggal</th>
                            <th class="px-6 py-3.5">Pengirim</th>
                            <th class="px-6 py-3.5">Perihal</th>
                            <th class="px-6 py-3.5">Kategori</th>
                            <th class="px-6 py-3.5">Lampiran</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($suratMasuk as $index => $surat)
                            <tr class="hover:bg-slate-50/50 transition">

                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $suratMasuk->firstItem() + $index }}
                                </td>

                                <td class="px-6 py-4 font-medium text-slate-900">
                                    {{ $surat->nomor_surat }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $surat->tanggal }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $surat->pengirim }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $surat->perihal }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $surat->category->nama ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($surat->lampiran)
                                        <a href="{{ asset('storage/' . $surat->lampiran) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-blue-600 hover:underline font-medium">
                                            Lihat File
                                        </a>
                                    @else
                                        <span class="text-slate-400">Tidak ada</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">

                                    <a href="{{ route('surat-masuk.show', $surat->id) }}"
                                       class="text-blue-600 hover:underline font-medium">
                                        Detail
                                    </a>

                                    @if(auth()->user()->name !== 'Pembaca SIM-Surat')
                                        <a href="{{ route('surat-masuk.edit', $surat->id) }}"
                                           class="text-amber-600 hover:underline font-medium">
                                            Edit
                                        </a>

                                        <form action="{{ route('surat-masuk.destroy', $surat->id) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:underline font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                                    Belum ada data surat masuk.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-5 border-t border-slate-100">
                {{ $suratMasuk->links() }}
            </div>

        </div>

    </div>
</div>
@endsection