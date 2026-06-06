<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectText;
    public string $title;
    public string $messageText;
    public string $buttonText;
    public string $buttonUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subjectText, string $title, string $messageText, string $buttonText = '', string $buttonUrl = '')
    {
        $this->subjectText = $subjectText;
        $this->title       = $title;
        $this->messageText = $messageText;
        $this->buttonText  = $buttonText;
        $this->buttonUrl   = $buttonUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.notification',
            with: [
                'subject'     => $this->subjectText,
                'title'       => $this->title,
                'messageText' => $this->messageText,
                'buttonText'  => $this->buttonText,
                'buttonUrl'   => $this->buttonUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}