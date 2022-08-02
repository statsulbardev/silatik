<?php

namespace Database\Seeders;

use App\Models\Disposisi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DisposisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('disposisi')->truncate();

        $disposisiJson = File::get('database/data/disposisi-tahap2.json');
        $disposisiJsonDecode = json_decode($disposisiJson);

        foreach($disposisiJsonDecode as $disposisi) {
            Disposisi::create([
                "surat_id"               => $disposisi->surat_id,
                "poin"                   => $disposisi->poin,
                "unit_kerja_penerima"    => $disposisi->unit_kerja_penerima,
                "unit_fungsi_koordinasi" => $disposisi->unit_fungsi_koordinasi,
                "kode_paraf"             => Str::random(10),
                "tanggal_buat"           => $disposisi->tanggal_buat,
                "tanggal_update"         => $disposisi->tanggal_buat
            ]);
        }
    }
}
