<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\Voter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $candidates = Candidate::withCount('votes')->orderBy('candidate_number')->get();
        $election = Election::first(); // Get the first election data (if exists)

        // Total votes from users who have voted
        $totalVoted = Voter::where('status', 'voted')->count();

        // Prepare labels for the chart
        $labels = $candidates->map(function ($c) {
            return "No. {$c->candidate_number} - {$c->ketua_name} & {$c->wakil_name}";
        });

        // Prepare series data for votes and percentages
        $series = $candidates->map(function ($c) use ($totalVoted) {
            $votesCount = $c->votes_count;
            $percentage = $totalVoted > 0 ? ($votesCount / $totalVoted) * 100 : 0; // Calculate percentage based on total votes
            return [
                'votes' => $votesCount,
                'percentage' => $percentage
            ];
        });

        // Count voters that have and haven't voted
        $votersNotVoted = Voter::where('status', 'not_voted')->count();
        $votersVoted = Voter::where('status', 'voted')->count();

        // Pass the data to the view
        return view('dashboard', compact('labels', 'series', 'votersNotVoted', 'votersVoted', 'election','totalVoted'));
    }



}

