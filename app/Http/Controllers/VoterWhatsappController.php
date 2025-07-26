<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsappReminder;
use App\Models\Election;
use App\Models\Log;
use App\Models\Vote;
use App\Models\Voter;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VoterWhatsappController extends Controller
{
    public function sendToSingle($id)
    {
        $voter = Voter::findOrFail($id);

        if (!$voter->phone) {
            return response()->json([
                'status' => false,
                'message' => 'Voter does not have a WhatsApp number.'
            ], 400);
        }
        // Prepare the message
        $message = "Hello {$voter->name},\n";
        // Send WhatsApp message logic here
        app(WhatsappService::class)->sendFromVoter($voter, $voter->phone, $message);

        return response()->json([
            'status' => true,
            'message' => 'WhatsApp message sent successfully.'
        ]);
    }

    public function sendBulkReminder(Request $request)
    {
        
        $type = $request->query('type');
        $election = Election::first(); // sesuaikan jika multi-election
        
        if (!$election) {
            return response()->json(['message' => 'Election Not Found'], 404);
        }
        
        if ($type === 'belum-vote') {
            $voters = Voter::doesntHave('votes')->get();
        } else {
            $voters = Voter::get();
        }

        foreach ($voters as $index => $voter) {
            $message = $this->generateMessage($type, $voter, $election);
            if (!$message) continue;

            // antrikan ke queue
            SendWhatsappReminder::dispatch($voter, $message)
                ->delay(now()->addSeconds($index * 5));
            
        }

        return response()->json(['message' => "Messages will be sent to Voters."]);
    }

    protected function generateMessage($type, $voter, $election)
    {
        $start = $election->start_time->format('d M Y H:i');
        $end = $election->end_time->format('d M Y H:i');
        
        $start_vote = Carbon::parse($voter->vote_start_time)->format('d M Y H:i');
        $end_vote   = Carbon::parse($voter->vote_end_time)->format('d M Y H:i');

        switch ($type) {
            case 'h-3':
            return "📢 *Dear {$voter->name}*\n\n🌟 *Hello!*\n\n📌 *The ILUNI FKM UI 2025–2028 election will open in 3 days.* We recommend casting your vote during the suggested time to avoid high system load.\n\n🗓️ *Suggested Time:* $start_vote to $end_vote\n🗓️ *Voting Period:* $start to $end\n\n🌐 *Election Website:* https://e-vote.ynemedia.biz.id/\n\n🙏 *Best regards,*\n*Election Committee*";
            case 'h-1':
            return "📢 *Dear {$voter->name}*\n\n⏳ *Tomorrow is the ILUNI FKM UI 2025–2028 election day.* Exercise your right to vote and choose a leader with integrity. We recommend casting your vote during the suggested time to avoid high system load.\n\n🗓️ *Suggested Time:* $start_vote to $end_vote\n🗓️ *Voting Period:* $start to $end\n\n🌐 *Election Website:* https://e-vote.ynemedia.biz.id/\n\n🙏 *Best regards,*\n*Election Committee*";
            case 'hari-h':
            return "📢 *Dear {$voter->name}*\n\n🎉 *The ILUNI FKM UI 2025–2028 election is officially open today.* Please cast your vote before the voting period ends. We recommend casting your vote during the suggested time to avoid high system load.\n\n🗓️ *Suggested Time:* $start_vote to $end_vote\n⏰ *Ends At:* $end\n\n🌐 *Election Website:* https://e-vote.ynemedia.biz.id/\n\n🙏 *Best regards,*\n*Election Committee*";
            case 'belum-vote':
            return "📢 *Dear {$voter->name}*\n\n❗ *We noticed that you have not yet cast your vote in the ILUNI FKM UI 2025–2028 election.* Don't miss this opportunity! We recommend casting your vote during the suggested time to avoid high system load.\n\n🗓️ *Suggested Time:* $start_vote to $end_vote\n🗓️ *Voting Period:* $start to $end\n\n🌐 *Election Website:* https://e-vote.ynemedia.biz.id/\n\n🙏 *Best regards,*\n*Election Committee*";
            default:
            return null;
        }
    }
}
