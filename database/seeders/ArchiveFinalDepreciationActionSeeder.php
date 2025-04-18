<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveFinalDepreciationActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_final_depreciation_actions')->insert([
            [
                'id' => 1,
                'name' => 'Pemindahan Arsip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Pemusnahan Arsip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Penyerahan Arsip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
