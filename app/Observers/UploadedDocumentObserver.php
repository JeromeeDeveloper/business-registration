<?php

namespace App\Observers;

use App\Models\Cooperative;
use App\Models\Participant;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use App\Traits\StatusUpdateTrait;

class UploadedDocumentObserver
{
    use StatusUpdateTrait;

    public function created(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        $this->updateMembershipStatus($uploadedDocument->coop_id);
    }

    public function updated(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        $this->updateMembershipStatus($uploadedDocument->coop_id);
    }

    public function deleted(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        $this->updateMembershipStatus($uploadedDocument->coop_id);
    }

    public function restored(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        $this->updateMembershipStatus($uploadedDocument->coop_id);
    }

    public function forceDeleted(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        $this->updateMembershipStatus($uploadedDocument->coop_id);
    }
}

