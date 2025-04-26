<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ActionsController;
use  App\Http\Controllers\ProfileController as Profile;





Route::post('/creat_list/store_1', [ActionsController::class, 'storeList'])->name('createTheList');


Route::post('/storeTager', [ActionsController::class, 'storeTager'])->name('storeTager');


Route::post('/creat_revenuse/store', [ActionsController::class, 'incomingRegistration'])->name('creat_revenuse_1');

// Route::post('/show_list/index', [AddController::class,'index_3'])->name('the_1_C_1');
Route::post('/searchDate', [ActionsController::class, 'searchDate'])->name('searchDate');

Route::post('/searchDate/comprehensive', [ActionsController::class, 'searchDateComprehensive'])->name('searchDateComprehensive');

Route::post('/show_list_tager', [ActionsController::class, 'search'])->name('show_list_tager');

Route::put('/updateProfile/{id}', [Profile::class, 'updateProfile'])->name('updateProfile');

Route::put('/updatePassword', [Profile::class, 'updatePassword'])->name('updatePassword');


Route::put('/the_5/{id}/UP/{branch}', [ActionsController::class, "update"])->name('Update');

Route::delete('/the_5/{id}/DE/{branch}', [ActionsController::class, "destroy"])->name('Destroy');
