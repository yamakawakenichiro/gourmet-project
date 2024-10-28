<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
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
}
