<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ArchiveAccessLevelSeeder::class,
            ArchiveConditionSeeder::class,
            ArchiveDevelopmentLevelSeeder::class,
            ArchiveFinalDepreciationActionSeeder::class,
            ArchiveMediaSeeder::class,
            ArchivePublicAccessLevelSeeder::class,
            ArchiveQuantityUnitSeeder::class,
            ArchiveRetentionSeeder::class,
            ArchiveSecurityClassificationSeeder::class,
            PeriodSeeder::class,
            ArchiveTypeSeeder::class,
            ArchiveSubTypeSeeder::class,
            ArchiveStatusSeeder::class,
            WorkUnitSeeder::class,
            WorkGroupSeeder::class,
            WorkTeamSeeder::class,
            WorkTeamClassificationSeeder::class,
            ArchiveBuildingSeeder::class,
            ArchiveCabinetSeeder::class,
            ArchiveShelfSeeder::class,
            ArchiveShelfRowSeeder::class,
            ArchiveBoxSeeder::class,
            ArchiveFolderSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            // ArchiveSeeder::class,
           ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
