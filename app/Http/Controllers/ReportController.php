<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;

use App\Models\Menu;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Report;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function create(Menu $menu, Category $category)
    {
        if ($menu->user_id !== Auth::id()) {
            $category = Category::all();
            return view('reports.create')->with(['menu' => $menu, 'categories' => $category]);
        }
        return redirect()->route('show', ['menu' => $menu->id]);
    }
    public function store(Menu $menu)
    {
        // Log::info('ログ出力テスト');
        // $input = $request['report'];MenuRequest $request, Menu $menu, Report $report
        // $report->user_id = $request->userId();
        // $report->menu_id = $menu->id;
        // $report->fill($input)->save();
        // return redirect('/menus/' . 1);
        // return redirect('/');
        return redirect()->route('show', ['menu' => $menu->id]);
    }
}
