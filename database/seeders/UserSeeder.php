<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use App\Models\Petugas;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas = Kelas::create([
            'nama_kelas' => 'XII-RPL 2',
            'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak'
        ]);

        $spp = Spp::create([
            'tahun' => 2021,
            'nominal' => 3600000
        ]);

        $siswa = Siswa::create([
            'nisn' => '1234567891',
            'nis' => '23456789',
            'nama' => 'Arbhy Adityabrahma',
            'id_kelas' => $kelas->id_kelas,
            'alamat' => 'Jalan Junaedi No. 48',
            'no_telp' => '089648311485',
            'id_spp' => $spp->id_spp
        ]);

        $petugas = Petugas::create([
            'username' => 'arb002',
            'password' => 'arb123',
            'nama_petugas' => 'Arbhy Adityabrahma',
            'level' => 'admin'
        ]);

        User::create([
            'id_petugas' => $petugas->id_petugas,
            'username' => $petugas->username,
            'password' => Hash::make($petugas->password),
            'level' => $petugas->level
        ]);
        
        User::create([
            'nisn' => $siswa->nisn,
            'username' => $siswa->nis,
            'password' => Hash::make($siswa->nis),
            'level' => 'siswa'
        ]);
    }
}
