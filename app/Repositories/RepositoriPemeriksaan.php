<?php

namespace App\Repositories;

use App\Models\Disposisi;
use App\Models\KonversiSurat;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RepositoriPemeriksaan
{
    public function storeCheckMail($role, $data) : String
    {
        try {
            DB::beginTransaction();

            switch($role) {
                case 'kabps' :
                    $temp = Pemeriksaan::where('surat_id', $data->surat->id);

                    $temp->update([
                        'cek_kepala'     => $data->poin,
                        'catatan_kepala' => $data->catatan,
                        'tgl_cek_kepala' => Carbon::now()
                    ]);

                    $unit = $temp->get(['unit_kerja_id', 'unit_fungsi_id', 'catatan_kepala']);

                    // Surat yang telah disetujui dimasukkan ke tabel disposisi
                    if ($data->poin === 'op') {
                        Disposisi::create([
                            'surat_id'             => $data->surat->id,
                            'poin'                 => [],
                            'unit_kerja_penerima'  => $unit[0]->unit_kerja_id,
                            'unit_fungsi_penerima' => $unit[0]->unit_fungsi_id,
                            'kode_paraf'           => Str::random(10),
                            'catatan'              => $unit[0]->catatan_kepala
                        ]);
                    }

                    KonversiSurat::create([
                        'surat_id' => $data->surat->id
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
