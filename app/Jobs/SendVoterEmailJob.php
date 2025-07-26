<?php

namespace App\Jobs;

use App\Models\Voter;
use App\Mail\VoterCodeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVoterEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $voter;

    public function __construct(Voter $voter)
    {
        $this->voter = $voter;
    }

    public function handle()
    {
        if (!$this->voter->email || $this->voter->email_sent_at) {
            return; // skip jika sudah terkirim atau tidak ada email
        }

        Mail::to($this->voter->email)->send(new VoterCodeMail($this->voter));

        // update status terkirim
        $this->voter->email_sent_at = now();
        $this->voter->save();
    }
}

