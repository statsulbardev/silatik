<?php

namespace App\Traits;

use App\Models\SuratBaca;
use Carbon\Carbon;

trait HasReadMails
{
    public function storeReaderInfo($userId, $suratId)
    {
        $cek_surat = SuratBaca::where('surat_id', $suratId);

        if ($cek_surat->get()->count() > 0) {
            // Cek jika user belum pernah membaca
            if ($cek_surat->whereJsonContains('pegawai_id', ['id' => $userId])->get()->count() == 0)
            {
                $surat_baca = SuratBaca::where('surat_id', $suratId);

                $tempData = $surat_baca->pluck('pegawai_id')->toArray();

                $user = [
                    'id'       => $userId,
                    'tgl_baca' => Carbon::now()
                ];

                array_push($tempData[0], $user);

                $surat_baca->update(['pegawai_id' => $tempData[0]]);
            }
        } else {
            SuratBaca::create([
                'surat_id'   => $suratId,
                'pegawai_id' => [
                    [
                        'id'       => $userId,
                        'tgl_baca' => Carbon::now()
                    ]
                ]
            ]);
        }
    }
}
