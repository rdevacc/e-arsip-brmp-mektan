<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_folders')->insert([
            [
                'id' => 1,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'archive_storage_location_id' => '1',
                'name' => 'Folder 10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
