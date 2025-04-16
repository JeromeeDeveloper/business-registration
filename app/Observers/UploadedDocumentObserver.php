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
        $netrequired = !is_null($coop->net_required_reg_fee) && $coop->net_required_reg_fee != 0;

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

    private function updateMembershipStatus($cooperative_id)
    {
        $cooperative = Cooperative::find($cooperative_id)->fresh();
        if (!$cooperative) return;

        // Get or create the GA Registration record
        $gaRegistration = GARegistration::updateOrCreate(
            ['coop_id' => $cooperative_id],
            ['participant_id' => null]
        );

        // Decode and check if services_availed has actual values
        $decodedServices = json_decode($cooperative->services_availed, true);
        $hasServicesAvailed = is_array($decodedServices) && count($decodedServices) > 0;

        // Define the required documents
        $requiredDocuments = [
            'Financial Statement',
            'Resolution for Voting delegates',
        ];

        // Count the approved documents
        $approvedDocumentsCount = UploadedDocument::where('coop_id', $cooperative_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Approved')
            ->count();

        // Check if all required documents are approved
        $allDocumentsApproved = $approvedDocumentsCount === count($requiredDocuments);

        // Determine membership status based on conditions
        if (
            $cooperative->delinquent === 'no' &&
            $hasServicesAvailed &&
            $cooperative->share_capital_balance >= 25000 &&
            $cooperative->cetf_balance <= 0 &&
            !is_null($cooperative->cetf_remittance) &&
            $cooperative->cetf_required > 0 && // Ensure CETF Required is not 0
            $allDocumentsApproved
        ) {
            $gaRegistration->membership_status = 'Migs';
        } else {
            $gaRegistration->membership_status = 'Non-migs';
        }


        // Save the updated GA Registration status
        $gaRegistration->save();
    }



}
