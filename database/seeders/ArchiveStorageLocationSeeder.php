<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveStorageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        DB::table('archive_storage_locations')->insert([
            [
                'id' => 1,
                'archive_building_id' => '1',
                'name' => 'Lemari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_building_id' => '1',
                'name' => 'Rak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_building_id' => '1',
                'name' => 'Kardex',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_building_id' => '1',
                'name' => 'Lemari Kaca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_building_id' => '1',
                'name' => 'Dll',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
