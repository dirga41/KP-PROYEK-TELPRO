<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Membuat Akun untuk Database Marketing ---

        // Menggunakan koneksi 'mysql_marketing' secara eksplisit
        DB::connection('mysql_marketing')->table('users')->insert([
            'name' => 'Marketing User',
            'username' => 'marketinguser01',
            'password' => Hash::make('Marketing2025@'), // Ganti dengan password yang aman
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // --- Membuat Akun untuk Database Project ---

        // Menggunakan koneksi 'mysql_project' secara eksplisit
        DB::connection('mysql_project')->table('users')->insert([
            'name' => 'Project User',
            'username' => 'projectuser01',
            'password' => Hash::make('Project2025@'), // Ganti dengan password yang aman
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
