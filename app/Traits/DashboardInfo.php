<?php

namespace App\Traits;

use App\Models\Pegawai;
use App\Models\Surat;
use Carbon\Carbon;

trait DashboardInfo
{
    public function getTotalInboxMails(string $roleName, Pegawai $pegawai) : int
    {
        switch($roleName)
        {
            case 'kabps' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> where('unit_kerja_id', 1)
                            -> count();
            case 'sekretaris' :
                break;
            case 'kabag' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> with('relasiDisposisi')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query->whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id]);
                            })
                            -> count();
            case 'kf' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> with('relasiDisposisi:surat_id')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query->whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id]);
                            })
                            -> count();
        }
    }

    public function getCurrentMonthInboxMails(string $roleName, Pegawai $pegawai) : int
    {
        switch($roleName)
        {
            case 'kabps' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> where('unit_kerja_id', 1)
                            -> whereMonth('tanggal_buat', Carbon::now()->month)
                            -> count();
            case 'kabag' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> whereMonth('tanggal_buat', Carbon::now()->month)
                            -> with('relasiDisposisi:surat_id')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query->whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id]);
                            })
                            -> count();
            case 'kf' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            ->whereMonth('tanggal_buat', Carbon::now()->month)
                            -> with('relasiDisposisi:surat_id')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query->whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id]);
                            })
                            -> count();
        }
    }

    public function getDisposition(string $roleName, Pegawai $pegawai) : int
    {
        switch($roleName)
        {
            case 'kabps' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> where('unit_kerja_id', 1)
                            -> with('relasiDisposisi:surat_id')
                            -> doesntHave('relasiDisposisi')
                            -> count();
            case 'kabag' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> with('relasiDisposisi')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query
                                    -> whereJsonContains('unit_kerja_penerima', (string) $pegawai->unit_kerja_id)
                                    -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id])
                                    -> whereJsonDoesntContain('unit_fungsi_teknis', ['unit_koordinator' => $pegawai->unit_fungsi_id]);
                            })
                            -> orWhereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query
                                    -> whereJsonContains('unit_kerja_penerima', (string) $pegawai->unit_kerja_id)
                                    -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id])
                                    -> whereNull('unit_fungsi_teknis');
                            })
                            -> count();
            case 'kf' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> with('relasiDisposisi')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query
                                    -> whereJsonContains('unit_kerja_penerima', (string) $pegawai->unit_kerja_id)
                                    -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id])
                                    -> whereJsonDoesntContain('unit_fungsi_teknis', ['unit_koordinator' => $pegawai->unit_fungsi_id]);
                            })
                            -> orWhereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query
                                    -> whereJsonContains('unit_kerja_penerima', (string) $pegawai->unit_kerja_id)
                                    -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id])
                                    -> whereNull('unit_fungsi_teknis');
                            })
                            -> count();
        }
    }

    public function getDoneDisposition(string $roleName, Pegawai $pegawai) : int
    {
        switch($roleName)
        {
            case 'kabps' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> where('unit_kerja_id', 1)
                            -> with('relasiDisposisi:surat_id')
                            -> has('relasiDisposisi')
                            -> count();
            case 'kabag' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> with('relasiDisposisi')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query
                                -> whereJsonContains('unit_kerja_penerima', (string) $pegawai->unit_kerja_id)
                                -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id])
                                -> whereJsonContains('unit_fungsi_teknis', ['unit_koordinator' => $pegawai->unit_fungsi_id]);
                            })
                            -> count();
            case 'kf' :
                return Surat::query()
                            -> where('tipe', 'sm')
                            -> where('tipe', 'sm')
                            -> with('relasiDisposisi')
                            -> whereHas('relasiDisposisi', function($query) use ($pegawai) {
                                $query
                                -> whereJsonContains('unit_kerja_penerima', (string) $pegawai->unit_kerja_id)
                                -> whereJsonContains('unit_fungsi_koordinasi', ['unit' => (string) $pegawai->unit_fungsi_id])
                                -> whereJsonContains('unit_fungsi_teknis', ['unit_koordinator' => $pegawai->unit_fungsi_id]);
                            })
                            -> count();
        }
    }
}
