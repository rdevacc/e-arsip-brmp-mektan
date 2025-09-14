<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_teams')->insert([
            [
                'id' => 1,
                'work_group_id' => 1,
                'name' => 'Tim Kerja Tata Usaha dan Rumah Tangga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'work_group_id' => 1,
                'name' => 'Tim Kerja Keuangan dan Barang Milik Negara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'work_group_id' => 1,
                'name' => 'Tim Kerja Pengelolaan Sumber Daya Manusia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'work_group_id' => 2,
                'name' => 'Tim Kerja Layanan Sertifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'work_group_id' => 2,
                'name' => 'Tim Kerja Layanan Pengujian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'work_group_id' => 3,
                'name' => 'Tim Kerja Program dan Evaluasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'work_group_id' => 3,
                'name' => 'Tim Kerja Perekayasaan Teknologi dan Modernisasi Pertanian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'work_group_id' => 3,
                'name' => 'Tim Kerja Pengelolaan Kerja Sama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'work_group_id' => 4,
                'name' => 'Tim Kerja Pendayagunaan Hasil Perakitan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'work_group_id' => 5,
                'name' => 'Ketua Tim Kerja Lainnya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
