<?php

namespace App\Repositories;

use App\Models\Disposisi;
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
                'surat_id'             => $data->surat->id,
                'poin'                 => $data->poin,
                'unit_kerja_penerima'  => 1,
                'unit_fungsi_penerima' => $data->penerima,
                'kode_paraf'           => Str::random(15),
                'catatan'              => $data->catatan
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
