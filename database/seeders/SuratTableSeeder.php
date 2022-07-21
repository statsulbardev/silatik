<?php

namespace Database\Seeders;

use App\Models\Berkas;
use App\Models\Pemeriksaan;
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
        $surat1 = Surat::create([
            'no_agenda'      => 1,
            'tanggal_surat'  => Carbon::now()->setTimezone('Asia/Makassar'),
            'no_surat'       => 'B-001/76562/S400/7/2022',
            'pengirim'       => 'Direktur Metodologi Sensus dan Survei',
            'perihal'        => '<div>Update DSBS Sakernas Agustus 2022</div>',
            'tipe'           => 'sm',
            'tk_keamanan'    => 'R',
            'pegawai_id'     => 17,
            'unit_kerja_id'  => 1,
            'unit_fungsi_id' => 11
        ]);

        Berkas::create([
            'surat_id' => $surat1->id,
            'tautan'   => '1B5OiUNJObZZCrx_AV2BP8rrsMnUeAf7O'
        ]);

        $surat2 = Surat::create([
            'no_agenda'      => 2,
            'tanggal_surat'  => Carbon::now()->setTimezone('Asia/Makassar'),
            'no_surat'       => 'B-002/76562/S300/7/2022',
            'pengirim'       => 'BPS Provinsi Sulawesi Barat',
            'perihal'        => '<div>Mekanisme Update Peta</div>',
            'tipe'           => 'sk',
            'tk_keamanan'    => 'B',
            'pegawai_id'     => 60,
            'unit_kerja_id'  => 1,
            'unit_fungsi_id' => 26
        ]);

        $berkas2 = Berkas::create([
            'surat_id' => $surat2->id,
            'tautan'         => '1maLQK8gm2obU8EXK-KdjXa4ztMMFu7YB'
        ]);

        Pemeriksaan::create([
            'surat_id'      => $surat2->id,
            'berkas_id'     => $berkas2->id,
            'unit_kerja_id' => ["2", "3", "4", "5", "6"]
        ]);
    }
}
