<?php

use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware(['auth', 'is_ban'])->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_ban'])->prefix('/daseboard')->group(function () {

    // job post routes
    Route::prefix('/jobpost')->controller(PostController::class)->name('post')->group(function () {
        Route::get('/postDetail/{id}', 'postDetail')->name('.detail');
        Route::get('/postEdit/{id}', 'postEdit')->name('.edit');
        
        Route::middleware(["role:employer|admin"])->get('/postForm', 'postForm')->name('.postForm');
        Route::middleware(["role:employer|admin"])->post('/addPost', 'addPost')->name('.add');
        Route::middleware(["role:employer|admin"])->get('/allPost', 'allPost')->name('.all');
        Route::middleware(["role:employer|admin"])->post('/postUpdated/{id}', 'postUpdated')->name('.update');
        route::middleware('role:admin')->get('/approval', 'postApproval')->name('.approval');
        route::middleware('role:admin')->get('/approve/{id}', 'postApprove')->name('.approve');
        route::middleware('role:admin')->get('/disapprove/{id}', 'postdisApprove')->name('.disapprove');
    });

    // user approve
    Route::prefix('/userApprove')->controller(UserController::class)->name('user')->group(function () {
        Route::middleware('role:admin')->get('/allUser', 'allUser')->name('.all');
        Route::middleware('role:admin')->get('/allEmployer', 'allEmployer')->name('.employe');
        Route::middleware('role:admin')->get('/banUser/{id}', 'banUser')->name('.ban');
        Route::middleware('role:admin')->get('/activeUser/{id}', 'activeUser')->name('.active');
        Route::middleware(['role:employer|admin'])->get('/JobAppliedPost/{id}', 'JobAppliedPost')->name('.JobAppliedPost');
        Route::middleware(['role:employer|admin'])->get('/userDetails/{id}', 'userDetails')->name('.details');
    });

    Route::middleware('role:user')->prefix('/userPost')->controller(UserController::class)->name('userPost')->group(function () {
        Route::get('/likePost', 'likePost')->name('.like');
        Route::get('/appliedPost', 'appliedPost')->name('.applied');
        Route::get('/deniedPost/{id}', 'deniedPost')->name('.denied');
    });

    Route::prefix('/infoSetup')->controller(UserController::class)->name('info')->group(function () {
        Route::get('/infoForm', function(){
            return view('layouts.backend.otherInfo');
        })->name('.form');
        Route::Post('/infoStore', 'infoStore')->name('.all');
        Route::Post('/changePersonalInfo', 'changePersonalInfo')->name('.personal');
    });
});
