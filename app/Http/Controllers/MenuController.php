<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MenuController extends Controller
{
    public function index(SearchRequest $request, Menu $menu)
    {
        $keywords = $request->input('keyword', []);

        //キーワードをフィルタリングして空要素を取り除く
        $keywords = array_filter($keywords, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });

        // getPaginateByLimit にキーワードを渡す（空の場合も対応済み）
        $menus = $menu->getPaginateByLimit(30, $keywords);

        return view('menus.index')->with([
            'menus' => $menus,
            'keywords' => $keywords,
        ]);
    }
    public function userIndex(SearchRequest $request, $userId, Menu $menu)
    {
        $keywords = $request->input('keyword', []);

        // ＜条件式 ? 式1 : 式2＞  intval()は数値型でないデータを整数に変換 max(0, ...)は0とその整数値のうち大きい方を選ぶための関数
        $keywords['count'] = isset($keywords['count']) ? max(0, intval($keywords['count'])) : null;
        $keywords['price_min'] = isset($keywords['price_min']) ? max(0, intval($keywords['price_min'])) : null;
        $keywords['price_max'] = isset($keywords['price_max']) ? max(0, intval($keywords['price_max'])) : null;

        //array_filter関数の結果を再び$keywordsに代入することで、フィルタリング
        $keywords = array_filter($keywords, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });

        // ユーザー情報の取得
        $user = User::findOrFail($userId);

        // 該当ユーザーのメニューを取得
        $menus = Menu::where('user_id', $userId)
            ->getPaginateByLimit(30, $keywords);

        return view('menus.user_index')->with([
            'menus' => $menus,
            'user' => $user,
            'keywords' => $keywords
        ]);
    }

    public function show(Menu $menu)
    {
        $menu->loadCount('like_users');
        $user = $menu->user; // 既にリレーションによる利用が適切

        return view('menus.show')->with([
            'menu' => $menu,
            'like' => $menu->like_users_count,
            'user' => $user
        ]);
    }
    public function create()
    {
        return view('menus.create');
    }
    public function store(MenuRequest $request, Menu $menu)
    {
        // 画像の保存
        $imagePath = $menu->image_path;
        if ($request->hasFile('menu.image_path')) {
            // Cloudinaryに画像をアップロードし、パスを取得
            $uploadedFileUrl = Cloudinary::upload($request->file('menu.image_path')->getRealPath())->getSecurePath();
            $imagePath = $uploadedFileUrl;
        }
        $input = $request['menu'];
        $menu->user_id = $request->user()->id;
        $menu->image_path = $imagePath;
        $menu->fill($input)->save();
        return redirect()->route('index');
    }
    public function edit(Menu $menu)
    {
        if ($menu->user_id !== Auth::id()) {
            return redirect()->route('show', $menu);
        }
        return view('menus.edit')->with(['menu' => $menu]);
    }
    public function update(MenuRequest $request, Menu $menu)
    {
        $input = $request['menu'];

        if ($request->has('delete_image') && $request->delete_image == 'true') {
            // Cloudinaryから画像を削除
            $publicId = basename($menu->image_path, '.' . pathinfo($menu->image_path, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
            $menu->image_path = null;
        } elseif ($request->hasFile('menu.image_path')) {
            // Cloudinaryに画像をアップロードし、パスを取得
            $uploadedFileUrl = Cloudinary::upload($request->file('menu.image_path')->getRealPath())->getSecurePath();
            $menu->image_path = $uploadedFileUrl;
        }

        $menu->user_id = $request->user()->id;
        $menu->fill($input)->save();

        return redirect()->route('show', ['menu' => $menu->id]);
    }
    public function delete(Menu $menu)
    {
        // Cloudinaryから画像を削除
        if ($menu->image_path) {
            $publicId = basename($menu->image_path, '.' . pathinfo($menu->image_path, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
        }
        $menu->delete();
        return redirect()->route('index');
    }
}
