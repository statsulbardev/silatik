<?php

namespace App\Traits;

use App\Models\Disposisi;
use App\Models\Berkas;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use App\Models\UnitFungsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait SuratTrait
{
    use GoogleDriveTrait;

    public function getChiefMails($tipe, $nama_routing)
    {
        $tempQuery = Surat::query();

        $tempDisposisi = Str::contains($nama_routing, "disposisi");
        $tempPeriksa   = Str::contains($nama_routing, "periksa");

        $user = Auth::user();

        // fungsi when digunakan untuk menggantikan if clause pada query
        // fungsi doesntHave digunakan untuk mencari baris yang tidak memiliki pasangan di tabel lain.
        // fungsi has digunakan untuk mencari baris yang memiliki pasangan di tabel lain.
        $tempQuery
            -> when($tipe === "sm", function($query) use ($tipe, $tempDisposisi, $user) {
                    $query
                        -> when($tempDisposisi === true, function($q) use ($tipe) {
                                return $q
                                    -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                                    -> with('relasiDisposisi:surat_id')
                                    -> doesntHave('relasiDisposisi')
                                    -> where('tipe', $tipe)
                                    -> latest('tanggal_buat');
                        })
                        -> when($tempDisposisi === false, function($q) use ($tipe, $user) {
                                return $q
                                    -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                                    -> with(['relasiDisposisi', 'relasiKonversiSurat'])
                                    -> whereHas('relasiDisposisi', function($qr) use ($user) {
                                        $qr->whereJsonContains('unit_kerja_penerima', (string) $user->unit_kerja_id);
                                    })
                                    -> orHas('relasiKonversiSurat')
                                    -> where('tipe', $tipe)
                                    -> latest('tanggal_buat');
                        });
               })
            -> when($tipe === "sk", function($query) use ($tipe, $tempPeriksa, $user) {
                    $query
                        -> when($tempPeriksa === true, function($q) use ($tipe, $user) {
                            return $q
                                -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'unit_fungsi_id', 'tanggal_buat')
                                -> whereHas('relasiPemeriksaan', function($qr) {
                                        $qr->where('cek_kepala', 'bp');
                                })
                                -> with('relasiPemeriksaan')
                                -> where('tipe', $tipe)
                                -> where('unit_kerja_id', $user->unit_kerja_id)
                                -> latest('tanggal_buat');
                        })
                        -> when($tempPeriksa === false, function($q) use ($tipe, $user) {
                            return $q
                                -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'unit_fungsi_id', 'tanggal_buat')
                                -> whereHas('relasiPemeriksaan', function($qr) {
                                        $qr->where('cek_kepala', '!=', 'bp');
                                })
                                -> with('relasiPemeriksaan')
                                -> where('tipe', $tipe)
                                -> where('unit_kerja_id', $user->unit_kerja_id)
                                -> latest('tanggal_buat');
                        });
            });

        $surat = $tempQuery->get();

        return $surat;
    }

    public function getSecretaryMails($tipe)
    {
        $user = Auth::user();

        return Surat::query()
                -> select('id', 'no_agenda', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                -> with(['relasiPegawai', 'relasiBerkas', 'relasiDisposisi'])
                -> where('tipe', $tipe)
                -> where('unit_kerja_id', $user->unit_kerja_id)
                -> latest('tanggal_buat')
                -> get();
    }

    public function getCoordinatorMails($tipe, $nama_routing)
    {
        $tempQuery = Surat::query();

        $tempDisposisi = Str::contains($nama_routing, "disposisi");
        $tempPeriksa   = Str::contains($nama_routing, "periksa");

        $user = Auth::user();

        // Untuk mengubah isi array dari int ke string contoh kodenya dibawah.
        // $val = array_map('strval', UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id')->toArray());
        // untuk dicari unit fungsi dibawahnya
        if ($user->relasiUnitKerja->kode === "7600")
            $unit_fungsi = UnitFungsi::where('parent', Auth::user()->relasiUnitFungsi->id)->pluck('id');

        $tempQuery
            -> when($tipe === "sm", function($query) use ($tempDisposisi, $user) {
                    $query
                        -> when($tempDisposisi === true, function($qr) use ($user) {
                                return $qr
                                    -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                                    -> whereHas('relasiDisposisi', function($q) use ($user) {
                                        $q
                                            -> whereJsonContains('unit_kerja_penerima', (string) $user->unit_kerja_id)
                                            -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $user->unit_fungsi_id])
                                            -> whereJsonDoesntContain('unit_fungsi_teknis', ['unit_koordinator' => $user->unit_fungsi_id]);
                                    })
                                    -> orWhereHas('relasiDisposisi', function($r) use ($user) {
                                        $r
                                            -> whereJsonContains('unit_kerja_penerima', (string) $user->unit_kerja_id)
                                            -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $user->unit_fungsi_id])
                                            -> whereNull('unit_fungsi_teknis');
                                    })
                                    -> with('relasiDisposisi')
                                    -> latest('tanggal_buat');
                        })
                        -> when($tempDisposisi === false, function($qr) use ($user) {
                                return $qr
                                    -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                                    -> whereHas('relasiDisposisi', function($qr) use ($user) {
                                            $qr
                                                -> whereJsonContains('unit_kerja_penerima', (string) $user->unit_kerja_id)
                                                -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $user->unit_fungsi_id])
                                                -> whereJsonContains('unit_fungsi_teknis', ['unit_koordinator' => $user->unit_fungsi_id]);
                                    })
                                    -> with('relasiDisposisi')
                                    -> latest('tanggal_surat');
                        });
            })
            -> when($tipe === "sk", function($query) use ($tipe, $tempPeriksa, $unit_fungsi) {
                    $query
                        -> when($tempPeriksa === true, function($q) use ($tipe, $unit_fungsi) {
                            return $q
                                -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'unit_fungsi_id')
                                -> whereHas('relasiPemeriksaan', function($qr) {
                                        $qr -> where('cek_kf', 'bp');
                                })
                                -> with('relasiPemeriksaan')
                                -> where('tipe', $tipe)
                                -> whereIn('unit_fungsi_id', $unit_fungsi)
                                -> latest('tanggal_surat'); })
                        -> when($tempPeriksa === false, function($q) use ($unit_fungsi) {
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

        return $surat;
    }

    public function getSubCoordinatorMails($tipe, $nama_routing)
    {
        $tempQuery = Surat::query();

        $tempNamaRouting = Str::contains($nama_routing, "periksa");

        $user = Auth::user();

        // Cek dari fungsi umum
        if ($user->relasiUnitFungsi->nama === 'Fungsi Umum') {
            $tempQuery
                -> when($tipe === "sm", function($query) use ($user) {
                    return $query
                            -> select('id', 'no_agenda', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                            -> with(['relasiPegawai', 'relasiBerkas', 'relasiDisposisi'])
                            -> whereHas('relasiDisposisi', function($qr) use ($user) {
                                $qr
                                    -> whereJsonContains('unit_fungsi_teknis', ['unit_penerima' => (string) $user->unit_fungsi_id]);
                            })
                            -> orWhere('pegawai_id', $user->id)
                            // -> orWhere('unit_fungsi_id', $user->unit_fungsi_id)
                            -> where('tipe', "sm")
                            -> latest('tanggal_buat');
                });
        } else {
            $tempQuery
                -> when($tipe === "sm", function($query) use ($user) {
                    return $query
                            -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                            -> with(['relasiPegawai', 'relasiBerkas', 'relasiDisposisi'])
                            -> whereHas('relasiDisposisi', function($qr) use ($user) {
                                    $qr
                                        -> whereJsonContains('unit_fungsi_teknis', ['unit_penerima' => (string) $user->unit_fungsi_id]);
                            })
                            -> where('tipe', "sm")
                            -> latest('tanggal_buat');
                })
                -> when($tipe === "sk", function($query) {

                });
        }

        $surat = $tempQuery->get();

        return $surat;
    }

    public function getStafMails($tipe)
    {
        $tempQuery = Surat::query();

        $user = Auth::user();

        // Cek Jika Dari Fungsi Umum
        if ($user->relasiUnitFungsi->nama === 'Fungsi Umum') {
            $tempQuery
                -> when($tipe === 'sm', function($query) use ($user) {
                    return $query
                        -> select('id', 'no_agenda', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                        -> with(['relasiPegawai', 'relasiBerkas', 'relasiDisposisi'])
                        -> whereHas('relasiDisposisi', function($qr) use ($user) {
                            $qr
                                -> whereJsonContains('unit_fungsi_teknis', ['unit_penerima' => (string) $user->unit_fungsi_id]);
                        })
                        -> orWhere('pegawai_id', $user->id)
                        -> where('tipe', 'sm')
                        -> latest('tanggal_buat');
                });
        } else {
            $tempQuery
                -> when($tipe === 'sm', function($query) use ($user) {
                        return $query
                            -> select('id', 'no_surat', 'tanggal_surat', 'perihal', 'pengirim', 'tanggal_buat')
                            -> with(['relasiPegawai', 'relasiBerkas', 'relasiDisposisi'])
                            -> whereHas('relasiDisposisi', function($qr) use ($user) {
                                    $qr
                                        -> whereJsonContains('unit_fungsi_teknis', ['unit_penerima' => (string) $user->unit_fungsi_id]);
                            })
                            -> where('tipe', 'sm')
                            -> latest('tanggal_buat');
                })
                -> when($tipe === 'sk', function($query) {

                });
        }

        $surat = $tempQuery->get();

        return $surat;
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
