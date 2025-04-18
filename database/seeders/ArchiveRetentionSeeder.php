<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArchiveRetentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $randomDate = $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d');

        DB::table('archive_retentions')->insert([
            [
                'id' => 1,
                'range' => 1,
                // 'retention_desc' => 'Tahun',
                // 'a_retentionED' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'range' => 2,
                // 'retention_desc' => 'Tahun',
                // 'a_retentionED' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'range' => 3,
                // 'retention_desc' => 'Tahun',
                // 'a_retentionED' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'range' => 4,
                // 'retention_desc' => 'Tahun',
                // 'a_retentionED' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'range' => 5,
                // 'retention_desc' => 'Tahun',
                // 'a_retentionED' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
