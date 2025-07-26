<?php

namespace App\Jobs;

use App\Models\Voter;
use App\Models\Whatsapp;
use App\Services\WhatsappService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsappReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $voter;
    public $message;

    public function __construct(Voter $voter, string $message)
    {
        $this->voter = $voter;
        $this->message = $message;
    }

    public function handle(WhatsappService $wa)
    {
        $wa->sendFromVoter($this->voter, $this->voter->phone, $this->message);
    }
}

