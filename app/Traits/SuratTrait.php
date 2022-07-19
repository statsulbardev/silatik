<?php

namespace App\Traits;

use App\Http\Livewire\Main\Surat\DaftarPemeriksaan;
use App\Models\Berkas;
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
    use GoogleDriveTrait;

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

    public function deleteMail($id)
    {
        $berkas = Berkas::where('surat_id', (int) $id);

        foreach($berkas->get() as $file) {
            $this->deleteFile($file->tautan);
        }

        $berkas->delete();

        Pemeriksaan::where('surat_id', (int) $id)->delete();

        $respon = Surat::find((int) $id)->delete();

        return $respon;
    }
}
