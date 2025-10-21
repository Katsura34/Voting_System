<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function index()
    {
        $positions = Position::with(['candidates.party'])->get();
        return view('voting.index', compact('positions'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Prevent multiple votes from the same user
        if (Vote::where('user_id', $user->id)->exists()) {
            return redirect()->route('voting.index')->with('error', 'You have already voted.');
        }

        $request->validate([
            'votes' => 'required|array',
        ]);

        foreach ($request->votes as $position_id => $candidate_id) {
            Vote::create([
                'user_id' => $user->id,
                'position_id' => $position_id,
                'candidate_id' => $candidate_id,
            ]);
        }

        return redirect()->route('voting.index')->with('success', 'Your votes have been successfully recorded.');
    }
}
