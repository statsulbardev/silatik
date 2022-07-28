<?php

namespace App\Repositories;

use App\Models\Disposisi;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RepositoriDisposisi
{
    public function store($data) : String
    {
        try {
            DB::beginTransaction();

            Disposisi::create([
                'surat_id'                 => $data->surat->id,
                'poin'                     => $data->poin,
                'unit_kerja_penerima'      => ["1"],
                'unit_fungsi_koordinasi'   => $data->penerima,
                'tgl_disposisi_koordinasi' => Carbon::now(),
                'catatan_kepala'           => $data->catatan,
                'kode_paraf'               => Str::random(10)
            ]);

            DB::commit();

            $pesan = "Sukses - Surat telah di disposisi";

        } catch(Exception $error) {
            DB::rollBack();

            Log::alert($error);

            $pesan = "Gagal - Surat gagal di disposisi";
        }

        return $pesan;
    }

    public function update($data) : String
    {
        try {
            DB::beginTransaction();

            Disposisi::where('surat_id', $data->surat->id)->update([
                'unit_fungsi_teknis'   => $data->penerima,
                'tgl_disposisi_teknis' => Carbon::now(),
                'catatan_kf'           => $data->catatan
            ]);

            DB::commit();

            $pesan = "Sukses - Surat telah di disposisi";

        } catch(Exception $error) {
            DB::rollBack();

            Log::alert($error);

            $pesan = "Gagal - Surat gagal di disposisi";
        }

        return $pesan;
    }
}
