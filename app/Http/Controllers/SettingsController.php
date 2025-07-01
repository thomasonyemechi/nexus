<?php

namespace App\Http\Controllers;

use App\Models\CoinInfo;
use App\Models\PriceChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    function setPriceIndex() 
    {
        $coin = CoinInfo::first();
        $price_changes = PriceChange::with(['user:id,username'])->orderby('id', 'desc')->limit(25)->get();
        return view('admin.set_price', compact(['coin', 'price_changes']));
    }


    function setReceivingWalletAddress(Request $request)
    {
        Validator::make($request->all(), [
            'wallet_address' => 'required|string|min:10'
        ])->validate();
        $coin = CoinInfo::first();
        $coin->update([
            'wallet_address' => $request->wallet_address
        ]);
        return back()->with('success', 'Receving wallet address has been updated');
    }


    function updateCoinPrice(Request $request)
    {
        Validator::make($request->all(), [
            'price' => 'required'
        ])->validate();

        $coin_info = CoinInfo::first();

        $coin_info->update([
            'price' => $request->price
        ]);
        
        $this->logCoinPriceChange($request->price);

        return back()->with('success', 'Coin price has been Updated');
    }


    function logCoinPriceChange($price)
    {
        PriceChange::create([
            'price' => $price,
            'created_by' => auth()->user()->id
        ]);
    }



    // public function setCoinPrice(Request $request)
    // {
    //     $val = Validator::make($request->all(), [
    //         'price' => 'required'
    //     ]);

    //     PriceChange::create([
    //         'price' => $request->price,
    //         'created_by' => auth()->user()->id
    //     ]);

    //     return back()->with('success', 'Coin price has been updated scuessfuly');
    // }



    
}
