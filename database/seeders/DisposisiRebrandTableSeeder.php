<?php

namespace Database\Seeders;

use App\Models\Disposisi;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DisposisiRebrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disposisi = Disposisi::get();

        foreach($disposisi as $item) {
            $tempData = [
                [
                    "unit"          => json_decode($item->unit_fungsi_penerima),
                    "catatan"       => $item->catatan,
                    "tgl_disposisi" => Carbon::parse($item->tanggal_buat)
                ]
            ];

            $item->update([
                'unit_fungsi_koordinasi' => $tempData
            ]);
        }
    }
}
