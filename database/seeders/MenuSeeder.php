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
            'image_path' => 'https://res.cloudinary.com/dw0ib99sn/image/upload/v1731897761/myjhur2e24vaqtm5d5po.jpg',
            'price' => 800,
            'count' => 1,
            'body' => '- バンズはふんわりもちもちとして食べ応えあり
- パティはジューシーで旨みが感じられる
- チーズはコクがあり、パテとの相性が抜群
- 月見ソースは甘じょっぱく、旨味をプラス
- 目玉焼きは半熟で黄身がとろ〜り
- 全体としてバランスが良く、満足感のある味わい',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('menus')->insert([
            'user_id' => 1,
            'shop_name' => '松屋',
            'name' => 'キムチ牛丼',
            'image_path' => 'https://res.cloudinary.com/dw0ib99sn/image/upload/v1731897712/vvbzwtjjdv71s7qcxemi.jpg',
            'price' => 700,
            'count' => 2,
            'body' => '・ピリッとした辛みが食欲をそそる。
・キムチのシャキシャキとした食感と牛肉の旨味がよく合う。
・辛さはほどよく、辛いものが苦手な人でも楽しめる。
・ご飯との相性が抜群で、あっという間に食べ終えてしまう。
・後から辛さがじわじわとやってきて、じんわりと温まる。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('menus')->insert([
            'user_id' => 2,
            'shop_name' => 'バーガーキング',
            'name' => 'チーズハンバーガー',
            'image_path' => 'https://res.cloudinary.com/dw0ib99sn/image/upload/v1731897631/kandruyp3fkik6inkgvt.jpg',
            'price' => 800,
            'count' => 1,
            'body' => '・ パテはジューシーだが、肉質はやや固い。
・ チーズはとろけておらず、少しパサパサしている。
・ バンズは柔らかく、程よい甘みがある。
・ レタスとトマトは新鮮でシャキッとしている。
・ オニオンは薄切りでシャキシャキしているが、少し辛みがある。
・ ケチャップとマスタードのバランスがよく、全体的な味を引き立てている。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
