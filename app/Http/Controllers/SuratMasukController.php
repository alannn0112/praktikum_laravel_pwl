<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomingLetter;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    // 1. Menampilkan daftar surat, pencarian, filter, dan pagination
    public function index(Request $request)
    {
        $query = IncomingLetter::with('category');

        // Pencarian surat
        if ($request->filled('q')) {
            $q = $request->input('q');

            $query->where(function ($builder) use ($q) {
                $builder->where('nomor_surat', 'like', "%{$q}%")
                    ->orWhere('pengirim', 'like', "%{$q}%")
                    ->orWhere('perihal', 'like', "%{$q}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $suratMasuk = $query->latest('id')
            ->paginate(5)
            ->withQueryString();

        $categories = Category::orderBy('nama')->get();

        return view('surat-masuk.index', compact('suratMasuk', 'categories'));
    }

    // 2. Menampilkan form tambah surat
    public function create()
    {
        $categories = Category::orderBy('nama')->get();

        return view('surat-masuk.create', compact('categories'));
    }

    // 3. Menyimpan surat baru beserta lampiran
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran-surat', 'public');
        }

        IncomingLetter::create($validated);

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Surat berhasil ditambahkan.');
    }

    // 4. Menampilkan detail surat
    public function show($id)
    {
        $surat = IncomingLetter::with('category')->findOrFail($id);

        return view('surat-masuk.show', compact('surat'));
    }

    // 5. Menampilkan form edit surat
    public function edit($id)
    {
        $surat = IncomingLetter::findOrFail($id);

        $categories = Category::orderBy('nama')->get();

        return view('surat-masuk.edit', compact('surat', 'categories'));
    }

    // 6. Memperbarui surat dan lampiran
    public function update(Request $request, $id)
    {
        $surat = IncomingLetter::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'pengirim' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $pathLama = $surat->lampiran;

            $validated['lampiran'] = $request->file('lampiran')
                ->store('lampiran-surat', 'public');

            $surat->update($validated);

            if ($pathLama) {
                Storage::disk('public')->delete($pathLama);
            }
        } else {
            unset($validated['lampiran']);

            $surat->update($validated);
        }

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    // 7. Menghapus surat beserta lampirannya
    public function destroy($id)
    {
        $surat = IncomingLetter::findOrFail($id);

        $path = $surat->lampiran;

        $surat->delete();

        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}