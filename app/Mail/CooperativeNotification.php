<?php

namespace App\Mail;

use App\Models\Cooperative;
use App\Models\Event;
use App\Models\GARegistration;
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
    public $gaRegistration;
    public $users; // Add users property

    /**
     * Create a new message instance.
     */
    public function __construct(Cooperative $coop, Event $event, ?GARegistration $gaRegistration, $users)
    {
        $this->coop = $coop;
        $this->event = $event;
        $this->gaRegistration = $gaRegistration;
        $this->users = $users;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '2025 MASS-SPECC CO-OPVENTION REGISTRATION NOTICE',
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
     */
    public function attachments(): array
    {
        return [];
    }
}

