<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveStoragePlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        DB::table('archive_storage_places')->insert([
            [
                'id' => 1,
                'archive_storage_location_id' => '1',
                'name' => 'Lemari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_storage_location_id' => '1',
                'name' => 'Rak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_storage_location_id' => '1',
                'name' => 'Kardex',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_storage_location_id' => '1',
                'name' => 'Lemari Kaca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_storage_location_id' => '5',
                'name' => 'Lemari Kaca 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'archive_storage_location_id' => '5',
                'name' => 'Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
