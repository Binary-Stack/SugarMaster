<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AddController;
Route::get('/Run', [AddController::class , 'show_data'])->name('show_list');

Route::get('/creat_list', [AddController::class,'creat_list'])->name('creat_list');

Route::post('/creat_list/store_1', [AddController::class,'create_list_1'])->name('createTheList');

Route::post('/create_user', [AddController::class,'index_1'])->name('create_user');

Route::get('/creat_revenuse', function (){return view("creat_revenuse");})->name('creat_revenuse');

Route::post('/creat_revenuse/store', [AddController::class,'store'])->name('creat_revenuse_1');

// Route::post('/show_list/index', [AddController::class,'index_3'])->name('the_1_C_1');

Route::get('/stock_taking', [AddController::class , 'show_taking'] )->name('stock_taking');

Route::post('/show_list_tager', [AddController::class,'search'])->name('show_list_tager');

Route::get('/edit_1/{id}', [AddController::class , "edit"])->name('edit_1');

Route::put('/the_5/{id}/UP', [AddController::class , "update"])->name('the_5_U');

Route::delete('/the_5/{id}/DE', [AddController::class , "destroy"])->name('the_5_D');
/* V_1 */


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
