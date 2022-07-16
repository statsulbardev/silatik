<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Seeder;

class UnitKerjaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['7600', 'BPS Provinsi Sulawesi Barat'],
            ['7601', 'BPS Kabupaten Majene'],
            ['7602', 'BPS Kabupaten Polewali Mandar'],
            ['7603', 'BPS Kabupaten Mamasa'],
            ['7604', 'BPS Kabupaten Mamuju'],
            ['7605', 'BPS Kabupaten Pasangkayu']
        ];

        for ($i = 0; $i < count($data); $i++) {
            UnitKerja::create([
                'kode' => $data[$i][0],
                'nama' => $data[$i][1]
            ]);
        }

    }
}
