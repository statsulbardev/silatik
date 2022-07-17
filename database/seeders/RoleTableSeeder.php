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
            'kabps',
            'sekretaris',
            'kabag',
            'kf',
            'skf',
            'staf'
        ];

        for ($i = 0; $i < count($data); $i++) {
            Role::create(['name' => $data[$i]]);
        }
    }
}
