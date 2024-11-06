<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $guru = [
            ['nama' => 'Ahmad', 'nip' => '1234567890'],
            ['nama' => 'Budi', 'nip' => '2345678901'],
            ['nama' => 'Citra', 'nip' => '3456789012'],
        ];

        foreach ($guru as $data) {
            Guru::create($data);
        }
    }
}
