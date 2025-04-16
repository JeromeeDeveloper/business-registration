<?php

namespace App\Observers;

use App\Models\Cooperative;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use App\Models\Participant;

class UpdateCooperativeObserver
{
    public function updated(Cooperative $cooperative): void
    {
        $this->updateGARegistrationStatus($cooperative->coop_id);
    }

    public function created(Cooperative $cooperative): void
    {
        $this->updateGARegistrationStatus($cooperative->coop_id);
    }

    private function updateGARegistrationStatus($coop_id)
    {
        $coop = Cooperative::find($coop_id)->fresh();
        if (!$coop) return;

        $gaRegistration = GARegistration::updateOrCreate(
            ['coop_id' => $coop_id],
            ['participant_id' => null]
        );

        $requiredDocuments = [
            'Financial Statement'
        ];

        $approvedDocumentsCount = UploadedDocument::where('coop_id', $coop_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Approved')
            ->count();

        $hasRejectedDocument = UploadedDocument::where('coop_id', $coop_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Rejected')
            ->exists();

        $hasParticipant = Participant::where('coop_id', $coop_id)->exists();

        $isPaymentSufficient = !is_null($coop->reg_fee_payable) && $coop->reg_fee_payable <= 0;

        $netrequired = !is_null($coop->net_required_reg_fee);
        // Updated logic: Must have participant, all documents approved, and payment sufficient
        if (
            $hasParticipant &&
            !$hasRejectedDocument &&
            $approvedDocumentsCount === count($requiredDocuments) &&
            $isPaymentSufficient &&
            $netrequired
        ) {
            $gaRegistration->registration_status = 'Fully Registered';
        } elseif ($hasParticipant) {
            $gaRegistration->registration_status = 'Partial Registered';
        } else {
            $gaRegistration->registration_status = 'Rejected';
        }

        $gaRegistration->save();
    }


    public function updateAllCooperativesGARegistrationStatus()
    {
        $cooperatives = Cooperative::all();

        foreach ($cooperatives as $cooperative) {
            $this->updateGARegistrationStatus($cooperative->coop_id);
        }
    }
}
