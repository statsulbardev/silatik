<?php

namespace App\Repositories;

use App\Models\Berkas;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use App\Traits\GoogleDriveTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RepositoriSurat
{
    use GoogleDriveTrait;

    public function store($data) : String
    {
        switch($data->tipe) {
            case 'sm':
                try {
                    DB::beginTransaction();

                    $path   = $this->uploadFileToDrive($data);
                    $surat  = $this->storeMail($data);
                    $berkas = $this->storeFile($path, $surat);

                    DB::commit();

                    $pesan = "Sukses - Informasi surat telah disimpan.";
                } catch(Exception $error) {
                    DB::rollBack();

                    is_null($path) ?: $this->deleteFile($path);

                    Log::alert($error->getMessage());

                    $pesan = "Gagal - Informasi surat gagal disimpan. Pesan error : " . $error->getMessage();
                }

                break;
            case 'sk':
                try {
                    DB::beginTransaction();

                    $path   = $this->uploadFileToDrive($data);
                    $surat  = $this->storeMail($data);
                    $berkas = $this->storeFile($path, $surat);
                    $this->storeCheck($surat, $berkas);

                    DB::commit();

                    $pesan = "Sukses - Informasi surat telah disimpan.";
                } catch(Exception $error) {
                    DB::rollBack();

                    is_null($path) ?: $this->deleteFile($path);

                    Log::alert($error->getMessage());

                    $pesan = "Gagal - Informasi surat gagal disimpan. Pesan error : " . $error->getMessage();
                }
                break;
        }

        return $pesan;
    }

    public function update($data) : String
    {
        switch($data->tipe) {
            case 'sm':
                try {
                    $path   = null;
                    $berkas = null;

                    DB::beginTransaction();

                    if (!is_null($data->file_surat)) {
                        $path   = $this->uploadFileToDrive($data);
                        $berkas = $this->storeFile($path, $data->surat);
                    }

                    $this->updateMail($data);
                    $this->storeCheck($data->surat, $berkas);

                    DB::commit();

                    $pesan = "Sukses - Informasi surat telah diperbaharui.";
                } catch(Exception $error) {
                    DB::rollBack();

                    is_null($path) ?: $this->deleteFile($path);

                    Log::alert($error->getMessage());

                    $pesan = "Gagal - Informasi surat gagal diperbaharui.";
                }

                break;
            case 'sk':
                break;
        }

        return $pesan;
    }

    private function uploadFileToDrive($val) : String
    {
        $path = !is_null($val->file_surat)
              ? $this->uploadFile($val->tipe == "sm" ? config('googleid.surat_masuk') : config('googleid.surat_keluar'), 'create', $val->file_surat)
              : null;

        return $path;
    }

    private function storeMail($val)
    {
        $surat = Surat::create([
            'no_agenda'      => $val->no_agenda,
            'tanggal_surat'  => Carbon::parse($val->tanggal_surat, Auth::user()->timezone),
            'no_surat'       => $val->no_surat,
            'pengirim'       => $val->pengirim_surat,
            'perihal'        => $val->perihal_surat,
            'tipe'           => $val->tipe,
            'tk_keamanan'    => $val->tk_keamanan,
            'pegawai_id'     => Auth::user()->id,
            'unit_kerja_id'  => Auth::user()->unit_kerja_id,
            'unit_fungsi_id' => Auth::user()->unit_fungsi_id
        ]);

        return $surat;
    }

    private function updateMail($val)
    {
        $val->surat->update([
            'no_agenda'      => $val->no_agenda,
            'tanggal_surat'  => Carbon::parse($val->tanggal_surat, Auth::user()->timezone),
            'no_surat'       => $val->no_surat,
            'pengirim'       => $val->pengirim_surat,
            'perihal'        => $val->perihal_surat,
            'tipe'           => $val->tipe,
            'tk_keamanan'    => $val->tk_keamanan,
            'pegawai_id'     => Auth::user()->id,
            'unit_kerja_id'  => Auth::user()->unit_kerja_id,
            'unit_fungsi_id' => Auth::user()->unit_fungsi_id
        ]);
    }

    private function storeFile($path, $val)
    {
        $berkas = is_null($path) ?: Berkas::create(['surat_id' => $val->id, 'tautan' => $path]);

        return $berkas;
    }

    private function storeCheck($surat, $berkas)
    {
        Pemeriksaan::create(['surat_id' => $surat->id, 'berkas_id' => $berkas->id]);
    }
}
