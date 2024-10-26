<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Shop;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index(Menu $menu)
    {
        return view('menus.index')->with(['menus' => $menu->getPaginateByLimit()]);
    }
    public function show(Menu $menu)
    {
        return view('menus.show')->with(['menu' => $menu]);
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
        return redirect('/menus/' . $menu->id);
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
        return redirect('/menus/' . $menu->id);
    }
    public function delete(Menu $menu)
    {
        $menu->delete();
        return redirect('/');
    }
}
