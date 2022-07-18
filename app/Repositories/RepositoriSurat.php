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
        try {
            DB::beginTransaction();

            $path_surat = !is_null($data->file_surat)
                ? $this->uploadFile($data->tipe == "sm" ? config('googleid.surat_masuk') : config('googleid.surat_keluar'), 'create', $data->file_surat)
                : null;

            $surat = Surat::create([
                'no_agenda'      => $data->no_agenda,
                'tanggal_surat'  => Carbon::parse($data->tanggal_surat, Auth::user()->timezone),
                'no_surat'       => $data->no_surat,
                'pengirim'       => $data->pengirim_surat,
                'perihal'        => $data->perihal_surat,
                'tipe'           => $data->tipe,
                'tk_keamanan'    => $data->tk_keamanan,
                'pegawai_id'     => Auth::user()->id,
                'unit_kerja_id'  => Auth::user()->unit_kerja_id,
                'unit_fungsi_id' => Auth::user()->unit_fungsi_id
            ]);

            $berkas = Berkas::create([
                'surat_id' => $surat->id,
                'tautan'   => $path_surat,
            ]);

            Pemeriksaan::create([
                'surat_id'  => $surat->id,
                'berkas_id' => $berkas->id
            ]);

            DB::commit();

            $pesan = "Sukses - Informasi surat telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            is_null($path_surat) ?: $this->deleteFile($path_surat);

            Log::alert($error->getMessage());

            $pesan = "Gagal - Informasi surat gagal disimpan. Pesan error : " . $error->getMessage();
        }

        return $pesan;
    }

    // public function update($data) : String
    // {}
}
