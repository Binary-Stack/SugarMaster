<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AddController;
use  App\Http\Controllers\ActionsController;
use  App\Http\Controllers\ProfileController as Profile;

Route::middleware('auth')->group(function () {

    Route::get('/branch/{branch?}', [AddController::class, 'showList'])->name('show_list');
    // Route::get('/showListB2', [AddController::class, 'showListB2'])->name('showListB2');

    Route::get('/creat_list', [AddController::class, 'create'])->name('creat_list');
    Route::get('/creat_revenuse', function () {
        return view("creat_revenuse");
    })->name('creat_revenuse');
    Route::get('/stock_taking', [AddController::class, 'show_taking'])->name('stock_taking');
    Route::get('/edit_1/{id}', [AddController::class, "edit"])->name('edit_1');
    Route::get('/profile', [Profile::class, 'showProfile'])->name('profile');

    Route::post('/creat_list/store_1', [ActionsController::class, 'storeList'])->name('createTheList');


    Route::post('/storeTager', [ActionsController::class, 'storeTager'])->name('storeTager');


    Route::post('/creat_revenuse/store', [ActionsController::class, 'incomingRegistration'])->name('creat_revenuse_1');

    // Route::post('/show_list/index', [AddController::class,'index_3'])->name('the_1_C_1');

    Route::post('/show_list_tager', [ActionsController::class, 'search'])->name('show_list_tager');


    Route::put('/the_5/{id}/UP', [ActionsController::class, "update"])->name('the_5_U');

    Route::delete('/the_5/{id}/DE', [ActionsController::class, "destroy"])->name('the_5_D');
    /* profile */
    /* profile */
});
/* V_1 */


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); */

require __DIR__ . '/auth.php';
