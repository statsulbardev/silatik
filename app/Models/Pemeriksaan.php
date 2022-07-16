<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'pemeriksaan';

    protected $fillable = [
        'surat_id',
        'berkas_surat_id',
        'cek_kepala',
        'catatan_kepala',
        'tgl_cek_kepala',
        'cek_kf',
        'catatan_kf',
        'tgl_cek_kf'
    ];

    public function relasiSurat()
    {
        return $this->hasOne(Surat::class, 'id', 'surat_id');
    }

    public function relasiBerkasSurat()
    {
        return $this->hasOne(BerkasSurat::class, 'id', 'berkas_surat_id');
    }
}
