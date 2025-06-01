<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveCabinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_cabinets')->insert([
            [
                'id' => 1,
                'archive_building_id' => '1',
                'name' => 'Lemari 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'archive_building_id' => '1',
                'name' => 'Lemari 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'archive_building_id' => '1',
                'name' => 'Lemari 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
