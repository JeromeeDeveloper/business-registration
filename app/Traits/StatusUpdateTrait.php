<?php

namespace App\Traits;

use App\Models\Cooperative;
use App\Models\GARegistration;
use App\Models\Participant;
use App\Models\UploadedDocument;

trait StatusUpdateTrait
{
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

        $gaRegistration = GARegistration::updateOrCreate(
            ['coop_id' => $cooperative_id],
            ['participant_id' => null]
        );

        $decodedServices = json_decode($cooperative->services_availed, true);
        $hasServicesAvailed = is_array($decodedServices) && count($decodedServices) > 0;

        $requiredDocuments = ['Financial Statement'];
        $approvedDocumentsCount = UploadedDocument::where('coop_id', $cooperative_id)
            ->whereIn('document_type', $requiredDocuments)
            ->where('status', 'Approved')
            ->count();

        $allDocumentsApproved = $approvedDocumentsCount === count($requiredDocuments);

        if (
            $cooperative->delinquent === 'no' &&
            $hasServicesAvailed &&
            $cooperative->share_capital_balance >= 25000 &&
            $cooperative->cetf_balance <= 0 &&
            !is_null($cooperative->cetf_remittance) &&
            $cooperative->cetf_required > 0 &&
            $allDocumentsApproved
        ) {
            $gaRegistration->membership_status = 'Migs';
        } else {
            $gaRegistration->membership_status = 'Non-migs';
        }

        $gaRegistration->save();
    }
}