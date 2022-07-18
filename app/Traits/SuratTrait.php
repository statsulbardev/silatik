<?php

namespace App\Traits;

use App\Http\Livewire\Main\Surat\DaftarPemeriksaan;
use App\Models\BerkasSurat;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait SuratTrait
{
    

    public function update($data)
    {
        try {
            DB::beginTransaction();

            $data->surat->update([

            ]);

            DB::commit();

            $message = '';

        } catch(Exception $error) {
            DB::rollBack();

            $message = '';
        }

        return $message;
    }

    public function getSecretaryMails($tipe)
    {
        return Surat::query()
            -> with(['relasiPegawai', 'relasiBerkas', 'relasiPemeriksaan', 'relasiDisposisi'])
            -> where('tipe', $tipe)
            -> get();
    }

    public function getChiefMails($tipe)
    {
        return Surat::query()
            -> with(['relasiPegawai', 'relasiBerkas', 'relasiPemeriksaan' => function($q) {
                    $q->where('cek_kepala', 'bp');
            }, 'relasiDisposisi'])
            -> where('tipe', $tipe)
            -> get();
    }
}
