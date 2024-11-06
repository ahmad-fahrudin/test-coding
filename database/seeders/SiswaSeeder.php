<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $siswa = [
            ['nama' => 'Andi', 'nis' => '1001', 'kelas_id' => 1],
            ['nama' => 'Bella', 'nis' => '1002', 'kelas_id' => 1],
            ['nama' => 'Dodi', 'nis' => '1003', 'kelas_id' => 2],
            ['nama' => 'Eka', 'nis' => '1004', 'kelas_id' => 2],
            ['nama' => 'Fahri', 'nis' => '1005', 'kelas_id' => 3],
        ];

        foreach ($siswa as $data) {
            Siswa::create($data);
        }
    }
}
