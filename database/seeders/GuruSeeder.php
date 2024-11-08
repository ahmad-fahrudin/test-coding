<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $kelasIds = DB::table('kelas')->pluck('id'); // Mengambil semua ID kelas

        foreach ($kelasIds as $kelasId) {
            DB::table('gurus')->insert([
                'nama' => $faker->name,
                'nip' => $faker->unique()->numerify('##########'), // NIP 10 digit unik
                'kelas_id' => $kelasId,
            ]);
        }
    }
}
