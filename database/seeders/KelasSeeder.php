<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkat = ['10', '11', '12'];
        $subkelas = ['A', 'B', 'C', 'D'];

        foreach ($tingkat as $t) {
            foreach ($subkelas as $s) {
                DB::table('kelas')->insert([
                    'nama_kelas' => $t . $s,
                    'deskripsi' => 'Kelas ' . $t . ' ' . $s,
                ]);
            }
        }
    }
}
