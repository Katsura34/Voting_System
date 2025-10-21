<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartyController extends Controller
{
    /**
     * Display a listing of all parties.
     */
    public function index()
    {
        $parties = Party::orderBy('id', 'desc')->get();
        $canAddMore = Party::count() < 2; // Check if can add more parties
        return view('admin.parties.index', compact('parties', 'canAddMore'));
    }

    /**
     * Show the form for creating a new party.
     */
    public function create()
    {
        // Check if already have 2 parties
        if (Party::count() >= 2) {
            return redirect()->route('parties.index')
                ->with('error', 'Maximum of 2 parties allowed. Please delete an existing party first.');
        }
        
        return view('admin.parties.create');
    }

    /**
     * Store a newly created party in storage.
     */
    public function store(Request $request)
    {
        // Check party limit
        if (Party::count() >= 2) {
            return redirect()->route('parties.index')
                ->with('error', 'Maximum of 2 parties allowed. Please delete an existing party first.');
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:parties,name',
            'slogan' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('party_logos', 'public')
            : null;

        Party::create([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'logo' => $logoPath,
        ]);

        return redirect()->route('parties.index')->with('success', 'Party added successfully.');
    }

    /**
     * Show the form for editing the specified party.
     */
    public function edit(Party $party)
    {
        return view('admin.parties.edit', compact('party'));
    }

    /**
     * Update the specified party in storage.
     */
    public function update(Request $request, Party $party)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:parties,name,' . $party->id,
            'slogan' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $party->logo;

        if ($request->hasFile('logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('party_logos', 'public');
        }

        $party->update([
            'name' => $request->name,
            'slogan' => $request->slogan,
            'logo' => $logoPath,
        ]);

        return redirect()->route('parties.index')->with('success', 'Party updated successfully.');
    }

    /**
     * Remove the specified party from storage.
     */
    public function destroy(Party $party)
    {
        if ($party->logo && Storage::disk('public')->exists($party->logo)) {
            Storage::disk('public')->delete($party->logo);
        }

        $party->delete();

        return redirect()->route('parties.index')->with('success', 'Party deleted successfully.');
    }
}