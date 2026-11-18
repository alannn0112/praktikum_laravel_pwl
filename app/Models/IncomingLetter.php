<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomingLetter extends Model
{
    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'pengirim',
        'perihal',
        'keterangan',
        'category_id',
        'lampiran', // Tambahkan 'lampiran' di sini agar bisa disimpan (mass assignment)
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}