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
                'message' => 'Voter tidak memiliki email.'
            ], 400);
        }

        try {
            Mail::to($voter->email)->send(new VoterCodeMail($voter));
            // Update the email_sent_at timestamp
            $voter->email_sent_at = now();
            $voter->save();

            return response()->json([
                'status' => true,
                'message' => "Email berhasil dikirim ke {$voter->email}"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengirim email: ' . $e->getMessage()
            ], 500);
        }
    }
    public function sendBulk()
    {
        $query = Voter::whereNull('email_sent_at')
            ->whereNotNull('email');

        $totalHariIni = Voter::whereDate('email_sent_at', now()->toDateString())->count();

        $limitHarian = 300;
        $sisaQuota = max(0, $limitHarian - $totalHariIni);

        if ($sisaQuota <= 0) {
            return response()->json([
                'status' => false,
                'message' => 'Quota pengiriman email hari ini sudah habis.'
            ], 429);
        }

        $voters = $query->limit($sisaQuota)->get();

        // Delay awal
        $delay = 0;

        foreach ($voters as $voter) {
            // Tambahkan delay 10 detik per job
            SendVoterEmailJob::dispatch($voter)->delay(now()->addSeconds($delay));
            $delay += 10;
        }

        return response()->json([
            'status' => true,
            'message' => "Job pengiriman email untuk {$voters->count()} voter sudah dimasukkan ke queue (10 detik jeda antar email)."
        ]);
    }
    
    public function bulkInfo()
    {
        $limitHarian = 300;

        $totalHariIni = Voter::whereDate('email_sent_at', now()->toDateString())->count();
        $sisaQuota = max(0, $limitHarian - $totalHariIni);

        $countTarget = Voter::whereNull('email_sent_at')
            ->whereNotNull('email')
            ->limit($sisaQuota)
            ->count();

        return response()->json([
            'status' => true,
            'sisa_quota' => $sisaQuota,
            'target' => $countTarget
        ]);
    }

}


