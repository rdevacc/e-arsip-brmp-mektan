<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_teams')->insert([
            [
                'id' => 1,
                'work_group_id' => 1,
                'name' => 'Tim Kerja Tata Usaha dan Rumah Tangga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'work_group_id' => 1,
                'name' => 'Tim Kerja Keuangan dan Barang Milik Negara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'work_group_id' => 1,
                'name' => 'Tim Kerja Kepegawaian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'work_group_id' => 2,
                'name' => 'Tim Kerja Standardisasi Instrumen Mekanisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'work_group_id' => 2,
                'name' => 'Tim Kerja Pengujian Instrumen Mekanisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'work_group_id' => 3,
                'name' => 'Tim Kerja Program',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'work_group_id' => 3,
                'name' => 'Tim Kerja Evaluasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'work_group_id' => 4,
                'name' => 'Tim Kerja Pengelolaan Produk Instrumen Hasil Standardisasi Mekanisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'work_group_id' => 4,
                'name' => 'Tim Kerja Pengelolaan Penyebarluasan Hasil Standardisasi Mekanisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
