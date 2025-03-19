<?php

namespace App\Observers;

use App\Models\Cooperative;
use App\Models\Participant;
use App\Models\GARegistration;

class CooperativeObserver
{
    /**
     * Handle the Participant "created" event.
     *
     * @param  \App\Models\Participant  $participant
     * @return void
     */
    public function created(Participant $participant): void
    {
        $this->updateMembershipStatus($participant->coop_id);
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
        $gaRegistration2 = GARegistration::firstOrCreate(
            ['coop_id' => $cooperative_id],
            ['participant_id' => null]
        );

        // Decode and check if services_availed has actual values
        $decodedServices = json_decode($cooperative->services_availed, true);
        $hasServicesAvailed = is_array($decodedServices) && count($decodedServices) > 0;

        // Determine membership status based on conditions
        if (
            $cooperative->delinquent === 'no' &&
            $hasServicesAvailed &&
            $cooperative->share_capital_balance >= 25000 &&
            $cooperative->cetf_balance <= 0 &&
            !is_null($cooperative->cetf_remittance)
        ) {
            $gaRegistration2->membership_status = 'Migs';
        } else {
            $gaRegistration2->membership_status = 'Non-migs';
        }

        // Save the updated GA Registration status
        $gaRegistration2->save();
    }
}
