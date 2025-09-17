<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penilaian')->insert([
            'nama_indikator' => 'layanan satu',
            'bobot' => '8',
            'nilai' => '5',
            'keterangan' => 'optimal',
            'bukti' => '8'
        ]);
        DB::table('penilaian')->insert([
            'nama_indikator' => 'layanan dua',
            'bobot' => '8',
            'nilai' => '5',
            'keterangan' => 'optimal',
            'bukti' => '8'
        ]);
        DB::table('penilaian')->insert([
            'nama_indikator' => 'layanan tiga',
            'bobot' => '8',
            'nilai' => '5',
            'keterangan' => 'optimal',
            'bukti' => '8'
        ]);
    }
}
