<?php

namespace Database\Seeders;

use App\Models\Berkas;
use App\Models\Pemeriksaan;
use App\Models\Surat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SuratTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surat')->truncate();
        DB::table('berkas')->truncate();

        $suratJson = File::get('database/data/suratmasuk.json');
        $suratJsonDecode = json_decode($suratJson);

        foreach($suratJsonDecode as $surat) {
            $tempSurat = Surat::create([
                'no_agenda'      => $surat->no_agenda,
                'tanggal_surat'  => Carbon::parse($surat->tanggal_surat, config('app.timezone')),
                'no_surat'       => $surat->no_surat,
                'pengirim'       => $surat->pengirim,
                'perihal'        => $surat->perihal,
                'tipe'           => $surat->tipe,
                'tk_keamanan'    => $surat->tk_keamanan,
                'pegawai_id'     => $surat->pegawai_id,
                'unit_kerja_id'  => $surat->unit_kerja_id,
                'unit_fungsi_id' => $surat->unit_fungsi_id
            ]);

            Berkas::create([
                'surat_id' => $tempSurat->id,
                'tautan'   => $surat->tautan
            ]);
        }

    }
}
