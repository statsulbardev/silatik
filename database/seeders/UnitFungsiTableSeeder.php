<?php

namespace Database\Seeders;

use App\Models\UnitFungsi;
use Illuminate\Database\Seeder;

class UnitFungsiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [0, 'Kepala BPS Provinsi'],
            [1, 'Bagian Umum'],
            [1, 'Fungsi Statistik Sosial'],
            [1, 'Fungsi Statistik Produksi'],
            [1, 'Fungsi Statistik Distribusi'],
            [1, 'Fungsi Neraca Wilayah dan Analisis Statistik'],
            [1, 'Fungsi Integrasi Pengolahan dan Diseminasi Statistik'],
            [2, 'Fungsi Keuangan'],
            [2, 'Fungsi SDM dan Hukum'],
            [2, 'Fungsi Perencana'],
            [2, 'Fungsi Umum'],
            [2, 'Fungsi Pengadaan Barang Jasa'],
            [3, 'Fungsi Statistik Kependudukan dan Ketenagakerjaan'],
            [3, 'Fungsi Statistik Kesejahteraan Rakyat'],
            [3, 'Fungsi Statistik Ketahanan Sosial'],
            [4, 'Fungsi Statistik Pertanian'],
            [4, 'Fungsi Statistik Industri'],
            [4, 'Fungsi Statistik Pertambangan, Energi dan Konstruksi'],
            [5, 'Fungsi Statistik Harga Konsumen dan Harga Perdagangan Besar'],
            [5, 'Fungsi Statistik Keuangan Dan Harga Produsen'],
            [5, 'Fungsi Statistik Niaga dan Jasa'],
            [6, 'Fungsi Neraca Produksi'],
            [6, 'Fungsi Neraca Konsumsi'],
            [6, 'Fungsi Analisis Statistik Lintas Sektor'],
            [7, 'Fungsi Integrasi Pengolahan Data'],
            [7, 'Fungsi Jaringan dan Rujukan Statistik'],
            [7, 'Fungsi Diseminasi dan Layanan Statistik'],
            [1, 'Kepala BPS Kabupaten'],
            [28, 'Kasubag Umum'],
            [28, 'Fungsi Sosial'],
            [28, 'Fungsi Produksi'],
            [28, 'Fungsi Distribusi'],
            [28, 'Fungsi Nerwilis'],
            [28, 'Fungsi IPDS']
        ];

        for ($i = 0; $i < count($data); $i++) {
            UnitFungsi::create([
                'parent' => $data[$i][0],
                'nama_fungsi' => $data[$i][1]
            ]);
        }
    }
}
