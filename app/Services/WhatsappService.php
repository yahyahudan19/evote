<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Whatsapp;
use App\Models\Voter;

class WhatsappService
{
    protected $config;

    public function __construct()
    {
        $this->config = Whatsapp::first(); // diasumsikan hanya satu konfigurasi aktif
    }

    protected function normalizeNumber($number)
    {
        // Ubah 08xxxx ➝ 628xxxx
        return preg_replace('/^0/', '62', $number);
    }

    public function sendFromVoter(Voter $voter, string $targetNumber, string $message)
    {
        
        if (!$this->config) {
            throw new \Exception('Konfigurasi WhatsApp tidak ditemukan.');
        }

        $number = $this->normalizeNumber($targetNumber);

        $payload = [
            'api_key' => $this->config->api_key,
            'sender'  => $this->config->nomor_whatsapp,
            'number'  => $number,
            'message' => $message,
        ];

        $response = Http::get('https://wagw.yahyahud.my.id/send-message', $payload);

        \Log::info('WA Response', [
            'to' => $number,
            'payload' => $payload,
            'response' => $response->body(),
        ]);

        return $response->json();
    }
}
