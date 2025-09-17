<?php

namespace Database\Seeders;

use App\Models\Aspek;
use App\Models\Indikator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AspekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_aspek' => 'Aspek 1 - Layanan Administrasi Pemerintahan Berbasis Elektronik', 'bobot_aspek' => 27.50],
            ['id' => 2, 'nama_aspek' => 'Aspek 2 - Layanan Publik Berbasis Elektronik', 'bobot_aspek' => 18.00],
            ['id' => 3, 'nama_aspek' => 'Aspek 3 - Penerapan Manajemen SPBE', 'bobot_aspek' => 12.00],
            ['id' => 4, 'nama_aspek' => 'Aspek 4 - Pelaksanaan Audit TIK', 'bobot_aspek' => 4.50]
        ];

        DB::table('aspeks')->insert($data);
        // $aspek1 = Aspek::create([
        //     'nama_aspek' => 'Aspek 1',
        //     'bobot_aspek' => 0.5,
        // ]);

        // for ($i = 1; $i <= 10; $i++) {
        //     Indikator::create([
        //         'aspek_id' => $aspek1->id,
        //         'nama_indikator' => 'Indikator ' . $i,
        //         'bobot_indikator' => 0.05,
        //     ]);
        // }
    }
}
