<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Auth::routes();
Route::put('/mobile_wallet/{id}', 'MobileWalletController@transfer_fund')->name('mobile_wallet');

Route::get('/transaction_history', 'MobileWalletController@transaction_history')->name('transaction_history');
Route::get('/transaction_details', 'MobileWalletController@transaction_details')->name('transaction_details');
