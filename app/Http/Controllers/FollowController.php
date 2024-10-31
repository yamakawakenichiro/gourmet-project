<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser->isFollowing($user)) {
            $currentUser->followings()->attach($user->id);
        }
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        $currentUser = auth()->user();
        if ($currentUser->isFollowing($user)) {
            $currentUser->followings()->detach($user->id);
        }
        return redirect()->back();
    }
}
