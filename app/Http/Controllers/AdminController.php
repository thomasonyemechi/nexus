<?php

namespace App\Http\Controllers;

use App\Models\AdminCredit;
use App\Models\AdminDebit;
use App\Models\Announcment;
use App\Models\Deposit;
use App\Models\Earning;
use App\Models\PriceChange;
use App\Models\RoyaltyPayout;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    function approveEarned($wallet_id)
    {
        $earned = Earning::findOrFail($wallet_id);

        if ($earned->action == 'pending') {
            $earned->update([
                'action' => 'approved'
            ]);

            return back()->with('success', 'Earning has been approved');
        } else {
            return back()->with('error', 'Action has already been taked on Earning');
        }
    }


    public function earningindex()
    {
        // $earnings = Wallet::where(['remark' => 'Earning'])->orderBy('id', 'desc')->paginate(30);
        $earnings = Earning::orderBy('id', 'desc')->paginate(30);

        return view('admin.all_earnings', compact('earnings'));
    }

    function dorate()
    {
        $adminCredits = AdminCredit::where(['currency' => 'NXT'])->get();


        foreach ($adminCredits as $credit) {
            if (!$credit->rate) {
                $rate = PriceChange::latest()->first()->price;
                AdminCredit::where('id', $credit->id)->update([
                    'rate' => $rate
                ]);
            }
        }

        return 'done';
    }

    function adminIndex()
    {
        $pc_balance = Wallet::where(['type' => '2'])->sum('amount');

        $rate = PriceChange::latest()->first()->price;
        $pc_total = $pc_balance / $rate;

        $usdt_balance = $balance = Wallet::where(['type' => '1'])->sum('amount');

        $spc_balance = Wallet::where(['type' => '3'])->sum('amount');

        $total = $pc_total + $usdt_balance + $spc_balance;
        $announcement = Announcment::get();
        $transactions = Wallet::with(['user'])->orderby('id', 'desc')->limit(12)->get();
        $credits = AdminCredit::with(['user', 'admin'])->orderby('id', 'desc')->limit(10)->get();
        return view('admin.index', compact(['transactions', 'pc_balance', 'rate', 'pc_total', 'total', 'credits', 'usdt_balance', 'spc_balance', 'announcement']));
    }


    function managePendingDepositIndex()
    {
        $deposits = Deposit::with(['user:id,username'])->where(['status' => 'pending'])->orderby('id', 'desc')->paginate(25);
        return view('admin.pending_deposit', compact('deposits'));
    }


    function usersIndex(Request $request)
    {
        if ($request->user) {
            $users = User::with(['spon:id,username'])->where('username', 'LIKE', '%' . $request->user . '%')->orwhere('wallet', 'LIKE', '%' . $request->user . '%')->orderby('id', 'desc')->paginate(50);
        } else {
            $users = User::with(['spon:id,username'])->where('id', '>', 1)->orderby('id', 'desc')->paginate(50);
        }
        return view('admin.users', compact('users'));
    }



    function userIndex($wallet)
    {
        $user = User::where(['wallet' => $wallet])->first();
        if (!$user) {
            abort('404');
        }



        $user_id = $user->id;
        $pc_balance = pcBalance($user_id);

        $rate = PriceChange::latest()->first()->price;
        $pc_total = $pc_balance / $rate;

        $usdt_balance = usdtBalance($user_id);

        $spc_balance = spcBalance($user_id);

        $total = $pc_total + $usdt_balance + $spc_balance;



        $transactions = Wallet::where(['user_id' => $user->id])->orderby('id', 'desc')->limit(10)->get();
        $wallet_transactions = Wallet::where(['user_id' => $user->id])->orderby('id', 'desc')->limit(10)->get();
        return view('admin.user', compact(['transactions', 'pc_balance', 'user_id', 'rate', 'pc_total', 'total', 'usdt_balance', 'spc_balance', 'user', 'wallet_transactions']));
    }


    function royalusersIndex(Request $request)
    {
        $users = User::whereHas('purchases', function ($q) {
            $q->where('amount', '>=', 2000);
        })->withMax('purchases', 'amount')->get();


        return view('admin.royaty', compact(['users']));
    }


    function creditRoyalusersIndex()
    {
        $users = User::whereHas('purchases', function ($q) {
            $q->where('amount', '>=', 2000);
        })->withMax('purchases', 'amount')->get();


        return view('admin.royalty_credit', compact(['users']));
    }

    function depositHistoryIndex()
    {
        $deposits = Deposit::with(['user:id,username'])->orderby('id', 'desc')->paginate(25);
        return view('admin.deposit_history', compact('deposits'));
    }


    function approvedDepositIndex()
    {
        $deposits = Deposit::with(['user:id,username'])->where(['status' => 'approved'])->orderby('id', 'desc')->paginate(25);
        return view('admin.approved_deposit', compact('deposits'));
    }

    function rejectedDepositIndex()
    {
        $deposits = Deposit::with(['user:id,username'])->where(['status' => 'rejected'])->orderby('id', 'desc')->paginate(25);
        return view('admin.rejected_deposit', compact('deposits'));
    }


    function withdrawHistoryIndex()
    {
        $withdrawal = Withdrawal::with(['user:id,username'])->orderby('id', 'desc')->paginate(25);
        return view('admin.withdraw_history', compact('withdrawal'));
    }

    function withdrawPendingIndex()
    {
        $withdrawals = Withdrawal::with(['user:id,username'])->where(['status' => 'pending'])->orderby('id', 'desc')->paginate(25);
        return view('admin.pending_with', compact('withdrawals'));
    }


    // function allUsersIndex()


    function rejectDeposit(Request $request)
    {
        $val = Validator::make($request->all(), [
            'reason' => 'string',
            'deposit_id' => 'required|integer|exists:deposits,id',
        ])->validate();

        Deposit::where('id', $request->deposit_id)->update([
            'remark' => $request->remark,
            'processed_by' => auth()->user()->id,
            'status' => 'rejected'
        ]);
        ///////supposed notifier
        return back()->with('success', 'Deposit has been rejected');
    }


    function approveDeposit(Request $request)
    {
        $val = Validator::make($request->all(), [
            'reason' => 'string',
            'deposit_id' => 'required|integer|exists:deposits,id',
        ])->validate();

        $dep = Deposit::find($request->deposit_id);

        /////check if any action has once been take on this deposit
        if ($dep->status != 'pending') {
            return back()->with('error', 'This deposit cannot be approved');
        }

        $dep->update([
            'remark' => $request->remark,
            'processed_by' => auth()->user()->id,
            'status' => 'approved'
        ]);

        Wallet::create([
            'ref_id' => $dep->id,
            'currency' => 'usdt',
            'amount' => $dep->amount,
            'type' => 1,
            'remark' => 'Fund Deposit',
            'user_id' => $dep->user_id,
            'action' => 'credit'
        ]);

        return back()->with('success', 'Deposit has been approved, Account has been funded');
    }


    function approveWithdrawal(Request $request)
    {
        $val = Validator::make($request->all(), [
            'id' => 'required|integer|exists:withdrawals,id',
        ])->validate();

        $with = Withdrawal::find($request->id);

        /////check if any action has once been take on this deposit
        if ($with->status != 'pending') {
            return back()->with('error', 'This withdrawal request cannot be approved');
        }

        // if ($with->amount > usdtBalance($with->user_id)) {
        //     return back()->with('error', 'This deposit cannot be approved');
        // }

        $with->update([
            'processed_by' => auth()->user()->id,
            'status' => 'approved'
        ]);

        Wallet::where(['ref_id' => $with->id, 'amount' => -$with->amount])->update([
            'remark' => 'Fund Withdrawal',
        ]);
        return back()->with('success', 'Withdrwal has been approved');
    }



    function rejectWithdrawal(Request $request)
    {
        $val = Validator::make($request->all(), [
            'id' => 'required|integer|exists:withdrawals,id',
        ])->validate();

        $with = Withdrawal::find($request->id);

        /////check if any action has once been take on this deposit
        if ($with->status != 'pending') {
            return back()->with('error', 'This withdrawal request cannot be approved');
        }

        $with->update([
            'processed_by' => auth()->user()->id,
            'status' => 'rejected'
        ]);

        Wallet::where(['ref_id' => $with->id, 'amount' => -$with->amount])->delete();

        return back()->with('success', 'Withdrwal has been sucessfuly rejected');
    }


    public function createAccouncement(Request $request)
    {
        $res = Validator::make($request->all(), [
            'announcement' => 'required|min:3|string',
        ])->validate();

        Announcment::create([
            'announcement' => $request->announcement,
            'user_id' => auth()->user()->id
        ]);

        return back()->with('success', 'Announcement has been created');
    }


    // public function eidtAccouncement(Request $request)
    // {
    //     $res  = Validator::make($request->all(), [
    //         'announcement' => 'required|min:3|string',
    //         'id' => 'exists:announcements,id'
    //     ])->validate();

    //     Announcment::where('id', $request->id)->update([
    //         'announcement' => $request->announcement
    //     ]);

    //     return back()->with('success', 'Announcement has been deleted');
    // }


    function announcementIndex()
    {
        $announcements = Announcment::paginate(25);
        return view('admin.announcement', compact(['announcements']));
    }

    function deleteAnnouncement($id)
    {
        Announcment::where('id', $id)->delete();

        return back()->with('success', 'Announcement has been deleted');
    }


    function debit()
    {
        $debits = AdminDebit::with(['user', 'admin'])->orderby('id', 'desc')->paginate(25);
        return view('admin.debit_users', compact('debits'));
    }


    function credit()
    {
        $credits = AdminCredit::where(['type' => 'normal'])->with(['user', 'admin'])->orderby('id', 'desc')->paginate(25);
        return view('admin.credit_users', compact('credits'));
    }


    function creditroyaltyIndex()
    {
        $credits = AdminCredit::where(['type' => 'royalty'])->with(['user', 'admin'])->orderby('id', 'desc')->paginate(25);
        return view('admin.credit_royalty', compact(['credits']));
    }


    function creditUser(Request $request)
    {
        Validator::make($request->all(), [
            'wallet_address' => 'required|string|exists:users,wallet',
            'amount' => 'required',
            'currency' => 'required|string',
            'access_pin' => 'required|string'
        ])->validate();



        if (!password_verify($request->access_pin, auth()->user()->password)) {
            return back()->with('error', 'You entered a wrong password');
        }

        $user = User::where(['wallet' => $request->wallet_address])->first();
        if (!$user) {
            abort(404);
        }


        $credit = AdminCredit::create([
            'amount' => $request->amount,
            'user_id' => $user->id,
            'currency' => $request->currency,
            'remark' => $request->remark ?? 'Admin Deposit',
            'type' => $request->type,
            'rate' => PriceChange::latest()->first()->price,
            'by' => auth()->user()->id
        ]);

        $wallet = Wallet::create([
            'ref_id' => $credit->id,
            'currency' => $request->currency,
            'amount' => $request->amount,
            'user_id' => $user->id,
            'remark' => $request->remark ?? 'Admin Deposit',
            'action' => 'credit',
            'type' => 0,
        ]);

        if ($request->currency == 'usdt') {
            $wallet->update([
                'type' => 1,
            ]);

            // if credit action is a royalty credit do not buy coin and con not share profit
            if ($request->type == 'normal') {
                if ($user->collect_currency == 'NXT') {
                    //////// run buy function and but the crypto for the user else stop and credit
                    byCoinFunc($user->id, $request->amount);
                }
            }
        } else {
            $wallet->update([
                'type' => 2,
            ]);

            if ($request->type == 'normal') {
                // since credit users woth coin means they buy, also do the sharing percent to downline
                shareProfit($user->id, $request->amount, 'NXT');
            }
        }



        return back()->with('success', 'Wallet has been sucessfuly credited');
    }




    function debitUser(Request $request)
    {
        Validator::make($request->all(), [
            'wallet_address' => 'required|string|exists:users,wallet',
            'amount' => 'required',
            'currency' => 'required|string',
            'access_pin' => 'required|string'
        ])->validate();



        if (!password_verify($request->access_pin, auth()->user()->password)) {
            return back()->with('error', 'You entered a wrong password');
        }

        $user = User::where(['wallet' => $request->wallet_address])->first();
        if (!$user) {
            abort(404);
        }


        $debit = AdminDebit::create([
            'amount' => $request->amount,
            'user_id' => $user->id,
            'currency' => $request->currency,
            'remark' => $request->remark ?? 'Admin Deposit',
            'rate' => PriceChange::latest()->first()->price,
            'by' => auth()->user()->id
        ]);

        $wallet = Wallet::create([
            'ref_id' => $debit->id,
            'currency' => $request->currency,
            'amount' => -$request->amount,
            'user_id' => $user->id,
            'remark' => $request->remark ?? 'Admin Debit',
            'action' => 'debit',
            'type' => 0,
        ]);

        if ($request->currency == 'usdt') {
            $wallet->update([
                'type' => 1,
            ]);
        } else if ($request->currency == 'shc') {
            $wallet->update([
                'type' => 3,
            ]);
        } else {
            $wallet->update([
                'type' => 2,
            ]);
        }



        return back()->with('success', 'Wallet has been sucessfuly credited');
    }


    public function distribute(Request $request)
    {
        $userIds = $request->input('user_id');
        $royalties = $request->input('royal_percent_main');
        $percent = $request->input('royal_percent');

        foreach ($userIds as $index => $userId) {
            $amount = $royalties[$index] * $percent[$index];
            $uuid = $userId . date('y-m-d');


            $find = RoyaltyPayout::where('uuid', $uuid)->first();

            if (!$find) {
                // Save or dispatch royalty payout
                RoyaltyPayout::create([
                    'uuid' => $uuid,
                    'user_id' => $userId,
                    'amount' => $amount,
                    'distributed_at' => now(),
                    'action' => 'approved'
                ]);
            }
        }

        return response()->json(['success' => true]);
    }


    public function distributeSingle(Request $request)
    {


        $userId = $request->input('user_id');
        $amount = $request->input('amount');

        $uuid = $userId . date('y-m-d');
        $find = RoyaltyPayout::where('uuid', $uuid)->first();

        if (!$find) {
            // Save or dispatch royalty payout
            RoyaltyPayout::create([
                'uuid' => $uuid,
                'user_id' => $userId,
                'amount' => $amount,
                'distributed_at' => now(),
                'action' => 'approved'
            ]);

            return back()->with('success', 'Crystal rewards has been cedited');

        }

        return back()->with('error', 'you can\'t credit crystal reward twice');



    }

}
