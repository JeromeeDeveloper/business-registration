<?php

namespace App\Exports;

use App\Models\Cooperative;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

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
            '# OF DELEGATE',
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
            'MSP Officer Fee',
            '1/2 CETF',
            'Free 4500',
            'CHARGE TO CETF',
            'CASH PAID REGFEE',
            'PAYABLE',
            'Remarks'
        ];
    }

    public function map($coop): array
    {
        // Count participants
        $participantCount = $coop->participants()->count() ?? 0;

        // Check for MSP Officer Fee
        $hasMspOfficer = $coop->participants()->where('is_msp_officer', 1)->exists();
        $mspOfficerFee = $hasMspOfficer ? 4500 : 0;

        // Calculate half CETF
        $halfCetf = ($coop->cetf_remittance >= 50000) ? 4500 / 2 : 0;

        // Calculate Free 4500
        $free4500 = ($coop->cetf_remittance >= 100000) ? 4500 : 0;

        // Calculate No. of Entitled Votes based on Share Capital Balance
        $shareCapitalBalance = $coop->share_capital_balance;
        $votes = 0;
        $remaining = $shareCapitalBalance;

        while ($remaining >= 25000) {
            if ($remaining >= 75000) {
                $votes += 3;
                $remaining -= 75000;
            } elseif ($remaining >= 50000) {
                $votes += 2;
                $remaining -= 50000;
            } elseif ($remaining >= 25000) {
                $votes += 1;
                $remaining -= 25000;
            }
        }

        // Cap the votes at 5
        $entitledVotes = min($votes, 5);

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
            $entitledVotes, // Calculated No. of Entitled Votes
            $mspOfficerFee,
            $halfCetf,
            $free4500,
            $coop->less_cetf_balance,
            $coop->less_prereg_payment,
            $coop->reg_fee_payable,
            $coop->ga_remark
        ];
    }

}
