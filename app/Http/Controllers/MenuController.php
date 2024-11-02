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

        // ＜条件式 ? 式1 : 式2＞  intval()は数値型でないデータを整数に変換 max(0, ...)は0とその整数値のうち大きい方を選ぶための関数
        $keywords['count'] = isset($keywords['count']) ? max(0, intval($keywords['count'])) : null;
        $keywords['price_min'] = isset($keywords['price_min']) ? max(0, intval($keywords['price_min'])) : null;
        $keywords['price_max'] = isset($keywords['price_max']) ? max(0, intval($keywords['price_max'])) : null;

        //array_filter関数の結果を再び$keywordsに代入することで、フィルタリング
        $keywords = array_filter($keywords, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });

        return view('menus.index')->with([
            'menus' => $menu->getPaginateByLimit(10, $keywords),
            'keywords' => $keywords
        ]);
    }
    public function show(Menu $menu)
    {
        $like = $menu->like_users()->count();
        $user = User::find($menu->user_id);
        return view('menus.show')->with(['menu' => $menu, 'like' => $like, 'user' => $user]);
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
            // Cloudinaryから画像を削除するコードをここに追加（削除方法はCloudinaryのドキュメントを参照）
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
        $menu->delete();
        return redirect()->route('index');
    }
}
