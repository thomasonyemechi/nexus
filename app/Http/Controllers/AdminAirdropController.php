<?php

namespace App\Http\Controllers;

use App\Models\Airdrop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminAirdropController extends AirdropController
{

    public function index()
    {
        $airdrops = Airdrop::latest()->paginate(10);
        return view('admin.airdrops_index', compact('airdrops'));
    }


    // Store a new airdrop
    public function store(Request $request)
    {
        $val = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_referrals' => 'required|integer|min:1',
            'reward_amount' => 'required|numeric|min:0',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ])->validate();

        Airdrop::create([
            'title' => $request->title,
            'description' => $request->description,
            'target_referrals' => $request->target_referrals,
            'reward_amount' => $request->reward_amount,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'active' => true,
        ]);

        return back()->with('success', 'Airdrop created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $airdrop = Airdrop::findOrFail($id);
        return view('admin.airdrops.edit', compact('airdrop'));
    }

    // Update an airdrop
    public function update(Request $request, $id)
    {
        $airdrop = Airdrop::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_referrals' => 'required|integer|min:1',
            'reward_amount' => 'required|numeric|min:0',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        $airdrop->update([
            'title' => $request->title,
            'description' => $request->description,
            'target_referrals' => $request->target_referrals,
            'reward_amount' => $request->reward_amount,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return redirect()->route('admin.airdrops.index')->with('success', 'Airdrop updated successfully.');
    }

    // Deactivate or activate an airdrop
    public function toggleStatus($id)
    {
        $airdrop = Airdrop::findOrFail($id);
        $airdrop->active = !$airdrop->active;
        $airdrop->save();

        return back()->with('success', 'Airdrop status updated.');
    }

    // Show participants
    public function participants($id)
    {
        $airdrop = Airdrop::with(['users.user'])->findOrFail($id);
        $participants = AirdropsUser::where('airdrop_id', $id)->with('user')->paginate(20);

        return view('admin.airdrops.participants', compact('airdrop', 'participants'));
    }


}
