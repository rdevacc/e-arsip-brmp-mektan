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
            ArchiveTypeSeeder::class,
            ArchiveStatusSeeder::class,
            WorkUnitSeeder::class,
            WorkGroupSeeder::class,
            WorkTeamSeeder::class,
            WorkTeamClassificationSeeder::class,
            BuildingSeeder::class,
            CabinetSeeder::class,
            ShelfSeeder::class,
            ShelfRowSeeder::class,
            BoxSeeder::class,
            FolderSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ArchiveSeeder::class,
           ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
