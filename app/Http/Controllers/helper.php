<?php

use Illuminate\Support\Facades\Auth;
use App\Models\AdminCredit;
use App\Models\CoinInfo;
use App\Models\Earning;
use App\Models\MissedEarning;
use App\Models\MySlot;
use App\Models\PriceChange;
use App\Models\Purchase;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\ZEarning;
use App\Models\Zwallet;


function wallet()
{
    $wallet = Auth::user()->wallet;

    return substr($wallet, 0, 6) . '...' . substr($wallet, -6);
}





function depositStatus($status)
{
    if ($status == 'pending') {
        return '<div class="badge bg-secondary" > pending </div>';
    } elseif ($status == 'rejected') {
        return '<div class="badge bg-danger" > rejected </div>';
    } elseif ($status == 'approved') {
        return '<div class="badge bg-success" > approved </div>';
    }
}


function putwallet($wallet)
{
    return substr($wallet, 0, 6) . '...' . substr($wallet, -6);
}


function pendingWithAlert()
{
    $with = Withdrawal::where(['status' => 'pending'])->count();

    return $with;
}

function spcBalance($user_id)
{
    $balance = Wallet::where(['user_id' => $user_id, 'type' => '3'])->sum('amount');
    return $balance;
}

function coinTotalPurchase($user_id)
{
    $total = Purchase::where(['user_id' => $user_id])->sum('amount');
    return $total + RCtotalDepost($user_id);
}



function updateCreditRef()
{
    $all = Wallet::where(['type' => 2, 'action' => 'credit'])->get();
    $rate = PriceChange::latest()->first()->price;

    foreach ($all as $al) {
        if ($al->ref_id == 0) {
            $credit = AdminCredit::where(['user_id' => $al->user_id, 'amount' => $al->amount])->first();
            $al->update([
                'ref_id' => $credit->id
            ]);
        }
    }
}


function RCtotalDepost($user_id)
{
    $all = Wallet::where(['user_id' => $user_id, 'type' => 2, 'action' => 'credit'])->get();
    $total = 0;

    foreach ($all as $al) {
        $rate = $al->rate;
        if (isset($al->credit)) {
            if ($al->credit->rate > 0) {
                $total += ($al->amount / $al->credit->rate);
            }

        } else {
            $total += 0;
        }
    }
    return $total;
}


function hybridTotalPurchase()
{
    return;
}


function usdtBalance($user_id)
{
    $balance = Wallet::where(['user_id' => $user_id, 'type' => '1'])->sum('amount');
    return $balance;
}

function pcBalance($user_id)
{
    $balance = Wallet::where(['user_id' => $user_id, 'type' => '2'])->sum('amount');
    return $balance;
}



function depositAmount($amount)
{
    return number_format($amount, 2) . ' USDT';
}


function dropError()
{
    if (session('success')) {
        return '
            <div class="mb-2 val_err ">
                <i class="text-success fw-bold "> ' . session('success') . ' </i>
            </div>
        ';
    } else if (session('error')) {
        return '
        <div class="mb-2 val_err">
            <i class="text-danger fw-bold "> ' . session('error') . ' </i>
        </div>
    ';
    }
}


function admins()
{
    return [1, 2];
}


function byCoinFunc($user_id, $amount)
{
    // buy coin login here 
    $rate = PriceChange::latest()->first()->price;

    ///////log purchase in purchase
    $purchase = Purchase::create([
        'user_id' => $user_id,
        'amount' => $amount,
        'rate' => $rate,
        'currency' => 'nxt'
    ]);

    //debit user USDT beause of purchase
    Wallet::create([
        'currency' => 'usdt',
        'amount' => -$amount,
        'type' => 1,
        'user_id' => $user_id,
        'remark' => 'nexus token purchase',
        'ref_id' => $purchase->id,
        'action' => 'debit'
    ]);

    //credit user with coin
    Wallet::create([
        'currency' => 'NXT',
        'amount' => ($amount * $rate),
        'type' => 2,
        'user_id' => $user_id,
        'remark' => 'Nexus Token Deposit',
        'ref_id' => $purchase->id,
        'action' => 'credit'
    ]);

    // i am multiplying by 0.9 because only 90 % of the money will be used to buy coin 10% will be spent of uplines
    // this function below share the 10%;
    shareProfit($user_id, $amount, 'usdt');
    return;
}


function shareProfit($user_id, $amount, $currency = 'usdt')
{
    $user = User::find($user_id);

    $sponsor = ($user->sponsor) ? $user->sponsor : 2 ; 

    $usdt_amount = $amount;
    // $sponsors = [ ['id' => $user->sponsor ?? 1, 'percent' => 6], ['id' => $user->sponsor_2 ?? 1, 'percent' => 2], ['id' => $user->sponsor_3 ?? 1, 'percent' => 2] ];

    // sending only to one sponsor all the percentage 
    $percent = ($usdt_amount * 10) / 100; //caluclating percentage
    // log earnings 


    $earned = Earning::create([
        'user_id' => $sponsor,
        'amount' => $percent,
        'downline' => $user->id
    ]);

    Wallet::create([
        'currency' => 'USDT',
        'amount' => $percent,
        'type' => 3,
        'user_id' => $sponsor,
        'remark' => 'Earning',
        'ref_id' => $earned->id,
        'action' => 'pending'
    ]);

    return;
}





function formatDate($date)
{
    return date('j M Y , h:i: a', strtotime($date));
}
