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
            'tanggal_surat'  => Carbon::now(),
            'no_surat'       => 'B-001/76562/S400/7/2022',
            'pengirim_surat' => 'Direktur Metodologi Sensus dan Survei',
            'perihal_surat'  => 'Update DSBS Sakernas Agustus 2022',
            'tautan_surat'   => '1B5OiUNJObZZCrx_AV2BP8rrsMnUeAf7O',
            'tipe_surat'     => 'masuk',
            'pegawai_id'     => 17,
            'unit_kerja_id'  => 1,
            'unit_fungsi_id' => 11
        ]);

        Surat::create([
            'no_agenda'      => 2,
            'tanggal_surat'  => Carbon::now(),
            'no_surat'       => 'B-002/76562/S300/7/2022',
            'pengirim_surat' => 'BPS Provinsi Sulawesi Barat',
            'perihal_surat'  => 'Mekanisme Update Peta',
            'tautan_surat'   => '1maLQK8gm2obU8EXK-KdjXa4ztMMFu7YB',
            'tipe_surat'     => 'keluar',
            'pegawai_id'     => 60,
            'unit_kerja_id'  => 1,
            'unit_fungsi_id' => 26
        ]);
    }
}
