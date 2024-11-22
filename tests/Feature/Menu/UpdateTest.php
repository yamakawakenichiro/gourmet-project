<?php

namespace Tests\Feature\Menu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Models\Menu;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_update_successed(): void
    {
        // モックの設定 - Cloudinaryの画像操作をシミュレーション
        $cloudinaryMock = Mockery::mock('alias:' . Cloudinary::class);

        // 画像をアップロードする場合の設定
        $cloudinaryMock->shouldReceive('upload->getSecurePath')
            ->andReturn('http://example.com/updated-image.jpg');

        // テストユーザーとメニューの作成
        $user = User::factory()->create();
        $menu = Menu::factory()->for($user)->create([
            'shop_name' => 'Old shop name',
            'image_path' => 'http://example.com/old-image.jpg',
            'name' => 'Old Menu Item',
            'price' => 1000,
            'count' => 1,
        ]);

        // ダミー画像ファイルの作成
        $uploadedFile = \Illuminate\Http\UploadedFile::fake()->image('menu.jpg');

        // メニュー更新リクエストを送信
        $response = $this->actingAs($user)->put(route('update', $menu->id), [
            'menu' => [
                'shop_name' => 'Updated shop name',
                'name' => 'Updated Menu Item',
                'price' => 1500,
                'count' => 2,
                'image_path' => $uploadedFile, // 新しいファイルを送信
            ],
            'delete_image' => 'false', // 画像削除のフラグ
        ]);

        // ステータスコード 302（リダイレクト）を確認
        $response->assertStatus(302);

        // 正しいリダイレクト先の確認
        $response->assertRedirect(route('show', ['menu' => $menu->id]));

        // セッションのメッセージ確認
        $response->assertSessionHas('message', '投稿を更新しました');

        // データベース内のメニューが更新されたことを確認
        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'shop_name' => 'Updated shop name',
            'name' => 'Updated Menu Item',
            'price' => 1500,
            'count' => 2,
            'user_id' => $user->id,
            'image_path' => 'http://example.com/updated-image.jpg', // 画像が新しいURLに更新されていることを確認
        ]);

        // モックの行動を確認
        Mockery::close();
    }

    public function test_update_with_image_deletion_successed(): void
    {
        // モックの設定 - Cloudinaryの画像削除
        $cloudinaryMock = Mockery::mock('alias:' . Cloudinary::class);
        $cloudinaryMock->shouldReceive('destroy')->once()->andReturn(true);

        // テストユーザーとメニュー項目の作成
        $user = User::factory()->create();
        $menu = Menu::factory()->for($user)->create([
            'shop_name' => 'Old shop name',
            'image_path' => 'http://example.com/old-image.jpg',
            'name' => 'Old Menu Item',
            'price' => 1000,
            'count' => 1,
        ]);

        // リクエスト送信 (`delete_image` フラグが `true`)
        $response = $this->actingAs($user)->put(route('update', $menu->id), [
            'menu' => [
                'shop_name' => 'Updated shop name',
                'name' => 'Updated Menu Item',
                'price' => 1500,
                'count' => 2,
                // 画像を新しくアップロードしない
            ],
            'delete_image' => 'true', // 画像削除フラグ
        ]);

        // ステータスコード 302（リダイレクト）を確認
        $response->assertStatus(302);

        // 正しいリダイレクト先の確認
        $response->assertRedirect(route('show', ['menu' => $menu->id]));

        // セッションのメッセージ確認
        $response->assertSessionHas('message', '投稿を更新しました');

        // データベース内のメニューが更新されたことと、画像が削除されたことを確認
        $this->assertDatabaseHas('menus', [
            'id' => $menu->id,
            'shop_name' => 'Updated shop name',
            'name' => 'Updated Menu Item',
            'price' => 1500,
            'count' => 2,
            'user_id' => $user->id,
            'image_path' => null, // 画像が削除されていることを確認
        ]);

        // モックの行動を確認
        Mockery::close();
    }
}
