<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveBuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_buildings')->insert([
            [
                'id' => 1,
                'name' => 'Unit Kearsipan Ruang 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Unit Kearsipan Ruang 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Unit Kearsipan Ruang 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
