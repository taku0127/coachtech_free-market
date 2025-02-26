<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StripeController;
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

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/mypage', [ProductListController::class,'mypage']);
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
    Route::patch('/mypage/profile', [ProfileController::class, 'update']);
    Route::get('/sell', [SellController::class, 'index']);
    Route::post('/sell', [SellController::class, 'store']);
    Route::get('/purchase/{item}', [PurchaseController::class , 'index']);
    Route::post('/purchase/{item}', [PurchaseController::class , 'store']);
    Route::get('/purchase/address/{item}', [PurchaseController::class , 'changeAddress']);
    Route::post('/purchase/address/{item}' ,[PurchaseController::class,'storeAddress']);
    Route::post('/comment/{id}', [CommentController::class,'store']);
    Route::get('/charge/{item}', [StripeController::class,'index']);
    Route::post('/conveni', [StripeController::class, 'conveni']);
    Route::get('/conveni/status/', [StripeController::class, 'status'])->name('conveni/status');
    Route::post('/charge', [StripeController::class,'charge']);
    Route::post('/like' ,[ProductListController::class,'like']);
});
Route::get('/item/{item}', [ProductListController::class,'detail']);
