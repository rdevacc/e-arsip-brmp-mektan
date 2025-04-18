<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('folders')->insert([
            [
                'id' => 1,
                'box_id' => '1',
                'name' => 'Folder 1 - Box 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'box_id' => '2',
                'name' => 'Folder 2 - Box 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'box_id' => '3',
                'name' => 'Folder 3 - Box 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'box_id' => '4',
                'name' => 'Folder 4 - Box 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'box_id' => '5',
                'name' => 'Folder 5 - Box 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'box_id' => '6',
                'name' => 'Folder 6 - Box 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
