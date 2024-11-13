<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GeminiController;
use App\Models\Like;
use App\Models\Menu;
use App\Models\Report;
use Illuminate\Support\Facades\Log;

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//投稿CRUD
Route::get('/', [MenuController::class, 'index'])->name('index');
Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('show');

// グーグルログイン
Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth'])->name('auth.google');
Route::get('/login/callback', [GoogleLoginController::class, 'authGoogleCallback']);

//ダッシュボード（デフォルト）
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //投稿CRUD 
    Route::get('/menus/create', [MenuController::class, 'create'])->name('create');
    Route::post('/menus', [MenuController::class, 'store'])->name('store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/menus/{menu}', [MenuController::class, 'delete'])->name('delete');

    //報告機能
    Route::get('/menus/{menu}/report', [ReportController::class, 'create'])->name('report.create');
    Route::post('/reports/{menu}', [ReportController::class, 'store'])->name('report.store');

    //いいね機能
    Route::post('/reports/{menu}/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/reports/{menu}/like', [LikeController::class, 'delete'])->name('like.delete');

    //プロファイル（デフォルト）
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // フォロー・アンフォロー
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('follow');
    Route::post('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('unfollow');

    // コメント
    Route::post('/menus/{menu}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Gemini
    Route::post('/gemini', [GeminiController::class, 'post'])->name('gemini.post');

    // ユーザー毎の
    Route::get('/user/{userId}/menus', [MenuController::class, 'userIndex'])->name('user.index');
});
