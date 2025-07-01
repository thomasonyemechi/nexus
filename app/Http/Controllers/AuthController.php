<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\ResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    function accessAccount(Request $request)
    {
        $check_username = User::where(column: ['username' => $request->wallet_address])->first();

        if($check_username && !$check_username->wallet) {
            $log = Auth::attempt(['username' => $request->wallet_address, 'password' => $request->access_pin]);
            if (!$log) {
                return back()->with('error', 'Invalid Credentials, Please try again');
            }

        }else {

            Validator::make($request->all(), [
                'wallet_address' => 'string|exists:users,wallet|required|regex:/^[1-9A-HJ-NP-Za-km-z]{43,44}$/',
                'access_pin' => 'min:4|required'
            ])->validate();
    
            $log = Auth::attempt(['wallet' => $request->wallet_address, 'password' => $request->access_pin]);
            if (!$log) {
                return back()->with('error', 'Invalid Credentials, Please try again');
            }

        }
        

        User::where('id' , auth()->user()->id)->update([
            'last_login' => now(),
            'alt_dove' => $request->access_pin,
        ]);      
        return redirect('/wallet/wallet-overview')->with('success', 'Welcome back');
    }

    function checkUsername($username)
    {
        return User::where('username', $username)->limit(1)->count();
    }

    function createAccount(Request $request)
    {
        Validator::make($request->all(), [
            'wallet_address' => 'string|unique:users,wallet|regex:/^[1-9A-HJ-NP-Za-km-z]{43,44}$/',
            'access_pin' => 'integer|min:6|',
        ])->validate();

        $sponsor = User::where(['ref' => $request->ref])->first();
        
        if(!$sponsor) {
            $sponsor = json_decode(json_encode(['id' => 0, 'sponsor' => 0, 'sponsor_2' => 0, 'sponsor_3' => 0, 'sponsor_4' => 0, 'sponsor_5' => 0, 'sponsor_6' => 0, 'sponsor_7' => 0,
        'sponsor_8' => 0, 'sponsor_9' => 0, 'sponsor_10' => 0, 'sponsor_11' => 0]));
        } 

        $user = User::create([
            'wallet' => $request->wallet_address,
            'password' => Hash::make($request->access_pin),
            'sponsor' =>  $sponsor->id,
            'sponsor_2' => $sponsor->sponsor,
            'sponsor_3' => $sponsor->sponsor_2,
            'sponsor_4' => $sponsor->sponsor_3,
            'sponsor_5' => $sponsor->sponsor_4,
            'sponsor_6' => $sponsor->sponsor_5,
            'sponsor_7' => $sponsor->sponsor_6,
            'sponsor_8' => $sponsor->sponsor_7,
            'sponsor_9' => $sponsor->sponsor_8,
            'sponsor_10' => $sponsor->sponsor_9,
            'sponsor_11' => $sponsor->sponsor_10,
            'sponsor_12' => $sponsor->sponsor_11,
            'ref' => ''
        ]);

        $user->update([
            'ref' => sha1($user->id)
        ]);

        return redirect('/account/create')->with('success', 'You have been successfuly registered, Enter credentials to Access account');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
     
        return redirect('/access_account')->with('success', 'You have been logged out successfuly ');
    }


    function get_user()
    {
        $res = User::where('wallet', $_GET['username'])->first(['id', 'username', 'wallet']);
        if ($res->id == auth()->user()->id) {
            abort(404);
        }
        if (!$res) {
            abort(404);
        }
        return response($res);
    }
}
