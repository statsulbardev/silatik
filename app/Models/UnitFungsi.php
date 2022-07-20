<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitFungsi extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'unit_fungsi';

    protected $fillable = ['parent', 'nama'];

    public function relasiUnitKerja()
    {
        return $this->belongsToMany(UnitKerja::class, 'kerja_fungsi', 'unit_fungsi_id', 'unit_kerja_id');
    }
}
