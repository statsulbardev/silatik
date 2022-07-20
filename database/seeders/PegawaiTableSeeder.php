<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->truncate();

        $json = File::get('database/data/user.json');
        $data = json_decode($json);

        foreach ($data as $user) {
            if ($user->nip_bps === '340056465') {
                $temp = Pegawai::create([
                    'nama'           => $user->nama,
                    'username'       => explode('@', $user->email)[0],
                    'email'          => $user->email,
                    'password'       => bcrypt('password76'),
                    'nip_bps'        => $user->nip_bps,
                    'nip_bkn'        => $user->nip_bkn,
                    'aktif'          => true,
                    'unit_kerja_id'  => $user->unit_kerja_id,
                    'unit_fungsi_id' => $user->unit_fungsi_id
                ]);

                $temp->assignRole([$user->role, 'admin']);
            } else {
                $temp = Pegawai::create([
                    'nama'           => $user->nama,
                    'username'       => explode('@', $user->email)[0],
                    'email'          => $user->email,
                    'password'       => bcrypt('password76'),
                    'nip_bps'        => $user->nip_bps,
                    'nip_bkn'        => $user->nip_bkn,
                    'aktif'          => true,
                    'unit_kerja_id'  => $user->unit_kerja_id,
                    'unit_fungsi_id' => $user->unit_fungsi_id
                ]);

                $temp->assignRole($user->role);
            }
        }
    }
}
