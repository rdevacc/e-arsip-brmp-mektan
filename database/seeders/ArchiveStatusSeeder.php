<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_statuses')->insert([
            [
                'id' => 1,
                'name' => 'Disimpan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Diserahkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Usul Musnah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Musnah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Permanen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
