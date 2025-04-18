<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $randomDate = $faker->dateTimeBetween('-5 months', 'now')->format('Y-m-d');

        DB::table('archives')->insert([
            [
                'id' => 1,
                'user_id' =>  1,
                'work_unit_id' => 1,
                'work_group_id' => 1,
                'work_team_id' => 1,
                'work_team_classification_id' => 1,
                'archive_retention_id' => 3,
                'archive_type_id' => 1,
                'archive_development_level_id' => 1,
                'archive_media_id' => 1,
                'archive_condition_id' => 1,
                'archive_final_depreciation_action_id' => 3,
                'archive_security_classification_id' => 4,
                'archive_access_level_id' => 2,
                'archive_public_access_level_id' => 1,
                'archive_status_id' => 2,
                'archive_quantity_unit_id' => 2,
                'building_id' => 1,
                'cabinet_id' => 1,
                'shelf_id' => 1,
                'shelf_row_id' => 1,
                'box_id' => 1,
                'folder_id' => 1,
                // 'archive_regnumber' => 'Arsip/001',
                'archive_letter_origin_number' => 'B.47/KP.580/H.9/01/2025',
                'archive_description' => 'Uraian Arsip',
                'archive_lifespan' => '10 Tahun',
                'archive_number' => '1',
                'archive_input_date' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' =>  1,
                'work_unit_id' => 1,
                'work_group_id' => 1,
                'work_team_id' => 1,
                'work_team_classification_id' => 2,
                'archive_retention_id' => 3,
                'archive_type_id' => 1,
                'archive_development_level_id' => 1,
                'archive_media_id' => 1,
                'archive_condition_id' => 1,
                'archive_final_depreciation_action_id' => 3,
                'archive_security_classification_id' => 4,
                'archive_access_level_id' => 2,
                'archive_public_access_level_id' => 1,
                'archive_status_id' => 2,
                'archive_quantity_unit_id' => 2,
                'building_id' => 1,
                'cabinet_id' => 1,
                'shelf_id' => 1,
                'shelf_row_id' => 1,
                'box_id' => 1,
                'folder_id' => 2,
                // 'archive_regnumber' => 'Arsip/001',
                'archive_letter_origin_number' => 'B.47/KP.580/H.9/01/2025',
                'archive_description' => 'Uraian Arsip',
                'archive_lifespan' => '10 Tahun',
                'archive_number' => '1',
                'archive_input_date' => $randomDate,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
