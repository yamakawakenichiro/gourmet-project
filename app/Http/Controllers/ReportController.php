<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Report;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function create(Menu $menu)
    {
        if ($menu->user_id !== Auth::id()) {
            $categories = Category::all();
            return view('reports.create')->with(['menu' => $menu, 'categories' => $categories]);
        }
        return redirect()->route('show', ['menu' => $menu->id]);
    }
    public function store(ReportRequest $request, Menu $menu, Report $report,)
    {
        $input = $request['report'];
        $report->user_id = $request->userId();
        $report->menu_id = $menu->id;
        $report->fill($input)->save();
        return redirect()->route('show', ['menu' => $menu->id]);
    }
}
