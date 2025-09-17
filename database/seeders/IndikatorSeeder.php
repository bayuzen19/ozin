<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 1 - Layanan Perencanaan', 'bobot_indikator' => 2.75],
            ['id' => 2, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 2 - Layanan Penganggaran', 'bobot_indikator' => 2.75],
            ['id' => 3, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 3 - Layanan Keuangan', 'bobot_indikator' => 2.75],
            ['id' => 4, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 4 - Layanan Pengadaan Barang dan Jasa', 'bobot_indikator' => 2.75],
            ['id' => 5, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 5 - Layanan Kepegawaian', 'bobot_indikator' => 2.75],
            ['id' => 6, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 6 - Layanan Kearsipan Dinamis', 'bobot_indikator' => 2.75],
            ['id' => 7, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 7 - Layanan Pengelolaan Barang Milik Negara', 'bobot_indikator' => 2.75],
            ['id' => 8, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 8 - Layanan Pengawasan Internal Pemerintah', 'bobot_indikator' => 2.75],
            ['id' => 9, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 9 - Layanan Akuntabilitas Kinerja Organisasi', 'bobot_indikator' => 2.75],
            ['id' => 10, 'aspek_id' => 1, 'nama_indikator' => 'Indikator 10 - Layanan Kinerja Pegawai', 'bobot_indikator' => 2.75],
            ['id' => 11, 'aspek_id' => 2, 'nama_indikator' => 'Indikator 11 - Layanan Pengaduan Pelayanan Publik', 'bobot_indikator' => 3.00],
            ['id' => 12, 'aspek_id' => 2, 'nama_indikator' => 'Indikator 12 - Layanan Data Terbuka', 'bobot_indikator' => 3.00],
            ['id' => 13, 'aspek_id' => 2, 'nama_indikator' => 'Indikator 13 - Layanan Jaringan Dokumentasi dan Informasi Hukum', 'bobot_indikator' => 3.00],
            ['id' => 14, 'aspek_id' => 2, 'nama_indikator' => 'Indikator 14 - Layanan Publik Sektor 1', 'bobot_indikator' => 3.00],
            ['id' => 15, 'aspek_id' => 2, 'nama_indikator' => 'Indikator 15 - Layanan Publik Sektor 2', 'bobot_indikator' => 3.00],
            ['id' => 16, 'aspek_id' => 2, 'nama_indikator' => 'Indikator 16 - Layanan Publik Sektor 3', 'bobot_indikator' => 3.00],
            ['id' => 17, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 17 - Penerapan Manajemen Risiko SPBE', 'bobot_indikator' => 1.50],
            ['id' => 18, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 18 - Penerapan Manajemen Keamanan Informasi SPBE', 'bobot_indikator' => 1.50],
            ['id' => 19, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 19 - Penerapan Manajemen Data', 'bobot_indikator' => 1.50],
            ['id' => 20, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 20 - Penerapan Manajemen Aset TIK', 'bobot_indikator' => 1.50],
            ['id' => 21, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 21 - Penerapan Kompetensi Sumber Daya Manusia', 'bobot_indikator' => 1.50],
            ['id' => 22, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 22 - Penerapan Manajemen Pengetahuan', 'bobot_indikator' => 1.50],
            ['id' => 23, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 23 - Penerapan Manajemen Perubahan', 'bobot_indikator' => 1.50],
            ['id' => 24, 'aspek_id' => 3, 'nama_indikator' => 'Indikator 24 - Penerapan Manajemen Layanan SPBE', 'bobot_indikator' => 1.50],
            ['id' => 25, 'aspek_id' => 4, 'nama_indikator' => 'Indikator 25 - Pelaksanaan Audit Infrastruktur SPBE', 'bobot_indikator' => 1.50],
            ['id' => 26, 'aspek_id' => 4, 'nama_indikator' => 'Indikator 26 - Pelaksanaan Audit Aplikasi SPBE', 'bobot_indikator' => 1.50],
            ['id' => 27, 'aspek_id' => 4, 'nama_indikator' => 'Indikator 27 - Pelaksanaan Audit Keamanan SPBE', 'bobot_indikator' => 1.50]

        ];

        DB::table('indikator')->insert($data);
        // DB::table('indikator')->insert([
        //     'nama_indikator' => 'layanan satu',
        //     'bobot_indikator' => '8'
        // ]);
        // DB::table('indikator')->insert([
        //     'nama_indikator' => 'layanan dua',
        //     'bobot' => '8'
        // ]);
        // DB::table('indikator')->insert([
        //     'nama_indikator' => 'layanan tiga',
        //     'bobot' => '8'
        // ]);
    }
}
