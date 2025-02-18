<?php

namespace App\Mail;

use App\Models\Cooperative;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CooperativeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $coop;
    public $event;

    /**
     * Create a new message instance.
     *
     * @param Cooperative $coop
     * @param Event $event
     */
    public function __construct(Cooperative $coop, Event $event)
    {
        $this->coop = $coop;
        $this->event = $event;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cooperative Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.cooperative_notify',
        );
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
