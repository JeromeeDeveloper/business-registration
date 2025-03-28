<?php

namespace App\Observers;

use App\Models\Cooperative;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use App\Models\Participant;

class UpdateCooperativeObserver
{
    /**
     * Handle the Cooperative "updated" event.
     *
     * @param  \App\Models\Cooperative  $cooperative
     * @return void
     */
    public function updated(Cooperative $cooperative): void
    {
        $this->updateGARegistrationStatus($cooperative->coop_id);
    }

    public function created(Cooperative $cooperative): void
    {
        $this->updateGARegistrationStatus($cooperative->coop_id);
    }

    /**
     * Handle the Participant "created" event.
     *
     * @param  \App\Models\Participant  $participant
     * @return void
     */
    // public function created(Cooperative $cooperative): void
    // {
    //     $this->updateGARegistrationStatus($cooperative->coop_id);
    // }


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

        // Get or create the GA Registration record
        $gaRegistration = GARegistration::updateOrCreate(
            ['coop_id' => $coop_id],
            ['participant_id' => null]
        );

        // Define the required documents
        $requiredDocuments = [
            'Financial Statement',
            'Resolution for Voting delegates',
            'Deposit Slip for Registration Fee',
            'Deposit Slip for CETF Remittance',
            'CETF Undertaking',
            'Certificate of Candidacy',
            'CETF Utilization invoice'
        ];

        // Count the approved documents
        $approvedDocumentsCount = UploadedDocument::where('coop_id', $coop_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Approved')
            ->count();

        // Check if any required document has been rejected
        $hasRejectedDocument = UploadedDocument::where('coop_id', $coop_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Rejected')
            ->exists();

        // Check if payment is sufficient
        $isPaymentSufficient = !is_null($coop->less_prereg_payment) &&
            $coop->less_prereg_payment >= $coop->net_required_reg_fee;

        // Check if a participant exists
        $hasParticipant = Participant::where('coop_id', $coop_id)->count() > 0;

        // Determine registration status based on conditions
        if (!$hasRejectedDocument && ($approvedDocumentsCount === count($requiredDocuments) || $isPaymentSufficient)) {
            $gaRegistration->registration_status = 'Fully Registered';
        } elseif ($hasParticipant) {
            $gaRegistration->registration_status = 'Partial Registered';
        } else {
            $gaRegistration->registration_status = 'Rejected';
        }

        // Save the updated GA Registration status
        $gaRegistration->save();
    }

    /**
     * Update GA Registration status for all cooperatives.
     *
     * @return void
     */
    public function updateAllCooperativesGARegistrationStatus()
    {
        $cooperatives = Cooperative::all();

        foreach ($cooperatives as $cooperative) {
            $this->updateGARegistrationStatus($cooperative->coop_id);
        }
    }
}
