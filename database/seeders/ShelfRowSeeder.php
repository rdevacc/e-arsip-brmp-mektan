<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShelfRowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shelf_rows')->insert([
            [
                'id' => 1,
                'shelf_id' => '1',
                'name' => 'Baris Rak 1 - Rak 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'shelf_id' => '1',
                'name' => 'Baris Rak 2 - Rak 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'shelf_id' => '1',
                'name' => 'Baris Rak 3 - Rak 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'shelf_id' => '2',
                'name' => 'Baris Rak 1 - Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'shelf_id' => '2',
                'name' => 'Baris Rak 2 - Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'shelf_id' => '2',
                'name' => 'Baris Rak 3 - Rak 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
