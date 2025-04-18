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
                'name' => 'Tata Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'work_unit_id' => 1,
                'name' => 'Kelompok Standardisasi dan Pengujian Instrumen Mekanisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'work_unit_id' => 1,
                'name' => 'Kelompok Program dan Evaluasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'work_unit_id' => 1,
                'name' => 'Kelompok Pengelelolaan Penyebarluasan Standar dan Produk Instrumen Mekanisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
