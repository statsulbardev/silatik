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
        'cek_kepala',
        'catatan_kepala',
        'tgl_cek_kepala',
        'cek_kf',
        'catatan_kf',
        'tgl_cek_kf',
        'tautan',
        'parent'
    ];

    public function relasiPegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'pegawai_id');
    }

    public function relasiDisposisi()
    {
        return $this->hasOne(Disposisi::class, 'surat_id', 'id');
    }
}
