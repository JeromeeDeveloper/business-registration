<?php

namespace App\Mail;

use App\Models\Cooperative;
use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CooperativeNotificationCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $coop;
    public $event;
    public $users; // Add users property

    /**
     * Create a new message instance.
     *
     * @param Cooperative $coop
     * @param Event $event
     * @param array $users
     */
    public function __construct(Cooperative $coop, Event $event, $users)
    {
        $this->coop = $coop;
        $this->event = $event;
        $this->users = $users; 
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
            view: 'emails.cooperative_credentials',
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
