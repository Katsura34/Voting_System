<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\User;
use App\Models\Party;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with vote analytics.
     */
    public function index()
    {
        // Get vote counts by candidate for chart
        $voteData = Vote::select('candidates.name as candidate_name', 'parties.name as party_name', DB::raw('count(*) as vote_count'))
            ->join('candidates', 'votes.candidate_id', '=', 'candidates.id')
            ->leftJoin('parties', 'candidates.party_id', '=', 'parties.id')
            ->groupBy('candidates.id', 'candidates.name', 'parties.name')
            ->orderBy('vote_count', 'desc')
            ->get();

        // Get vote counts by position for detailed analysis
        $positionData = Position::withCount('votes')
            ->with(['candidates' => function($query) {
                $query->withCount('votes')->with('party');
            }])
            ->get();

        // Prepare chart data
        $chartLabels = $voteData->pluck('candidate_name')->toArray();
        $chartData = $voteData->pluck('vote_count')->toArray();
        $chartColors = $voteData->map(function($item) {
            // Assign colors based on party or default
            return $item->party_name ? 
                ($item->party_name == 'Party 1' ? '#3b82f6' : '#ef4444') : 
                '#6b7280';
        })->toArray();

        return view('admin.dashboard', compact('voteData', 'positionData', 'chartLabels', 'chartData', 'chartColors'));
    }
}