<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_units')->insert([
            [
                'id' => 1,
                'name' => 'BRMP Mektan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
