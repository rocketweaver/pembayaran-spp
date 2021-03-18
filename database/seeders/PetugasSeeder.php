<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Faker\Factory as Faker;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 10; $i++) { 
            DB::table('petugas')->insert([
                'username' => $faker->userName,
                'password' => Hash::make('password'),
                'nama_petugas' => $faker->name,
                'level' => $faker->randomElement(['admin' ,'petugas'])
            ]);
        }
    }
}
