<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth::routes();
Route::controller(FrontendController::class)->group(function () {

    Route::get('/', 'homepage');
    // Route::middleware('role:user')->get('/jobLike/{id}','jobLike')->name('jobLike');
    // Route::middleware('role:user')->get('/disLike/{id}','disLike')->name('disLike');
    // Route::get('/applyForJob/{slug}','applyForJob')->name('applyForJob');
    // Route::post('/applied','applied')->name('applied');
    
});

Route::controller(ApiController::class)->group(function () {
    
    // 
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    // post related api
    Route::get('/joblist', 'joblist');
    Route::get('/jobApply', 'jobApply')->middleware(['auth:sanctum','role:user']);
    Route::get('/notApprovejoblist', 'notApprovejoblist');
    Route::put('/forApprovejob', 'forApprovejob')->middleware(['auth:sanctum','role:admin']);
    Route::post('/jobPost', 'jobPost')->middleware(['auth:sanctum','role:admin|employer']);

});
