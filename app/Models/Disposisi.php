<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'disposisi';

    protected $fillable = [
        'surat_id',
        'poin',
        'unit_kerja_penerima',
        'unit_fungsi_koordinasi',
        'tgl_disposisi_koordinasi',
        'catatan_kepala',
        'unit_fungsi_teknis',
        'tgl_disposisi_teknis',
        'catatan_kf',
        'kode_paraf',
    ];

    protected $casts = [
        'poin'                   => 'array',
        'unit_kerja_penerima'    => 'array',
        'unit_fungsi_koordinasi' => 'array',
        'unit_fungsi_teknis'     => 'array'
    ];

    public function relasiSurat()
    {
        return $this->belongsTo(Surat::class, 'id', 'surat_id');
    }
}
