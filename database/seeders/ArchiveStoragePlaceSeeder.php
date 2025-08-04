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
                'archive_storage_location_id' => '8',
                'name' => 'Lemari 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_storage_location_id' => '8',
                'name' => 'Lemari 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_storage_location_id' => '6',
                'name' => 'Lemari 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_storage_location_id' => '7',
                'name' => 'Lemari Kaca 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_storage_location_id' => '5',
                'name' => 'Lemari Kaca 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'archive_storage_location_id' => '7',
                'name' => 'Lemari Kaca 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'archive_storage_location_id' => '6',
                'name' => 'Rak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'archive_storage_location_id' => '7',
                'name' => 'Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'archive_storage_location_id' => '5',
                'name' => 'Lemari Peta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'archive_storage_location_id' => '9',
                'name' => 'Lainnya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
