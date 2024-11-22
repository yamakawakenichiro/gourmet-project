<?php

namespace Tests\Feature\Menu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Models\Menu;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_store_successed(): void
    {
        // モックの設定 - Cloudinaryによる画像アップロードをシミュレーション
        $cloudinaryUploaderMock = Mockery::mock('alias:' . Cloudinary::class);
        $cloudinaryUploaderMock->shouldReceive('upload->getSecurePath')
            ->once()
            ->andReturn('http://example.com/uploaded-image.jpg');

        // テストユーザーの作成と認証
        $user = User::factory()->create();

        // テスト用のダミー画像ファイル作成
        $uploadedFile = \Illuminate\Http\UploadedFile::fake()->image('menu.jpg');

        // POSTリクエストの送信
        $response = $this->actingAs($user)->post(route('store'), [
            'menu' => [
                'shop_name' => 'Sample',
                'name' => 'Sample',
                'price' => 1500,
                'count' => 1,
                'image_path' => $uploadedFile, // ダミーファイルを送信
            ]
        ]);

        // ステータスコード 302（リダイレクト）を確認
        $response->assertStatus(302);

        // リダイレクト先の確認
        $response->assertRedirect(route('index'));

        // セッションのメッセージ確認
        $response->assertSessionHas('message', '投稿を作成しました');

        // データベースにメニューが保存されたことを確認
        $this->assertDatabaseHas('menus', [
            'shop_name' => 'Sample',
            'name' => 'Sample',
            'price' => 1500,
            'count' => 1,
            'user_id' => $user->id,
            'image_path' => 'http://example.com/uploaded-image.jpg',
        ]);

        // モックの期待を確認
        Mockery::close();
    }
}
