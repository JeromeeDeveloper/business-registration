<?php

namespace App\Exports;

use App\Models\Cooperative;
use App\Models\GARegistration;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CoopRegistrationExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Cooperative::all();
    }

    public function headings(): array
    {
        return [
            'Cooperative Name',
            'CETF',
            'No. of Delegates',
            'Region',
            'Total Asset',
            'Loan Balance',
            'Total Overdue',
            'Time Deposit',
            'Savings',
            'Delinquent',
            'CETF Remittance',
            'CETF Required',
            'Share Capital Balance',
            'No. of Entitled Votes',
            'Free for MSP Officer',
            'Free 2 pax for MIGS',
            'Free half for 1/2 CETF',
            'Free pax for every 100k CETF',
            'Less CETF Balance',
            'Less Pre-reg payment',
            'Regristration Fee payable',
            'Remarks'
        ];
    }

    public function map($coop): array
    {
        // Count participants
        $participantCount = $coop->participants()->count() ?? 0;

        // Check for MSP Officer Fee

        $mspOfficerFee = $coop->free_migs_pax ? $coop->free_migs_pax * 4500 : 0;

        // Calculate half CETF, but only if CETF remittance is less than 100,000
        $halfCetf = ($coop->cetf_remittance < 100000 && $coop->cetf_remittance >= 50000) ? 4500 / 2 : 0;

        // Calculate Free 4500
        $free4500 = floor($coop->cetf_remittance / 100000) * 4500;

        $shareCapitalBalance = $coop->share_capital_balance;

        // Start by calculating votes for each ₱100,000 block
        $votes = floor($shareCapitalBalance / 100000);

        // Handle any remaining amount after full ₱100,000 blocks
        $remaining = $shareCapitalBalance % 100000;

        // If there's any remaining amount greater than or equal to ₱25,000, add 1 vote
        if ($remaining >= 25000) {
            $votes += 1;
        }

        // Cap the votes at 5
        $entitledVotes = min($votes, 5);

        $migsCount = GARegistration::where('coop_id', $coop->coop_id)
        ->where('membership_status', 'Migs')
        ->count();

        $migsStatusValue = $migsCount > 0 ? 9000 : 0;

        // Return mapped data
        return [
            $coop->name,
            $coop->cetf_balance,
            $participantCount,
            $coop->region,
            $coop->total_asset,
            $coop->loan_balance,
            $coop->total_overdue,
            $coop->time_deposit,
            $coop->savings,
            $coop->delinquent,
            $coop->cetf_remittance,
            $coop->cetf_required,
            $coop->share_capital_balance,
            $entitledVotes,
            $mspOfficerFee,
            $migsStatusValue,
            $halfCetf,
            $free4500,
            $coop->less_cetf_balance,
            $coop->less_prereg_payment,
            $coop->reg_fee_payable,
            $coop->ga_remark
        ];
    }
}
