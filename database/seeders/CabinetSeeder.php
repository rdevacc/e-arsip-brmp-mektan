<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cabinets')->insert([
            [
                'id' => 1,
                'building_id' => '1',
                'name' => 'Lemari 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'building_id' => '1',
                'name' => 'Lemari 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'building_id' => '1',
                'name' => 'Lemari 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
