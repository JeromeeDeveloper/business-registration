<?php

namespace App\Observers;

use App\Models\GARegistration;
use App\Models\Cooperative;
use App\Models\Participant;

class GARegistrationObserver
{
    public function updated(GARegistration $gaRegistration): void
    {
        // Check if membership_status was changed
        if ($gaRegistration->wasChanged('membership_status')) {
            $this->recalculateCooperativeFeesAfterMigsChange($gaRegistration->coop_id);
        }
    }

    private function recalculateCooperativeFeesAfterMigsChange($coop_id): void
    {
        $cooperative = Cooperative::where('coop_id', $coop_id)->first();

        if ($cooperative) {
            $registrationFee = 4500;
            $totalParticipants = Participant::where('coop_id', $cooperative->coop_id)->count();

            $freeAmount = 0;
            $cetfRemittance = $cooperative->cetf_remittance ?? 0;

            // MIGS check
            $migsCount = GARegistration::where('coop_id', $cooperative->coop_id)
                ->where('membership_status', 'Migs')
                ->count();

            if ($migsCount >= 1) {
                $freeAmount += 9000;
            }

            // Free per 100k remittance
            $free100kCount = floor($cetfRemittance / 100000);
            $freeAmount += $free100kCount * 4500;

            // Half CETF logic
            if ($cooperative->half_based_cetf && $cetfRemittance >= 50000 && $cetfRemittance < 100000) {
                $freeAmount += 2250;
            }

            $totalRegFee = $totalParticipants * $registrationFee;
            $netRequiredRegFee = $totalRegFee - $freeAmount;

            // New reg_fee_payable calculation
            $regFeePayable = $netRequiredRegFee;
            $regFeePayable -= ($cooperative->less_prereg_payment ?? 0);
            $regFeePayable -= ($cooperative->less_cetf_balance ?? 0);

            // Save updates
            $cooperative->total_reg_fee = $totalRegFee;
            $cooperative->net_required_reg_fee = $netRequiredRegFee;
            $cooperative->reg_fee_payable = $regFeePayable;
            $cooperative->save();
        }
    }
}