<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Cooperative;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ExcelImportController extends Controller
{
    public function showImportForm()
    {
        return view('import'); // This will load the Blade file resources/views/import.blade.php
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $allowedRegions = [
            'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
            'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
            'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM'
        ];

        foreach (array_slice($rows, 3) as $row) {
            if (empty($row[3])) continue;

            $name = $row[3] ?? null;
            $contactPerson = !empty($row[4]) ? $row[4] : 'N/A';
            $position = $row[5] ?? 'Unknown';
            $phoneNumber = $row[6] ?? 'N/A';
            $barangay = $row[7] ?? null;
            $municipality = $row[8] ?? null;
            $province = $row[9] ?? null;
            $email = $row[10] ?? null;
            $tin = $row[11] ?? 'N/A';
            $remarks = $row[12] ?? null;
            $region = $row[14] ?? null;

            $region = in_array(trim($region), $allowedRegions, true) ? trim($region) : 'Unknown';
            $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;

            if (empty($email) || $email == 'no-email@example.com') {
                $email = 'no-email-' . uniqid() . '@example.com';
            }

            $address = trim("{$barangay}, {$municipality}, {$province}");

            $cooperative = Cooperative::create([
                'name' => $name,
                'contact_person' => $contactPerson,
                'type' => $position,
                'address' => $address,
                'region' => $region,
                'phone_number' => $phoneNumber,
                'email' => $email,
                'tin' => $tin,
                'coop_identification_no' => null,
                'bod_chairperson' => null,
                'general_manager_ceo' => null,
                'total_asset' => null,
                'total_income' => null,
                'cetf_remittance' => null,
                'cetf_required' => null,
                'cetf_balance' => null,
                'share_capital_balance' => null,
                'no_of_entitled_votes' => null,
                'services_availed' => json_encode([]),
            ]);

            $sanitizedPassword = str_replace(' ', '', $cooperative->name) . 'GA2025';

            User::create([
                'name' => $cooperative->contact_person,
                'coop_id' => $cooperative->coop_id,
                'email' => $cooperative->email,
                'password' => Hash::make($sanitizedPassword),
                'role' => 'cooperative',
            ]);
        }

        return back()->with('success', 'Excel data imported successfully, including user accounts.');
    }
}
