<?php

use App\Http\Controllers\AdminAirdropController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\CoinInfo;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('join');
});

Route::get('/sad', function () {
    return view('layouts.app');
});


Route::get('/start_login', function () {

    // $add = shareProfit(1569, 100, 'usdt');

    // return $add;
});

Route::get('/get_user', [AuthController::class, 'get_user']);
Route::post('/access_account', [AuthController::class, 'accessAccount']);
Route::post('/create_account_action', [AuthController::class, 'createAccount']);


Route::get('/get_price', function () {
    return response(CoinInfo::first());
});

Route::get('/validate_wallet', [WalletController::class, 'validateWallet']);


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'mobile', 'middleware' => ['auth']], function () {
    Route::get('/wallet-overview', [UserController::class, 'indexU']);

    Route::get('/deposit', [UserController::class, 'depositIndex']);

    Route::post('/withdrawal', [UserController::class, 'make_withdrawal']);
    Route::get('/withdrawal', [UserController::class, 'withdrwal']);

    Route::post('/update_collect_currency', [UserController::class, 'update_collect_currency']);

    Route::post('/transfer', [UserController::class, 'transfer'])->name('transfer');
    Route::get('/transfer', [UserController::class, 'transferIndex']);

    Route::get('/received', [UserController::class, 'rIndex']);
    Route::get('/earnings', [UserController::class, 'earningsIndex']);
    Route::get('/claim_bonus/{earning}', [UserController::class, 'claimComission']);
    Route::get('/claim_royal/{earning}', [UserController::class, 'claimRoyal']);
    Route::get('/invite', [UserController::class, 'inviteIndex']);

    Route::get('/purchase-fiat', [UserController::class, 'convertIndex']); //
    Route::post('/purchase-fiat', [UserController::class, 'buyCoin'])->name('buy_coin');

    Route::get('/royalty', [UserController::class, 'royaltyIndex']); //


    // airdrops 

    Route::get('/airdrops', [UserController::class, 'aridropIndex']); //



});



Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    // Route::get('/appointment/all', [AdminController::class, 'allAppointment']);  set_price
    Route::get('/dashboard', [AdminController::class, 'adminIndex']);
    Route::view('/deposit/pending', 'admin.all_users');
    Route::view('/manage_deposit', 'admin.manage_deposit');
    Route::get('/credit/royalty', [AdminController::class, 'creditroyaltyIndex']);
    Route::get('/credit', [AdminController::class, 'credit']);
    Route::post('/credit', [AdminController::class, 'creditUser']);
    Route::post('/debit', [AdminController::class, 'debitUser']);
    Route::get('/debit', [AdminController::class, 'debit']);
    Route::get('/users', [AdminController::class, 'usersIndex']);
    Route::get('/user/{wallet}', [AdminController::class, 'userIndex']);

    Route::get('/users/royalty', [AdminController::class, 'royalusersIndex']);
    Route::get('/users/credit_royalty', [AdminController::class, 'creditRoyalusersIndex']);
    Route::post('/users/distribute', [AdminController::class, 'distribute']);
    Route::post('/users/distribute_single', [AdminController::class, 'distributeSingle']);

    Route::get('/set_price', [SettingsController::class, 'setPriceIndex']);
    Route::post('/set_price', [SettingsController::class, 'updateCoinPrice']);
    Route::post('/set_wallet', [SettingsController::class, 'setReceivingWalletAddress']);


    Route::get('/approve_earning/{wallet_id}', [AdminController::class, 'approveEarned']);
    Route::get('/pending_earnings', [AdminController::class, 'earningindex']);


    Route::group(['prefix' => 'deposit/'], function () {
        Route::get('/pending', [AdminController::class, 'managePendingDepositIndex']);
        Route::post('/reject_deposit', [AdminController::class, 'rejectDeposit']);
        Route::post('/approve_deposit', [AdminController::class, 'approveDeposit']);
        Route::get('/history', [AdminController::class, 'depositHistoryIndex']);
        Route::get('/approved', [AdminController::class, 'approvedDepositIndex']);
        Route::get('/rejected', [AdminController::class, 'rejectedDepositIndex']);
    });


    Route::get('/credit', [AdminController::class, 'credit']);
    Route::post('/credit', [AdminController::class, 'creditUser']);

    Route::get('/announcement', [AdminController::class, 'announcementIndex']);
    Route::post('/announcement', [AdminController::class, 'createAccouncement']);
    Route::get('/delete-announcement/{id}', [AdminController::class, 'deleteAnnouncement']);

    Route::get('/manage-wallet', [WalletController::class, 'walletIndex']);
    Route::post('/add-wallet', [WalletController::class, 'createWallet']);
    Route::get('/delete-wallet/{wallet_id}', [WalletController::class, 'deleteAddres']);

    Route::group(['prefix' => 'withdrawal/'], function () {
        Route::get('/pending', [AdminController::class, 'withdrawPendingIndex']);
        Route::get('/history', [AdminController::class, 'withdrawHistoryIndex']);
        Route::post('/approve_withdrawal', [AdminController::class, 'approveWithdrawal']); //approve_withdrawal
        Route::post('/reject_withdrawal', [AdminController::class, 'rejectWithdrawal']); //approve_withdrawal
    });


    Route::get('/airdrops', [AdminAirdropController::class, 'index']);
    Route::post('/airdrops/create', [AdminAirdropController::class, 'store'])->name('admin.airdrops.store');
    Route::get('/airdrops/{id}/edit', [AdminAirdropController::class, 'edit'])->name('admin.airdrops.edit');
    Route::put('/airdrops/{id}', [AdminAirdropController::class, 'update'])->name('admin.airdrops.update');
    Route::patch('/airdrops/{id}/toggle', [AdminAirdropController::class, 'toggleStatus'])->name('admin.airdrops.toggle');
    Route::get('/airdrops/{id}/participants', [AdminAirdropController::class, 'participants'])->name('admin.airdrops.participants');


});
