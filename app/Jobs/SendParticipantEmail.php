<?php

namespace App\Jobs;

use App\Mail\ParticipantCreated;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendParticipantEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; // Retry up to 3 times
    public $backoff = 5; // 5 seconds between retries

    protected $user;
    protected $password;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new ParticipantCreated($this->user, $this->password));
    }

    public function failed(\Throwable $exception)
    {
        // Optionally notify you (Slack, email, log, etc.)
        \Log::error("Email job failed for {$this->user->email}: {$exception->getMessage()}");
    }
}

