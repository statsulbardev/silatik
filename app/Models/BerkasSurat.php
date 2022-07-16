<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasSurat extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';

    protected $table = 'berkas_surats';

    protected $fillable = [
        'surat_id',
        'tautan',
        'status_periksa'
    ];

    public $timestamps = false;

    public function relasiSurat()
    {
        return $this->hasOne(Surat::class, 'id', 'surat_id');
    }
}
