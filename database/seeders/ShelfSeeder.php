<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shelves')->insert([
            [
                'id' => 1,
                'cabinet_id' => '1',
                'name' => 'Rak Arsip 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'cabinet_id' => '1',
                'name' => 'Rak Arsip 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'cabinet_id' => '1',
                'name' => 'Rak Arsip 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
