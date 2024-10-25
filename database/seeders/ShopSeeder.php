<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
            'user_id' => 1,
            'name' => 'マクドナルド',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('shops')->insert([
            'user_id' => 1,
            'name' => '松屋',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('shops')->insert([
            'user_id' => 2,
            'name' => 'バーガーキング',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
