<?php

namespace App\Repositories;

use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RepositoriPemeriksaan
{
    public function storeCheckMail($role, $data) : String
    {
        try {
            DB::beginTransaction();

            switch($role) {
                case 'kabps' :
                    Pemeriksaan::where('surat_id', $data->surat->id)->update([
                        'cek_kepala'     => $data->poin,
                        'catatan_kepala' => $data->catatan,
                        'tgl_cek_kepala' => Carbon::now()
                    ]);

                    break;
                case 'kf' :
                    Pemeriksaan::where('surat_id', $data->surat->id)->update([
                        'cek_kf'     => $data->poin,
                        'catatan_kf' => $data->catatan,
                        'tgl_cek_kf' => Carbon::now()
                    ]);

                    break;
            }

            DB::commit();

            $pesan = "Sukses - Informasi pemeriksaan surat telah disimpan.";
        } catch(Exception $error) {
            DB::rollBack();

            Log::alert($error->getMessage());

            $pesan = "Gagal - Informasi pemeriksaan surat gagal disimpan.";
        }

        return $pesan;
    }
}
