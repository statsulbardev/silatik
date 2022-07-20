<?php

namespace App\Traits;

use App\Models\Berkas;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use App\Models\UnitFungsi;

trait SuratTrait
{
    use GoogleDriveTrait;

    public function getChiefMails($tipe)
    {
        if ($tipe === 'sm') {
            $surat = Surat::query()
                     -> with(['relasiPegawai', 'relasiBerkas', 'relasiPemeriksaan', 'relasiDisposisi'])
                     -> where('tipe', $tipe)
                     -> get();
        } else {
            $surat = Surat::query()
                     -> with([
                            'relasiPegawai',
                            'relasiBerkas',
                            'relasiPemeriksaan' => function($q) {
                                $q->where('cek_kepala', 'bp');
                            }
                     ])
                     -> where('tipe', $tipe)
                     -> get();
        }

        return $surat;
    }

    public function getSecretaryMails($tipe)
    {
        return Surat::query()
                -> with(['relasiPegawai', 'relasiBerkas', 'relasiPemeriksaan', 'relasiDisposisi'])
                -> where('tipe', $tipe)
                -> get();
    }

    public function getKfMails($tipe)
    {
        if ($tipe === 'sm') {
            $surat = Surat::query()
                     -> with([
                            'relasiPegawai',
                            'relasiBerkas',
                            'relasiDisposisi' => function($q) {
                                $q->where('');
                            }
                     ])
                     -> where('tipe', $tipe)
                     -> get();
        } else {
            $surat = Surat::query()
                     -> with([
                            'relasiBerkas',
                            'relasiPegawai' => function($q) {
                                $q->relasiUnitFungsi;
                            },
                            'relasiPemeriksaan' => function($q) {
                                $q->where('cek_kf', 'bp');
                            }
                     ])
                     -> where('tipe', $tipe)
                     -> get();
        }

        return $surat;
    }

    public function getStafMails($tipe)
    {
        return Surat::query()
            -> with(['relasiPegawai', 'relasiBerkas', 'relasiPemeriksaan', 'relasiDisposisi'])
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
