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
        'berkas_id',
        'unit_kerja_id',
        'unit_fungsi_id',
        'cek_kepala',
        'catatan_kepala',
        'tgl_cek_kepala',
        'cek_kf',
        'catatan_kf',
        'tgl_cek_kf'
    ];

    protected $casts = [
        'unit_kerja_id'  => 'array',
        'unit_fungsi_id' => 'array'
    ];

    public function relasiSurat()
    {
        return $this->belongsTo(Surat::class, 'id', 'surat_id');
    }

    public function relasiBerkas()
    {
        return $this->hasOne(Berkas::class, 'id', 'berkas_id');
    }
}
