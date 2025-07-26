<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use App\Services\WhatsappService;
use Illuminate\Http\Request;

class VoterWhatsappController extends Controller
{
    public function sendToSingle($id)
    {
        $voter = Voter::findOrFail($id);

        if (!$voter->phone) {
            return response()->json([
                'status' => false,
                'message' => 'Voter tidak memiliki nomor WhatsApp.'
            ], 400);
        }
        // Prepare the message
        $message = "Halo {$voter->name},\n";
        // Send WhatsApp message logic here
        app(WhatsappService::class)->sendFromVoter($voter, $voter->phone, $message);

        return response()->json([
            'status' => true,
            'message' => 'Pesan WhatsApp berhasil dikirim.'
        ]);
    }
}
