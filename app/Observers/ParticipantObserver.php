<?php

namespace App\Observers;

use App\Models\Participant;
use App\Traits\StatusUpdateTrait;

class ParticipantObserver
{
    use StatusUpdateTrait;

    public function created(Participant $participant): void
    {
        $this->updateGARegistrationStatus($participant->coop_id);
        $this->updateMembershipStatus($participant->coop_id);
    }

    public function updated(Participant $participant): void
    {
        $this->updateGARegistrationStatus($participant->coop_id);
        $this->updateMembershipStatus($participant->coop_id);
    }

    public function deleted(Participant $participant): void
    {
        $this->updateGARegistrationStatus($participant->coop_id);
        $this->updateMembershipStatus($participant->coop_id);
    }

    public function restored(Participant $participant): void
    {
        $this->updateGARegistrationStatus($participant->coop_id);
        $this->updateMembershipStatus($participant->coop_id);
    }
}

