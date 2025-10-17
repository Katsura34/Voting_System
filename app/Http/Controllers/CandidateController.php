<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Position;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of all candidates.
     */
    public function index()
    {
        $candidates = Candidate::with(['position', 'party'])->orderBy('id', 'desc')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new candidate.
     */
    public function create()
    {
        $positions = Position::all();
        $parties = Party::all();
        return view('admin.candidates.create', compact('positions', 'parties'));
    }

    /**
     * Store a newly created candidate in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'party_id' => 'required|exists:parties,id',
            'position_id' => 'required|exists:positions,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        $photoPath = $request->hasFile('photo')
            ? $request->file('photo')->store('candidates', 'public')
            : null;

        Candidate::create([
            'name' => $request->name,
            'party_id' => $request->party_id,
            'position_id' => $request->position_id,
            'photo' => $photoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
    }

    /**
     * Show the form for editing the specified candidate.
     */
    public function edit(Candidate $candidate)
    {
        $positions = Position::all();
        $parties = Party::all();
        return view('admin.candidates.edit', compact('candidate', 'positions', 'parties'));
    }

    /**
     * Update the specified candidate in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'party_id' => 'required|exists:parties,id',
            'position_id' => 'required|exists:positions,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        $photoPath = $candidate->photo;

        if ($request->hasFile('photo')) {
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('candidates', 'public');
        }

        $candidate->update([
            'name' => $request->name,
            'party_id' => $request->party_id,
            'position_id' => $request->position_id,
            'photo' => $photoPath,
            'description' => $request->description,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    /**
     * Remove the specified candidate from storage.
     */
    public function destroy(Candidate $candidate)
    {
        if ($candidate->photo && Storage::disk('public')->exists($candidate->photo)) {
            Storage::disk('public')->delete($candidate->photo);
        }

        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
