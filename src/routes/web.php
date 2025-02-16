<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
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
Route::get('/', [ProductListController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/mypage', function () {
        return view('profile.index');
    });
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
    Route::patch('/mypage/profile', [ProfileController::class, 'update']);
    Route::get('/sell', function () {
        return view('sell');
    });
    Route::get('/purchase/{item}', [PurchaseController::class , 'index']);
    Route::get('/purchase/address/{item}', function () {
        return view('shipment');
    });
    Route::post('/comment/{id}', [CommentController::class,'store']);
});
Route::get('/item/{item}', [ProductListController::class,'detail']);
Route::post('/like' ,[ProductListController::class,'like']);
