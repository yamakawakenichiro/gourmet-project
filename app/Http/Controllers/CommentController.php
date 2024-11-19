<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $menuId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $menu = Menu::findOrFail($menuId);

        $menu->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('show', $menuId)->with('success', 'コメントが追加されました。');
    }
    public function delete($menuId, $commentId) // ルーターで変数を２つ使用していたら、こちらも２つ用意しないといけない。１つだけにして、Commentのバインディングさせようとしたが何故かできなかった。
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        // コメントの属するメニューにリダイレクト
        return redirect()->route('show', ['menu' => $comment->menu_id])
            ->with('message', 'コメントを削除しました');
    }
}
