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
                'archive_box_id' => '1',
                'name' => 'Folder 1 - Box 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_box_id' => '2',
                'name' => 'Folder 2 - Box 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_box_id' => '3',
                'name' => 'Folder 3 - Box 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_box_id' => '4',
                'name' => 'Folder 4 - Box 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_box_id' => '5',
                'name' => 'Folder 5 - Box 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'archive_box_id' => '6',
                'name' => 'Folder 6 - Box 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
