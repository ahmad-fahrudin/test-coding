<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kelas = [
            ['nama_kelas' => 'Kelas 1A', 'deskripsi' => 'Kelas untuk siswa tingkat 1A'],
            ['nama_kelas' => 'Kelas 2B', 'deskripsi' => 'Kelas untuk siswa tingkat 2B'],
            ['nama_kelas' => 'Kelas 3C', 'deskripsi' => 'Kelas untuk siswa tingkat 3C'],
        ];

        foreach ($kelas as $data) {
            Kelas::create($data);
        }
    }
}
