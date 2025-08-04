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
                'archive_shelf_row_id' => '2',
                'name' => 'Box 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_shelf_row_id' => '10',
                'name' => 'Boks H.9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_shelf_row_id' => '8',
                'name' => 'Boks H.11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
