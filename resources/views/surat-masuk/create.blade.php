@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8">

        <div class="mb-6 pb-4 border-b border-slate-100">
            <h1 class="text-2xl font-bold text-slate-900">Tambah Surat Masuk</h1>
            <p class="text-sm text-slate-500 mt-1">
                Isi formulir di bawah ini dengan lengkap untuk menambahkan arsip surat baru
            </p>
        </div>

        {{-- Menampilkan pesan kesalahan validasi --}}
        @if ($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl">
                <p class="font-semibold text-red-700 mb-2">
                    Terdapat kesalahan pada formulir:
                </p>
                <ul class="list-disc pl-5 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('surat-masuk.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf

            {{-- Nomor Surat --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Nomor Surat
                </label>
                <input
                    type="text"
                    name="nomor_surat"
                    value="{{ old('nomor_surat') }}"
                    required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >
            </div>

            {{-- Tanggal Surat --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Tanggal Surat
                </label>
                <input
                    type="date"
                    name="tanggal"
                    value="{{ old('tanggal') }}"
                    required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >
            </div>

            {{-- Pengirim --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Pengirim
                </label>
                <input
                    type="text"
                    name="pengirim"
                    value="{{ old('pengirim') }}"
                    required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >
            </div>

            {{-- Perihal --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Perihal
                </label>
                <input
                    type="text"
                    name="perihal"
                    value="{{ old('perihal') }}"
                    required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >
            </div>

            {{-- Kategori Surat --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Kategori Surat
                </label>
                <select
                    name="category_id"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >
                    <option value="">-- Pilih Kategori Surat --</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Keterangan --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Keterangan
                </label>
                <textarea
                    name="keterangan"
                    rows="4"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >{{ old('keterangan') }}</textarea>
            </div>

            {{-- Upload Lampiran --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">
                    Lampiran Surat
                </label>
                <input
                    type="file"
                    name="lampiran"
                    accept=".pdf,.jpg,.jpeg,.png"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition"
                >
                <p class="text-xs text-slate-500 mt-2">
                    Format file: PDF, JPG, JPEG, PNG. Maksimal ukuran 2 MB.
                </p>
            </div>

            {{-- Tombol --}}
            <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
                <button
                    type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm shadow-lg shadow-blue-500/25 transition"
                >
                    Simpan Surat
                </button>

                <a
                    href="{{ route('surat-masuk.index') }}"
                    class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition"
                >
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection