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
                'type_id' => 1,
                'name' => 'Vital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'type_id' => 1,
                'name' => 'Permanen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'type_id' => 1,
                'name' => 'Sejarah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'type_id' => 2,
                'name' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'type_id' => 2,
                'name' => 'Inaktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'type_id' => 2,
                'name' => 'Simpan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'type_id' => 2,
                'name' => 'Usul Musnah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
