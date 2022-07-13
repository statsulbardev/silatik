<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'admin',
            'kabps_prov',
            'sekretaris',
            'kabps_kab',
            'kabag',
            'kasubag',
            'kf',
            'skf',
            'staf'
        ];

        for ($i = 0; $i < count($data); $i++) {
            Role::create(['name' => $data[$i]]);
        }
    }
}
