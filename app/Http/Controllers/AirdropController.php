<?php

namespace App\Http\Controllers;

use App\Models\Airdop;
use App\Models\AirdropReferral;
use App\Models\User;
use Illuminate\Http\Request;

class AirdropController extends Controller
{
    public function trackReferral($refCode)
    {
        $referrer = User::where('ref', $refCode)->first();
        if ($referrer) {
            $user = auth()->user();

            AirdropReferral::create([
                'airdrop_user_id' => $referrer->id,
                'referred_user_id' => $user->id
            ]);

            $referrer->increment('referral_count');

            // Check qualification
            if ($referrer->referral_count >= $referrer->airdrop->target_referrals) {
                $referrer->qualified = true;
                $referrer->save();
            }
        }
    }


}
