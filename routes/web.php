<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AddController;
use App\Http\Controllers\ProfileController;
use  App\Http\Controllers\ActionsController;
use App\Http\Controllers\Auth\PasswordController;
use  App\Http\Controllers\ProfileController as Profile;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('auth')->group(function () {


    Route::get('/branch/{branch?}', [AddController::class, 'showList'])->name('show_list');
    Route::get('/1', function () {
        return redirect()->route('show_list');
    });
    Route::get('/creat_list', [AddController::class, 'create'])->name('creat_list');
    Route::get('/creat_revenuse', function () {
        return view("creat_revenuse");
    })->name('creat_revenuse');
    Route::get('/stock_taking', [AddController::class, 'show_taking'])->name('stock_taking');
    Route::get('/edit_1/{id}', [AddController::class, "edit"])->name('edit_1');
    Route::get('/profile/{status?}', [Profile::class, 'showProfile'])->name('profile');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route::put('/updateProfile/{id}', [Profile::class, 'updateProfile'])->name('updateProfile');



    require __DIR__ . '/actions.php';
});
/* V_1 */


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

/* Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */

Route::middleware('redirect')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('loginAthentication');
});
require __DIR__ . '/auth.php';
