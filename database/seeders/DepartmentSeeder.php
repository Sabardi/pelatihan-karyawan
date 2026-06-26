<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['nama_departemen' => 'Human Resources', 'deskripsi' => 'Departemen SDM dan HRD', 'created_at' => now(), 'updated_at' => now()],
            ['nama_departemen' => 'Teknologi Informasi', 'deskripsi' => 'Departemen IT dan Sistem Informasi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_departemen' => 'Engineering', 'deskripsi' => 'Departemen Teknik dan Pemeliharaan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
