<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('join');
});

Route::get('/sad', function () {
    return view('layouts.app');
});


Route::get('/start_login', function () {
    Auth::loginUsingId(1);
    return auth()->user();
});





Route::group(['prefix' => 'mobile', 'middleware' => [] ], function () {
    Route::get('/wallet-overview', [UserController::class, 'indexU']);

    Route::get('/deposit', [UserController::class, 'depositIndex']);

    Route::post('/withdrawal', [UserController::class, 'make_withdrawal']);
    Route::get('/withdrawal', [UserController::class, 'withdrwal']);

    Route::post('/update_collect_currency', [UserController::class, 'update_collect_currency']);

    Route::post('/transfer', [UserController::class, 'transfer'])->name('transfer');
    Route::get('/transfer', [UserController::class, 'transferIndex']);

    Route::get('/received', [UserController::class, 'rIndex']);
    Route::get('/earnings', [UserController::class, 'earningsIndex']);
    Route::get('/invite', [UserController::class, 'inviteIndex']);

    Route::get('/purchase-fiat', [UserController::class, 'convertIndex']); //
    Route::post('/purchase-fiat', [UserController::class, 'buyCoin'])->name('buy_coin');

});
