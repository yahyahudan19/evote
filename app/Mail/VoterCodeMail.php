<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoterCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voter;

    /**
     * Create a new message instance.
     */
    public function __construct($voter)
    {
        $this->voter = $voter;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Voter Verification Code',
        );
    }

    public function build()
    {
        return $this->subject('Your Voter Verification Code')
            ->view('apps.mail')
            ->with([
                'voterName' => $this->voter->name,
                'verificationCode' => $this->voter->code,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
