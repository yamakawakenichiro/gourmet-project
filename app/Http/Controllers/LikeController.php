<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\SearchRequest;
use App\Models\User;
use App\Models\Menu;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function store(Menu $menu)
    {
        Auth::user()->like($menu);
        return back();
    }

    public function delete(Menu $menu)
    {
        Auth::user()->unlike($menu);
        return back();
    }

    public function index(SearchRequest $request, User $user)
    {
        $keywords = $request->input('keyword', []);

        //キーワードをフィルタリングして空要素を取り除く
        $keywords = array_filter($keywords, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });

        // ユーザーが「いいね」したメニューを取得
        $menus = $user->likes()->orderBy('updated_at', 'DESC')->paginate(30);

        $title = 'いいねしたメモ';

        // ビューにデータを渡す
        return view('menus.index')->with([
            'menus' => $menus,
            'user' => $user,
            'keywords' => $keywords,
            'title' => $title,
        ]);
    }
}
