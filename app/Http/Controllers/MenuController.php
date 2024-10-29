<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Shop;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        return view('menus.show')->with(['menu' => $menu, 'like' => $like]);
    }
    public function create()
    {
        return view('menus.create');
    }
    public function store(MenuRequest $request, Menu $menu, Shop $shop)
    {
        //shopsに同一のshop_nameが存在しない場合、shopsにshop_nameを保存
        $shop_name = $request->input('menu.shop_name');
        $existing_shop = Shop::where('name', $shop_name)->first();
        if (!$existing_shop) {
            $shop->user_id = $request->userId();
            $shop->name = $shop_name;
            $shop->save();
        }

        $input = $request['menu'];
        $menu->user_id = $request->userId();
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
    public function update(MenuRequest $request, Menu $menu, Shop $shop)
    {
        //shopsに同一のshop_nameが存在しない場合、shopsにshop_nameを保存
        $shop_name = $request->input('menu.shop_name');
        $existing_shop = Shop::where('name', $shop_name)->first();
        if (!$existing_shop) {
            $shop->user_id = $request->userId();
            $shop->name = $shop_name;
            $shop->save();
        }

        $input = $request['menu'];
        $menu->user_id = $request->userId();
        $menu->fill($input)->save();
        return redirect()->route('show', ['menu' => $menu->id]);
    }
    public function delete(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('index');
    }
}
