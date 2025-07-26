<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemindersController extends Controller
{
    public function index()
    {
        $election = Election::first();
        $voterCount = Voter::count();
        $votersMailSentCount = Voter::whereNotNull('email_sent_at')->count();
        $jobQueueCount = DB::table('jobs')->count();

        $diff = null;
        if ($election && $election->start_time) {
            $diff = now()->startOfDay()->diffInDays(
                $election->start_time->startOfDay(),
                false
            );
        }

        return view('apps.reminders', compact('election', 'diff', 'voterCount', 'votersMailSentCount', 'jobQueueCount'));
    }

    public function datatable(Request $request)
    {
        // Ambil data jobs
        $query = DB::table('jobs')
            ->select('id','queue','attempts','available_at','created_at')
            ->orderByDesc('id');

        return datatables()->of($query)->toJson();
    }
   
}
