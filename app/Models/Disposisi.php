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
        'unit_fungsi_penerima',
        'kode_paraf',
        'catatan'
    ];

    protected $casts = [
        'poin'                 => 'array',
        'unit_kerja_penerima'  => 'array',
        'unit_fungsi_penerima' => 'array'
    ];

    public function relasiSurat()
    {
        return $this->belongsTo(Surat::class, 'id', 'surat_id');
    }
}
