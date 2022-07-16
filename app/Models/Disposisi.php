<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'disposisis';

    protected $fillable = [
        'surat_id',
        'poin',
        'penerima',
        'kode_paraf',
        'catatan'
    ];

    protected $casts = [
        'poin'     => 'array',
        'penerima' => 'array'
    ];

    public function relasiSurat()
    {
        return $this->hasOne(Surat::class, 'id', 'surat_id');
    }
}
