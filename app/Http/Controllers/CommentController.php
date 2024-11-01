<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

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
}
