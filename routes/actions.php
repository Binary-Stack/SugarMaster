<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ActionsController;



    

    Route::post('/creat_list/store_1', [ActionsController::class, 'storeList'])->name('createTheList');
    
    
    Route::post('/storeTager', [ActionsController::class, 'storeTager'])->name('storeTager');
    
    
    Route::post('/creat_revenuse/store', [ActionsController::class, 'incomingRegistration'])->name('creat_revenuse_1');
    
    // Route::post('/show_list/index', [AddController::class,'index_3'])->name('the_1_C_1');
    Route::post('/searchDate', [ActionsController::class, 'searchDate'])->name('searchDate');
    
    Route::post('/show_list_tager', [ActionsController::class, 'search'])->name('show_list_tager');
    
    
    Route::put('/the_5/{id}/UP', [ActionsController::class, "update"])->name('the_5_U');
    
    Route::delete('/the_5/{id}/DE', [ActionsController::class, "destroy"])->name('the_5_D');


    