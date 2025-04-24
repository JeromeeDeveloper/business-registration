<?php
namespace App\Observers;

use App\Models\Cooperative;
use App\Traits\StatusUpdateTrait;

class CooperativeObserver
{
    use StatusUpdateTrait;

    public function created(Cooperative $cooperative): void
    {
        $this->updateMembershipStatus($cooperative->coop_id);
        $this->updateGARegistrationStatus($cooperative->coop_id);
    }

    public function updated(Cooperative $cooperative): void
    {
        $this->updateMembershipStatus($cooperative->coop_id);
        $this->updateGARegistrationStatus($cooperative->coop_id);
    }
}

