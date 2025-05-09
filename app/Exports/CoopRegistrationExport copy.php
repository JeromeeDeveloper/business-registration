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
        $registeredCoopIds = GARegistration::whereIn('registration_status', ['Fully Registered', 'Partial Registered'])
            ->whereNotNull('coop_id')
            ->pluck('coop_id')
            ->unique();

        // Eager load users to avoid N+1 queries
        return Cooperative::with('users')
            ->whereIn('coop_id', $registeredCoopIds)
            ->get();
    }

    public function headings(): array
    {
        return [
            'CID (user_id)',
            'login_id (email)',
            'first_name (first half of coop name)',
            'last_name (last half of coop name)',
            'full_name (Cooperative Name)',
            'Region',
        ];
    }

    public function map($coop): array
    {


        // Split cooperative name into first and last half
        $nameParts = explode(' ', $coop->name);
        $half = ceil(count($nameParts) / 2);
        $firstName = implode(' ', array_slice($nameParts, 0, $half));
        $lastName = implode(' ', array_slice($nameParts, $half));

        return [
            $coop->coop_identification_no,
            $coop->email,
            $firstName,
            $lastName,
            $coop->name,
            $coop->region,
        ];
    }
}
