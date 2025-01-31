<?php

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
Route::get('/sell', function () {
    return view('sell');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/mypage/profile', function () {
    return view('profile.setting');
});
Route::get('/mypage', function () {
    return view('profile.index');
});
Route::get('/item/{item}', function () {
    return view('detail');
});
Route::get('/item/{item}', function () {
    return view('detail');
});
Route::get('/purchase/{item}', function () {
    return view('purchase');
});
Route::get('/purchase/address/{item}', function () {
    return view('shipment');
});
