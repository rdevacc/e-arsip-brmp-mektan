<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_boxes')->insert([
            [
                'id' => 1,
                'archive_shelf_row_id' => '1',
                'name' => 'Box 1 - Baris 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_shelf_row_id' => '1',
                'name' => 'Box 2 - Baris 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_shelf_row_id' => '1',
                'name' => 'Box 3 - Baris 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_shelf_row_id' => '2',
                'name' => 'Box 4 - Baris 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_shelf_row_id' => '2',
                'name' => 'Box 5 - Baris 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'archive_shelf_row_id' => '2',
                'name' => 'Box 6 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'archive_shelf_row_id' => '3',
                'name' => 'Box 7 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'archive_shelf_row_id' => '3',
                'name' => 'Box 8 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'archive_shelf_row_id' => '3',
                'name' => 'Box 9 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
