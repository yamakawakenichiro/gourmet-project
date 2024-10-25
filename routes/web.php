<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Models\Menu;

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

Route::get('/', [MenuController::class, 'index'])->name('index');
Route::get('/menus/create', [MenuController::class, 'create'])->middleware('auth')->name('create');
Route::get('/menus/{menu}', [MenuController::class, 'show'])->name('show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/menus', [MenuController::class, 'store'])->middleware('auth')->name('store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/menus/{menu}', [MenuController::class, 'delete'])->name('delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
