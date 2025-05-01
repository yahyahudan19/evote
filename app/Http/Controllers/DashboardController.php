<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Voter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $candidates = Candidate::withCount('votes')->orderBy('candidate_number')->get();

        $labels = $candidates->map(function ($c) {
            return "No. {$c->candidate_number} - {$c->ketua_name} & {$c->wakil_name}";
        });

        $series = $candidates->map->votes_count;

        $votersNotVoted = Voter::where('status', 'not_voted')->count();
        $votersVoted = Voter::where('status', 'voted')->count();

        return view('dashboard', compact('labels', 'series','votersNotVoted', 'votersVoted'));
    }
}

