<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $kelasIds = DB::table('kelas')->pluck('id'); // Mengambil semua ID kelas

        foreach ($kelasIds as $kelasId) {
            for ($i = 0; $i < 100; $i++) {
                DB::table('siswas')->insert([
                    'nama' => $faker->name,
                    'nis' => $faker->unique()->numerify('##########'), // NIS 10 digit unik
                    'kelas_id' => $kelasId,
                ]);
            }
        }
    }
}
