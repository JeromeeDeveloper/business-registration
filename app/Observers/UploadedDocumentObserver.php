<?php

namespace App\Observers;

use App\Models\Cooperative;
use App\Models\Participant;
use App\Models\GARegistration;
use App\Models\UploadedDocument;

class UploadedDocumentObserver
{
    /**
     * Handle events for UploadedDocument model.
     */
    public function created(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        // $this->updateMembershipStatus($uploadedDocument->coop_id);
    }
    public function updated(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        // $this->updateMembershipStatus($uploadedDocument->coop_id);
    }
    public function deleted(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        // $this->updateMembershipStatus($uploadedDocument->coop_id);
    }
    public function restored(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        // $this->updateMembershipStatus($uploadedDocument->coop_id);
    }
    public function forceDeleted(UploadedDocument $uploadedDocument): void
    {
        $this->updateGARegistrationStatus($uploadedDocument->coop_id);
        // $this->updateMembershipStatus($uploadedDocument->coop_id);
    }

    /**
     * Update GA Registration Status based on uploaded documents and cooperative details.
     */
    private function updateGARegistrationStatus($coop_id)
    {
        $coop = Cooperative::find($coop_id)->fresh();
        if (!$coop) return;

        $gaRegistration = GARegistration::updateOrCreate(
            ['coop_id' => $coop_id],
            ['participant_id' => null]
        );

        $requiredDocuments = [
            'Financial Statement',
            'Resolution for Voting delegates',
            'Deposit Slip for Registration Fee',
            'Deposit Slip for CETF Remittance',
            'CETF Undertaking',
            'Certificate of Candidacy',
            'CETF Utilization invoice'
        ];

        $approvedDocumentsCount = UploadedDocument::where('coop_id', $coop_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Approved')
            ->count();

        $hasRejectedDocument = UploadedDocument::where('coop_id', $coop_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Rejected')
            ->exists();

        $isPaymentSufficient = !is_null($coop->less_prereg_payment) &&
            $coop->less_prereg_payment >= $coop->net_required_reg_fee;

            $hasParticipant = Participant::where('coop_id', $coop_id)->count() > 0;

            if (!$hasRejectedDocument && ($approvedDocumentsCount === count($requiredDocuments) || $isPaymentSufficient)) {
                $gaRegistration->registration_status = 'Fully Registered';
            } elseif ($hasParticipant) {
                $gaRegistration->registration_status = 'Partial Registered';
            } else {
                $gaRegistration->registration_status = 'Rejected';
            }


        $gaRegistration->save();
        \Log::info("GA Registration Status Updated: Coop ID $coop_id, Status: {$gaRegistration->registration_status}");
    }

}
