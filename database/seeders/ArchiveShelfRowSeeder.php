<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveShelfRowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_shelf_rows')->insert([
            [
                'id' => 1,
                'archive_shelf_id' => '1',
                'name' => 'Baris Rak 1 - Rak 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_shelf_id' => '1',
                'name' => 'Baris Rak 2 - Rak 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_shelf_id' => '1',
                'name' => 'Baris Rak 3 - Rak 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'archive_shelf_id' => '2',
                'name' => 'Baris Rak 1 - Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'archive_shelf_id' => '2',
                'name' => 'Baris Rak 2 - Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'archive_shelf_id' => '2',
                'name' => 'Baris Rak 3 - Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
