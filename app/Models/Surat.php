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
        'pengirim',
        'perihal',
        'tipe',
        'tk_keamanan',
        'pegawai_id',
        'unit_kerja_id',
        'unit_fungsi_id'
    ];

    public function relasiPegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'pegawai_id');
    }

    public function relasiBerkas()
    {
        return $this->hasMany(Berkas::class, 'surat_id', 'id');
    }

    public function relasiPemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class, 'surat_id', 'id');
    }

    public function relasiDisposisi()
    {
        return $this->hasOne(Disposisi::class, 'surat_id', 'id');
    }

    public function relasiKonversiSurat()
    {
        return $this->hasOne(KonversiSurat::class, 'surat_id', 'id');
    }

    public function relasiSuratBaca()
    {
        return $this->hasOne(SuratBaca::class, 'surat_id', 'id');
    }
}
