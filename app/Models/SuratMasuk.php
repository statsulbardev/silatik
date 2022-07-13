<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuks';

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $fillable = [
        'tanggal_surat',
        'no_surat',
        'pengirim_surat',
        'perihal_surat',
        'tautan_surat',
        'no_agenda_sekretaris',
        'no_agenda_umum'
    ];
}
