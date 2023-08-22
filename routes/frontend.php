<?php

use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontendController::class)->group(function(){

    Route::get('/', 'homepage')->name('index');
    Route::get('/joblist', 'joblist')->name('joblist');
    Route::middleware('role:user')->get('/jobLike/{id}','jobLike')->name('jobLike');
    Route::middleware('role:user')->get('/disLike/{id}','disLike')->name('disLike');
    Route::get('/applyForJob/{slug}','applyForJob')->name('applyForJob');
    Route::post('/applied','applied')->name('applied');

});
