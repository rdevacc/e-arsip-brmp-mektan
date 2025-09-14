<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_groups')->insert([
            [
                'id' => 1,
                'work_unit_id' => 1,
                'name' => 'Bagian Tata Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'work_unit_id' => 1,
                'name' => 'Kelompok Layanan Pengujian dan Penilaian Kesesuaian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'work_unit_id' => 1,
                'name' => 'Kelompok Program dan Perekayasaan Teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'work_unit_id' => 1,
                'name' => 'Kelompok Kerja Sama dan Pendayagunaan Hasil Perakitan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'work_unit_id' => 1,
                'name' => 'Ketua kelompok Lainnya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
