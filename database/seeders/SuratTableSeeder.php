<?php

namespace Database\Seeders;

use App\Models\Surat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SuratTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Surat::create([
            'no_agenda'      => 1,
            'tanggal_surat'  => Carbon::now()->setTimezone('Asia/Makassar'),
            'no_surat'       => 'B-001/76562/S400/7/2022',
            'pengirim'       => 'Direktur Metodologi Sensus dan Survei',
            'perihal'        => 'Update DSBS Sakernas Agustus 2022',
            'tipe'           => 'sm',
            'tk_keamanan'    => 'R',
            'pegawai_id'     => 17,
            'tautan'         => '1B5OiUNJObZZCrx_AV2BP8rrsMnUeAf7O'
        ]);

        Surat::create([
            'no_agenda'      => 2,
            'tanggal_surat'  => Carbon::now()->setTimezone('Asia/Makassar'),
            'no_surat'       => 'B-002/76562/S300/7/2022',
            'pengirim'       => 'BPS Provinsi Sulawesi Barat',
            'perihal'        => 'Mekanisme Update Peta',
            'tipe'           => 'sk',
            'tk_keamanan'    => 'B',
            'pegawai_id'     => 60,
            'tautan'         => '1maLQK8gm2obU8EXK-KdjXa4ztMMFu7YB'
        ]);
    }
}
