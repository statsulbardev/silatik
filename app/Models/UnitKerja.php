<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'unit_kerja';

    protected $fillable = [ 'kode', 'nama'];

    public function relasiUnitFungsi()
    {
        return $this->belongsToMany(UnitFungsi::class, 'kerja_fungsi', 'unit_kerja_id', 'unit_fungsi_id');
    }
}
