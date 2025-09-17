<?php

namespace Database\Seeders;

use App\Models\Aplikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class AplikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aplikasi::create([
            'nama_aplikasi' => 'Jaga Kendari',
            'deskripsi' => 'aplikasi yang di
            gunakan oleh
            kementrian pupr untuk
            melakukan monitoring
            dana DAK',
            'kematangan' => 5,
            'predikat' => 'memuaskan'
        ]);

        Aplikasi::create([
            'nama_aplikasi' => 'Instagram',
            'deskripsi' => 'aplikasi yang di
            gunakan oleh
            kementrian pupr untuk
            melakukan monitoring
            dana DAK',
            'kematangan' => 5,
            'predikat' => 'memuaskan'
        ]);
        User::create([
            'username' => 'Admin',
            'fullname' => 'Admin',
            'role' => 'admin',
            'password' => bcrypt('123456'), // Pastikan di-hash!
        ]);
    }
}
