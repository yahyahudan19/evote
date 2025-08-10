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
                ->delay(now()->addSeconds($index * 10));
            
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
            return "Yth. {$voter->name}\n\n🌟 Salam sehat dan harmonis,\n\n📌 Pemilihan Ketua Umum IKAMARS FKM UI akan dibuka dalam 3 hari lagi. Kami menyarankan Bapak/Ibu untuk memberikan suara pada waktu yang telah disarankan untuk menghindari tingginya beban sistem.\n\n🗓 Waktu yang Disarankan: $start_vote s/d $end_vote WIB\n🗓 Periode Voting: $start s/d $end WIB\n\nCatatan:\n1. Pesan ini dikirim secara otomatis oleh sistem. Mohon untuk tidak membalas pesan ini.\n2. Zona Waktu yang digunakan adalah Waktu Indonesia bagian barat.\n3. Kode Verifikasi dapat di lihat melalui email masuk/spam.\n4. Pemungutan suara di luar waktu yang disarankan, masih dapat dilakukan vote dan akan tetap dihitung sebagai suara sah selama periode voting masih tersedia.\n\nHormat kami,\nPanitia Munas VI IKAMARS FKM UI\n📧 Email: ikamars.fkmui@gmail.com\n\nNarahubung:\nYuyun +62 817-737-444\nSafar +62 811-8868-708";
            case 'h-1':
            return "Yth. {$voter->name}\n\n🌟 Salam sehat dan harmonis,\n\n📌 Pemilihan Ketua Umum IKAMARS FKM UI akan dimulai besok. Kami menyarankan Bapak/Ibu untuk memberikan suara pada waktu yang telah disarankan untuk menghindari tingginya beban sistem.\n\n🗓 Waktu yang Disarankan: $start_vote s/d $end_vote WIB\n🗓 Periode Voting: $start s/d $end WIB\n\nCatatan:\n1. Pesan ini dikirim secara otomatis oleh sistem. Mohon untuk tidak membalas pesan ini.\n2. Zona Waktu yang digunakan adalah Waktu Indonesia bagian barat.\n3. Kode Verifikasi dapat di lihat melalui email masuk/spam.\n4. Pemungutan suara di luar waktu yang disarankan, masih dapat dilakukan vote dan akan tetap dihitung sebagai suara sah selama periode voting masih tersedia.\n\nHormat kami,\nPanitia Munas VI IKAMARS FKM UI\n📧 Email: ikamars.fkmui@gmail.com\n\nNarahubung:\nYuyun +62 817-737-444\nSafar +62 811-8868-708";
            case 'hari-h':
            return "Yth. {$voter->name}\n\n🌟 Salam sehat dan harmonis,\n\n📌 Pemilihan Ketua Umum IKAMARS FKM UI telah resmi dibuka hari ini. Kami menyarankan Bapak/Ibu untuk memberikan suara pada waktu yang telah disarankan untuk menghindari tingginya beban sistem.\n\n🗓 Waktu yang Disarankan: $start_vote s/d $end_vote WIB\n🗓 Periode Voting: $start s/d $end WIB\n\nCatatan:\n1. Pesan ini dikirim secara otomatis oleh sistem. Mohon untuk tidak membalas pesan ini.\n2. Zona Waktu yang digunakan adalah Waktu Indonesia bagian barat.\n3. Kode Verifikasi dapat di lihat melalui email masuk/spam.\n4. Pemungutan suara di luar waktu yang disarankan, masih dapat dilakukan vote dan akan tetap dihitung sebagai suara sah selama periode voting masih tersedia.\n5. Waktu pemungutan suara diperpanjang dari 15.00 WIB menjadi 16.00 WIB\n\nHormat kami,\nPanitia Munas VI IKAMARS FKM UI\n📧 Email: ikamars.fkmui@gmail.com\n\nNarahubung:\nYuyun +62 817-737-444\nSafar +62 811-8868-708";
            case 'belum-vote':
            return "Yth. {$voter->name}\n\n🌟 Salam sehat dan harmonis,\n\n📌 Kami melihat bahwa Bapak/Ibu belum memberikan suara dalam Pemilihan Ketua Umum IKAMARS FKM UI. Jangan lewatkan kesempatan ini! Kami menyarankan Bapak/Ibu untuk memberikan suara pada waktu yang telah disarankan untuk menghindari tingginya beban sistem.\n🗓 Waktu yang Disarankan: $start_vote s/d $end_vote\n🗓 Periode Voting: $start s/d $end WIB\n\nCatatan:\n1. Pesan ini dikirim secara otomatis oleh sistem. Mohon untuk tidak membalas pesan ini.\n2. Zona Waktu yang digunakan adalah Waktu Indonesia bagian barat.\n3. Kode Verifikasi dapat di lihat melalui email masuk/spam.\n4. Pemungutan suara di luar waktu yang disarankan, masih dapat dilakukan vote dan akan tetap dihitung sebagai suara sah selama periode voting masih tersedia.\n5. Waktu pemungutan suara diperpanjang dari 15.00 WIB menjadi 16.00 WIB\n\nHormat kami,\nPanitia Munas VI IKAMARS FKM UI\n📧 Email: ikamars.fkmui@gmail.com\n\nNarahubung:\nYuyun +62 817-737-444\nSafar +62 811-8868-708";
            default:
            return null;
        }
    }
}
