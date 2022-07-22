<?php

namespace App\Traits;

use App\Models\Disposisi;
use App\Models\Berkas;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use App\Models\UnitFungsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait SuratTrait
{
    use GoogleDriveTrait;

    public function getChiefMails($tipe)
    {
        if ($tipe === "sm") {
            $surat = Surat::query()
                     -> with(['relasiPegawai', 'relasiBerkas'])
                     -> Where('tipe', $tipe)
                     -> get();
        } else {
            $surat = DB::table('pemeriksaan')
                     -> leftJoin('surat', 'pemeriksaan.surat_id', '=', 'surat.id')
                     -> where('surat.unit_kerja_id', Auth::user()->relasiUnitKerja->id)
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

    public function getKabagMails($tipe)
    {
        if ($tipe === 'sm') {
            $surat = DB::table('disposisi')
                        -> leftJoin('surat', 'disposisi.surat_id', '=', 'surat.id')
                        -> where('unit_kerja_penerima', (string) Auth::user()->relasiUnitKerja->id)
                        -> whereJsonContains('unit_fungsi_penerima', (string) Auth::user()->relasiUnitFungsi->id)
                        -> get();
        } else {
            if (Auth::user()->relasiUnitKerja->kode === "7600")
                // untuk dicari unit fungsi dibawahnya
                $unit_fungsi = UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id');

            $surat = Surat::query()
                     -> with([
                            'relasiBerkas',
                            'relasiPegawai',
                            'relasiPemeriksaan' => function($q) {
                                $q->where('cek_kf', 'bp');
                            }
                     ])
                     -> whereIn('unit_fungsi_id', $unit_fungsi)
                     -> where('tipe', $tipe)
                     -> get();
        }

        return $surat;
    }

    public function getKfMails($tipe)
    {
        if ($tipe === 'sm') {
            // $val = array_map('strval', UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id')->toArray());

            $surat = DB::table('disposisi')
                        -> leftJoin('surat', 'disposisi.surat_id', '=', 'surat.id')
                        -> where('unit_kerja_penerima', Auth::user()->relasiUnitKerja->id)
                        -> whereJsonContains('unit_fungsi_penerima', (string) Auth::user()->relasiUnitFungsi->id)
                        -> get();
        } else {
            // Cek jika KF adalah KF provinsi
            if (Auth::user()->relasiUnitKerja->kode === "7600")
                // untuk dicari unit fungsi dibawahnya
                $unit_fungsi = UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id');

            $surat = DB::table('pemeriksaan')
                     -> leftJoin('surat', 'pemeriksaan.surat_id', '=', 'surat.id')
                     -> whereIn('surat.unit_fungsi_id', $unit_fungsi)
                     -> get();
        }

        return $surat;
    }

    public function getStafMails($tipe)
    {
        return Surat::query()
            -> with(['relasiPegawai', 'relasiBerkas', 'relasiPemeriksaan', 'relasiDisposisi'])
            -> where('pegawai_id', Auth::user()->id)
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
