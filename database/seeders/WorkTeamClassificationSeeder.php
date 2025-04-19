<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTeamClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_team_classifications')->insert([
            [
                'id' => 1,
                'work_team_id' => 1,
                'name' => 'RTP-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'work_team_id' => 1,
                'name' => 'RTP-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'work_team_id' => 1,
                'name' => 'RTP-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'work_team_id' => 2,
                'name' => 'KEU-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'work_team_id' => 2,
                'name' => 'KEU-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'work_team_id' => 2,
                'name' => 'KEU-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'work_team_id' => 3,
                'name' => 'KPG-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'work_team_id' => 3,
                'name' => 'KPG-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'work_team_id' => 3,
                'name' => 'KPG-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'work_team_id' => 4,
                'name' => 'SMP-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'work_team_id' => 4,
                'name' => 'SMP-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'work_team_id' => 4,
                'name' => 'SMP-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'work_team_id' => 5,
                'name' => 'PMP-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'work_team_id' => 5,
                'name' => 'PMP-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'work_team_id' => 5,
                'name' => 'PMP-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'work_team_id' => 6,
                'name' => 'PRG-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'work_team_id' => 6,
                'name' => 'PRG-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'work_team_id' => 6,
                'name' => 'PRG-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'work_team_id' => 7,
                'name' => 'EVL-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'work_team_id' => 7,
                'name' => 'EVL-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 21,
                'work_team_id' => 7,
                'name' => 'EVL-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 22,
                'work_team_id' => 8,
                'name' => 'PHP-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 23,
                'work_team_id' => 8,
                'name' => 'PHP-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 24,
                'work_team_id' => 8,
                'name' => 'PHP-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 25,
                'work_team_id' => 9,
                'name' => 'KJS-001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 26,
                'work_team_id' => 9,
                'name' => 'KJS-002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 27,
                'work_team_id' => 9,
                'name' => 'KJS-003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 28,
                'work_team_id' => 1,
                'name' => 'KU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 29,
                'work_team_id' => 1,
                'name' => 'RC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 30,
                'work_team_id' => 1,
                'name' => 'KP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
