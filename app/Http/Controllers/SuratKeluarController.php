<?php

namespace App\Http\Controllers;
use App\Models\OutcomingLetter;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = OutcomingLetter::all();

        return view('surat-keluar.index', compact('surat'));
    }

     public function show($id) {
         $surat = OutcomingLetter::findOrFail($id);
        return view('surat-keluar.show', compact('surat'));
    }
}