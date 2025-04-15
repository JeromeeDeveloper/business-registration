<?php

namespace App\Observers;

use App\Models\Participant;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use App\Models\Cooperative;

class ParticipantObserver
{
    /**
     * Handle the Participant "created" event.
     *
     * @param  \App\Models\Participant  $participant
     * @return void
     */
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

    /**
     * Handle the Participant "deleted" event.
     */
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

    /**
     * Update the GA Registration status based on the cooperative and uploaded documents.
     *
     * @param  int  $coop_id
     * @return void
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

        // Updated logic: Must have participant, all documents approved, and payment sufficient
        if (
            $hasParticipant &&
            !$hasRejectedDocument &&
            $approvedDocumentsCount === count($requiredDocuments) &&
            $isPaymentSufficient
        ) {
            $gaRegistration->registration_status = 'Fully Registered';
        } elseif ($hasParticipant) {
            $gaRegistration->registration_status = 'Partial Registered';
        } else {
            $gaRegistration->registration_status = 'Rejected';
        }

        $gaRegistration->save();
    }

    /**
     * Update the membership status of the cooperative.
     *
     * @param  int  $cooperative_id
     * @return void
     */
    private function updateMembershipStatus($cooperative_id)
    {
        $cooperative = Cooperative::find($cooperative_id);
        if (!$cooperative) {
            \Log::error("Cooperative not found with ID: $cooperative_id");
            return;
        }

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
