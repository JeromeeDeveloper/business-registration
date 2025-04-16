<?php

namespace App\Observers;

use App\Models\Cooperative;
use App\Models\Participant;
use App\Models\GARegistration;
use App\Models\UploadedDocument;

class CooperativeObserver
{
    /**
     * Handle the Participant "created" event.
     *
     * @param  \App\Models\Participant  $participant
     * @return void
     */
    public function created(Cooperative $cooperative): void
{
    $this->updateMembershipStatus($cooperative->coop_id);
}


    /**
     * Handle the Cooperative "updated" event.
     *
     * @param  \App\Models\Cooperative  $cooperative
     * @return void
     */
    public function updated(Cooperative $cooperative): void
    {
        $this->updateMembershipStatus($cooperative->coop_id);
    }


    /**
     * Update the membership status of the cooperative.
     *
     * @param  int  $cooperative_id
     * @return void
     */
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

    /**
     * Update membership status for all cooperatives.
     *
     * @return void
     */
    public function updateAllCooperativesMembershipStatus()
    {
        $cooperatives = Cooperative::all();

        foreach ($cooperatives as $cooperative) {
            $this->updateMembershipStatus($cooperative->coop_id);
        }
    }
}
