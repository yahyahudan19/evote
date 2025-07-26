<?php

namespace App\Http\Controllers;

use App\Jobs\SendVoterEmailJob;
use App\Models\Voter;
use App\Mail\VoterCodeMail;
use Illuminate\Support\Facades\Mail;

class VoterMailController extends Controller
{
    public function sendToSingle($id)
    {
        $voter = Voter::findOrFail($id);

        if (!$voter->email) {
            return response()->json([
                'status' => false,
                'message' => 'Voter does not have an email address.'
            ], 400);
        }

        try {
            Mail::to($voter->email)->send(new VoterCodeMail($voter));
            // Update the email_sent_at timestamp
            $voter->email_sent_at = now();
            $voter->save();

            return response()->json([
                'status' => true,
                'message' => "Email successfully sent to {$voter->email}"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }
    public function sendBulk()
    {
        $query = Voter::whereNull('email_sent_at')
            ->whereNotNull('email');

        $totalToday = Voter::whereDate('email_sent_at', now()->toDateString())->count();

        $dailyLimit = 300;
        $remainingQuota = max(0, $dailyLimit - $totalToday);

        if ($remainingQuota <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Daily email sending quota has been exhausted.'
            ], 429);
        }

        $voters = $query->limit($remainingQuota)->get();

        // Initial delay
        $delay = 0;

        foreach ($voters as $voter) {
            // Add a 10-second delay per job
            SendVoterEmailJob::dispatch($voter)->delay(now()->addSeconds($delay));
            $delay += 10;
        }

        return response()->json([
            'status' => true,
            'message' => "Email sending jobs for {$voters->count()} voters have been queued (10 seconds delay between emails)."
        ]);
    }
    
    public function bulkInfo()
    {
        $dailyLimit = 300;

        $totalToday = Voter::whereDate('email_sent_at', now()->toDateString())->count();
        $remainingQuota = max(0, $dailyLimit - $totalToday);

        $countTarget = Voter::whereNull('email_sent_at')
            ->whereNotNull('email')
            ->limit($remainingQuota)
            ->count();

        return response()->json([
            'status' => true,
            'remaining_quota' => $remainingQuota,
            'target' => $countTarget
        ]);
    }

    public function clearEmailSent()
    {
        Voter::query()->update(['email_sent_at' => null]);

        return response()->json(['status' => 'success']);
    }


}


