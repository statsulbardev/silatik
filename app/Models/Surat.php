<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $fillable = [
        'no_agenda',
        'tanggal_surat',
        'no_surat',
        'pengirim_surat',
        'perihal_surat',
        'tautan_surat',
        'tipe_surat',
        'usul_disposisi',
        'pegawai_id',
        'unit_kerja_id',
        'unit_fungsi_id'
    ];
}
