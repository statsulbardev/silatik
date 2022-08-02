<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratBaca extends Model
{
    use HasFactory;

    protected $table = 'surat_baca';

    protected $fillable = [
        'surat_id',
        'pegawai_id'
    ];

    protected $casts = ['pegawai_id' => 'array'];

    public $timestamps = false;

    public function relasiSurat()
    {
        return $this->belongsTo(Surat::class, 'id', 'surat_id');
    }
}
