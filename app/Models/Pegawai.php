<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Pegawai extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    const CREATED_AT = 'tanggal_buat';
    const UPDATED_AT = 'tanggal_update';

    protected $table = 'pegawais';

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'nip_bps',
        'nip_bkn',
        'aktif',
        'foto',
        'telegram_id',
        'unit_kerja_id',
        'unit_fungsi_id'
    ];

    protected $hidden = ['password'];

    public function relasiUnitKerja()
    {
        return $this->hasOne(UnitKerja::class);
    }
}
