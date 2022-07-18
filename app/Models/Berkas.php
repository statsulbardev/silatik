<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';

    protected $table = 'berkas';

    protected $fillable = [
        'surat_id',
        'tautan'
    ];

    public $timestamps = false;

    public function relasiSurat()
    {
        return $this->hasOne(Surat::class, 'id', 'surat_id');
    }
}
