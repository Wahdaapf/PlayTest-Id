<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;
    public string $userName;

    /**
     * Create a new message instance.
     */
    public function __construct(string $url, string $userName = '')
    {
        $this->url      = $url;
        $this->userName = $userName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Email Address — PlayTest ID',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.auth.verify-email',
            with: [
                'url'      => $this->url,
                'userName' => $this->userName,
            ],
        );
    }
}