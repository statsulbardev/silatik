<?php

namespace App\Traits;

use App\Models\Disposisi;
use App\Models\Berkas;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use App\Models\UnitFungsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait SuratTrait
{
    use GoogleDriveTrait;

    public function getChiefMails($tipe, $nama_routing)
    {
        $tempQuery = Surat::query();

        $tempDisposisi = Str::contains($nama_routing, "disposisi");
        $tempPeriksa   = Str::contains($nama_routing, "periksa");

        // fungsi when digunakan untuk menggantikan if clause pada query
        // fungsi doesntHave digunakan untuk mencari baris yang tidak memiliki pasangan di tabel lain.
        // fungsi has digunakan untuk mencari baris yang memiliki pasangan di tabel lain.
        $tempQuery
            -> when($tipe === "sm", function($query) use ($tipe, $tempDisposisi) {
                    $query
                        -> when($tempDisposisi === true, function($q) use ($tipe) {
                                return $q
                                    -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim')
                                    -> with('relasiDisposisi:surat_id')
                                    -> doesntHave('relasiDisposisi')
                                    -> where('tipe', $tipe)
                                    -> latest('tanggal_surat'); })
                        -> when($tempDisposisi === false, function($q) use ($tipe) {
                                return $q
                                    -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim')
                                    -> with('relasiDisposisi:surat_id')
                                    -> has('relasiDisposisi')
                                    -> where('tipe', $tipe)
                                    -> latest('tanggal_surat');
                        });
               })
            -> when($tipe === "sk", function($query) use ($tipe, $tempPeriksa) {
                    $query
                        -> when($tempPeriksa === true, function($q) use ($tipe) {
                            return $q
                                -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'unit_fungsi_id')
                                -> with(['relasiPemeriksaan' => function($a) {
                                       $a->where('cek_kepala', 'bp');
                                }])
                                -> where('tipe', $tipe)
                                -> where('unit_kerja_id', 1)
                                -> latest('tanggal_surat'); })
                    -> when($tempPeriksa === false, function($q) {});
            });

        $surat = $tempQuery->get();

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
                        -> whereJsonContains('unit_kerja_penerima', (string) Auth::user()->relasiUnitKerja->id)
                        -> whereJsonContains('unit_fungsi_penerima', (string) Auth::user()->relasiUnitFungsi->id)
                        -> get();
        } else {
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

    public function getKfMails($tipe, $nama_routing)
    {
        $tempQuery = Surat::query();

        $tempNamaRouting = Str::contains($nama_routing, "periksa");

        $user = Auth::user();

        // Untuk mengubah isi array dari int ke string contoh kodenya dibawah.
        // $val = array_map('strval', UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id')->toArray());
        // untuk dicari unit fungsi dibawahnya
        if ($user->relasiUnitKerja->kode === "7600")
            $unit_fungsi = UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id');

        $tempQuery
            -> when($tipe === "sm", function($query) use ($user) {
                    return $query
                            -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim')
                            -> whereHas('relasiDisposisi', function($qr) use ($user) {
                                    $qr
                                        -> whereJsonContains('unit_kerja_penerima', (string) $user->relasiUnitKerja->id)
                                        -> whereJsonContains('unit_fungsi_penerima', (string) $user->relasiUnitFungsi->id);
                            })
                            -> with('relasiDisposisi')
                            -> latest('tanggal_surat'); })
            -> when($tipe === "sk", function($query) use ($tipe, $tempNamaRouting, $unit_fungsi) {
                    $query
                        -> when($tempNamaRouting === true, function($q) use ($tipe, $unit_fungsi) {
                            return $q
                                -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'unit_fungsi_id')
                                -> whereHas('relasiPemeriksaan', function($qr) {
                                        $qr -> where('cek_kf', 'bp');
                                })
                                -> with('relasiPemeriksaan')
                                -> where('tipe', $tipe)
                                -> whereIn('unit_fungsi_id', $unit_fungsi)
                                -> latest('tanggal_surat'); })
                        -> when($tempNamaRouting === false, function($q) use ($unit_fungsi) {
                            return $q
                                -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'unit_fungsi_id')
                                -> whereHas('relasiPemeriksaan', function($qr) {
                                        $qr -> where('cek_kf', '!=', 'bp');
                                })
                                -> with('relasiPemeriksaan')
                                -> where('tipe', 'sk')
                                -> whereIn('unit_fungsi_id', $unit_fungsi)
                                -> latest('tanggal_surat');
                        });
            });

        $surat = $tempQuery->get();

        // dd($surat);

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
