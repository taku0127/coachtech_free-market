<?php

use App\Http\Controllers\ProfileController;
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
Route::get('/', function () {
    return view('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/mypage', function () {
        return view('profile.index');
    });
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
    Route::patch('/mypage/profile', [ProfileController::class, 'update']);
    Route::get('/sell', function () {
        return view('sell');
    });
    Route::get('/purchase/{item}', function () {
        return view('purchase');
    });
    Route::get('/purchase/address/{item}', function () {
        return view('shipment');
    });
});
Route::get('/item/{item}', function () {
    return view('detail');
});
