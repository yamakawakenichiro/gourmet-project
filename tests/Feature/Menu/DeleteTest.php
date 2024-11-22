<?php

namespace Tests\Feature\Menu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Models\Menu;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary; // コントローラーと同条件でないといけない



class DeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_delete_successed(): void
    {
        // Cloudinaryのアップローダーをモック
        $cloudinaryUploaderMock = Mockery::mock('alias:' . Cloudinary::class);
        $cloudinaryUploaderMock->shouldReceive('destroy')->once()->andReturn(true);

        // ユーザーを作成
        $user = User::factory()->create();

        // ユーザーに関連するメニュー項目を作成
        $menu = Menu::factory()->for($user)->create([
            'image_path' => 'path/to/image.jpg',
        ]);
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->withSession(['_token' => csrf_token()]);
        $response = $this->actingAs($user)->delete(route('delete', $menu->id));

        // ステータスコードが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // 期待するリダイレクト先を確認
        $response->assertRedirect(route('index'));

        // メニュー項目がデータベースに論理削除されていることを確認
        $this->assertSoftDeleted('menus', ['id' => $menu->id]);

        // モックの期待を確認
        Mockery::close();
    }
}
