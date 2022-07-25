<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonversiSurat extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'konversi_surat';

    protected $fillable = [
        'surat_id'
    ];

    public function relasiSurat()
    {
        return $this->belongsTo(Surat::class, 'id', 'surat_id');
    }
}
