<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consumers')->insert([
            ['id' => 1, 'name' => 'ابراهيم اشرف', 'created_at' => '2025-06-07 05:42:54', 'updated_at' => '2025-06-07 05:42:54'],
            ['id' => 2, 'name' => 'ابراهيم خليل', 'created_at' => '2025-06-07 05:43:00', 'updated_at' => '2025-06-07 05:43:00'],
            ['id' => 3, 'name' => 'محمد السيد', 'created_at' => '2025-06-07 05:43:07', 'updated_at' => '2025-06-07 05:43:07'],
            ['id' => 4, 'name' => 'محمد السينديوني', 'created_at' => '2025-06-07 05:43:12', 'updated_at' => '2025-06-07 05:43:12'],
        ]);
    }
}
