<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            'user_id' => 1,
            'shop_name' => 'マクドナルド',
            'name' => '月見バーガー',
            'image' => '',
            'price' => 800,
            'count' => 0,
            'body' => 'うまかった',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('menus')->insert([
            'user_id' => 1,
            'shop_name' => '松屋',
            'name' => 'キムチ牛丼',
            'image' => '',
            'price' => 700,
            'count' => 0,
            'body' => 'うまかった',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('menus')->insert([
            'user_id' => 2,
            'shop_name' => 'バーガーキング',
            'name' => 'チーズハンバーガー',
            'image' => '',
            'price' => 800,
            'count' => 0,
            'body' => 'うまかった',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
