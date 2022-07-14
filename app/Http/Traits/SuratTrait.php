<?php

namespace App\Http\Traits;

use App\Models\Surat;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait SuratTrait
{
    use GoogleDriveTrait;

    public function store($data)
    {
        try {
            $path_surat = !is_null($data->file_surat)
                ? $this->uploadFile($data->tipe_surat === 'masuk' ? config('googleid.surat_masuk') : config('googleid.surat_keluar'), 'create', $data->file_surat)
                : null;

            DB::beginTransaction();

            Surat::create([
                'no_agenda'      => $data->no_agenda,
                'tanggal_surat'  => Carbon::parse($data->tanggal_surat, 'UTC'),
                'no_surat'       => $data->no_surat,
                'pengirim_surat' => $data->pengirim_surat,
                'perihal_surat' => $data->perihal_surat,
                'tautan_surat'     => $path_surat,
                'tipe_surat' => $data->tipe_surat,
                'pegawai_id' => Auth::user()->id,
                'unit_kerja_id' => Auth::user()->unit_kerja_id,
                'unit_fungsi_id' => Auth::user()->unit_fungsi_id
            ]);

            DB::commit();

            $message = "Sukses - Informasi surat " . $data->tipe_surat . ' ' . $data->no_surat . " telah disimpan.";

        } catch(Exception $error) {
            DB::rollBack();

            is_null($path_surat) ?: $this->deleteFile($path_surat);

            Log::alert($error->getMessage());

            $message = "Gagal - Informasi surat " . $data->tipe_surat . ' ' . $data->no_surat . " gagal disimpan. Pesan error : " . $error->getMessage();
        }

        return $message;
    }

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

    public function getAllData($tipe_routing_surat)
    {
        return Surat::where('tipe_surat', $tipe_routing_surat)->get();
    }
}
