<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boxes')->insert([
            [
                'id' => 1,
                'shelf_row_id' => '1',
                'name' => 'Box 1 - Baris 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'shelf_row_id' => '1',
                'name' => 'Box 2 - Baris 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'shelf_row_id' => '1',
                'name' => 'Box 3 - Baris 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'shelf_row_id' => '2',
                'name' => 'Box 4 - Baris 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'shelf_row_id' => '2',
                'name' => 'Box 5 - Baris 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'shelf_row_id' => '2',
                'name' => 'Box 6 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'shelf_row_id' => '3',
                'name' => 'Box 7 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'shelf_row_id' => '3',
                'name' => 'Box 8 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'shelf_row_id' => '3',
                'name' => 'Box 9 - Baris 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
