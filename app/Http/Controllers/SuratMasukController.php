<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomingLetter;
use Database\Seeders\IncomingLettersSeeders;

class SuratMasukController extends Controller
{
    public function index() {
        $suratMasuk = IncomingLetter::all();
        return view('surat-masuk.index', compact('suratMasuk'));
    }

    public function show($id) {
        $surat = IncomingLetter::findOrFail($id);
        return view('surat-masuk.show', compact('surat'));
    }
}