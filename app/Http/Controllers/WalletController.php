<?php

namespace App\Http\Controllers;

use App\Models\AdminWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function walletIndex()
    {
        $wallets = AdminWallet::get();
        return view('admin.manage-wallet', compact(['wallets']));
    }

    public function createWallet(Request $request)
    {
        Validator::make($request->all(), [
            'wallet_address' => 'required|unique:admin_wallets,wallet_address',
        ])->validate();

        AdminWallet::create([
            'wallet_address' => $request->wallet_address,
            'status' => 'active',
            'by' => auth()->user()->id
        ]);

        return back()->with('success', 'Wallet address has been sucessfuly created');
    }


    function updateWalletAddress(Request $request)
    {
        Validator::make($request->all(), [
            'wallet_address' => 'required',
        ])->validate();


        AdminWallet::where('id', $request->wallet_id)->update([
            'walet_address' => $request->wallet_address, 
            'by' => auth()->user()->id
        ]);

        return back()->with('success', 'Wallet address has been updated');
    }



    function deleteAddres($wallet_id)
    {
        AdminWallet::where('id', $wallet_id)->delete();
        return back()->with('success', 'wallet address has been deleted sucessfuly');
    }


    function validateWallet()
    {
        $new_wallet = AdminWallet::where(column: ['status' => 'active'])->inrandomorder()->first();
        return response([
            'new_wallet' => $new_wallet->wallet_address,
        ]);
    }
}
