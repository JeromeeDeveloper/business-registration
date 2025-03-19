<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Cooperative;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ExcelImportController extends Controller
{
    public function showImportForm()
    {
        return view('import'); // Blade file at resources/views/import.blade.php
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

        // Allowed Regions
        $allowedRegions = [
            'Region I',
            'Region II',
            'Region III',
            'Region IV-A',
            'Region IV-B',
            'Region V',
            'Region VI',
            'Region VII',
            'Region VIII',
            'Region IX',
            'Region X',
            'Region XI',
            'Region XII',
            'Region XIII',
            'NCR',
            'CAR',
            'BARMM',
            'LUZON',
            'Visayas',
            'Mindanao',
            'ZBST'
        ];

        // Region Mapping
        $regionMapping = [
            'Region 1' => 'Region I',
            'Region 2' => 'Region II',
            'Region 3' => 'Region III',
            'Region 4A' => 'Region IV-A',
            'Region 4B' => 'Region IV-B',
            'Region 5' => 'Region V',
            'Region 6' => 'Region VI',
            'Region 7' => 'Region VII',
            'Region 8' => 'Region VIII',
            'Region 9' => 'Region IX',
            'Region 10' => 'Region X',
            'Region 11' => 'Region XI',
            'Region 12' => 'Region XII',
            'Region 13' => 'Region XIII',
            'CARAGA' => 'CAR'
        ];

        // Function to clean numeric values
        function cleanNumber($value)
        {
            return is_numeric(str_replace(',', '', $value)) ? floatval(str_replace(',', '', $value)) : 0;
        }

        foreach (array_slice($rows, 3) as $row) {
            Log::info('Processing row:', $row);
            if (empty($row[3])) continue; // Skip empty rows

            // Data Extraction
            $email = filter_var($row[0] ?? null, FILTER_VALIDATE_EMAIL) ? $row[0] : null;
            $coopIdentificationNo = $row[1] ?? null;
            $name = $row[3] ?? 'Unknown Cooperative';
            $region = trim($row[4] ?? 'Unknown');
            $region = $regionMapping[$region] ?? (in_array($region, $allowedRegions) ? $region : 'Unknown');

            // Financial Data
            $shareCapital = cleanNumber($row[5] ?? 0);
            $savings = cleanNumber($row[6] ?? 0) + cleanNumber($row[7] ?? 0) + cleanNumber($row[8] ?? 0);
            $timeDeposit = cleanNumber($row[9] ?? 0);
            $loanReceivable = cleanNumber($row[10] ?? 0);
            $accountsReceivable = cleanNumber($row[11] ?? 0);
          

            // Services Availed
            $serviceColumns = [
                14 => 'CF',
                15 => 'IT',
                16 => 'MSU',
                17 => 'ICS',
                18 => 'MCU',
                19 => 'ADMIN',
                20 => 'GAD',
                21 => 'YOUTH',
                22 => 'SCOOPS',
                23 => 'YAKAP',
                24 => 'AGRIBEST'
            ];

            $services = [];

            foreach ($serviceColumns as $colIndex => $serviceName) {
                $cellValue = trim($row[$colIndex] ?? ''); // Ensure it's trimmed and not null
                Log::info("Checking service column $colIndex:", ['value' => $cellValue]); // Debugging

                if (!empty($cellValue)) { // If the cell has any value, add the service
                    $services[] = $serviceName;
                }
            }



            // Default email assignment
            if (empty($email) || $email == 'no-email@example.com') {
                $email = 'no-email-' . uniqid() . '@example.com';
            }

            // Function to generate an acronym from the cooperative name
            function generateAcronym($name)
            {
                $words = preg_split('/\s+/', trim($name)); // Split by spaces
                $acronym = '';

                foreach ($words as $word) {
                    if (!empty($word)) {
                        $acronym .= strtoupper(substr($word, 0, 1)); // Get first letter of each word
                    }
                }

                return $acronym ?: 'COOP'; // Default to 'COOP' if the name is empty
            }

            foreach (array_slice($rows, 3) as $row) {
                Log::info('Processing row:', $row);
                if (empty($row[3])) continue; // Skip empty rows

                // Data Extraction
                $email = filter_var($row[0] ?? null, FILTER_VALIDATE_EMAIL) ? $row[0] : null;
                $coopIdentificationNo = $row[1] ?? null;
                $name = trim($row[3] ?? 'Unknown Cooperative');
                $region = trim($row[4] ?? 'Unknown');
                $region = $regionMapping[$region] ?? (in_array($region, $allowedRegions) ? $region : 'Unknown');

                // Assign default email if empty
                if (empty($email) || $email == 'no-email@example.com') {
                    $email = 'no-email-' . uniqid() . '@example.com';
                }

                // Store Cooperative
                try {
                    $cooperative = Cooperative::create([
                        'coop_identification_no' => $coopIdentificationNo,
                        'name' => $name,
                        'contact_person' => $name,
                        'type' => 'Cooperative',
                        'address' => 'N/A',
                        'region' => $region,
                        'phone_number' => 'N/A',
                        'email' => $email,
                        'tin' => 'N/A',
                        'loan_balance' => cleanNumber($row[10] ?? 0),
                        'time_deposit' => cleanNumber($row[9] ?? 0),
                        'accounts_receivable' => cleanNumber($row[11] ?? 0),
                        'savings' => cleanNumber($row[6] ?? 0) + cleanNumber($row[7] ?? 0) + cleanNumber($row[8] ?? 0),

                        'share_capital_balance' => cleanNumber($row[5] ?? 0),
                        'services_availed' => json_encode(array_filter(array_map('trim', [
                            !empty($row[14]) ? 'CF' : null,
                            !empty($row[15]) ? 'IT' : null,
                            !empty($row[16]) ? 'MSU' : null,
                            !empty($row[17]) ? 'ICS' : null,
                            !empty($row[18]) ? 'MCU' : null,
                            !empty($row[19]) ? 'ADMIN' : null,
                            !empty($row[20]) ? 'GAD' : null,
                            !empty($row[21]) ? 'YOUTH' : null,
                            !empty($row[22]) ? 'SCOOPS' : null,
                            !empty($row[23]) ? 'YAKAP' : null,
                            !empty($row[24]) ? 'AGRIBEST' : null,
                        ]))),
                    ]);

                    Log::info('Cooperative created successfully:', $cooperative->toArray());
                } catch (\Exception $e) {
                    Log::error('Error creating cooperative: ' . $e->getMessage());
                    continue;
                }

                // Generate acronym-based password
                $acronym = generateAcronym($cooperative->name);
                $sanitizedPassword = $acronym . 'GA2025';

                try {
                    User::create([
                        'name' => $cooperative->contact_person,
                        'coop_id' => $cooperative->coop_id,
                        'email' => $cooperative->email,
                        'password' => Hash::make($sanitizedPassword),
                        'role' => 'cooperative',
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error creating user: ' . $e->getMessage());
                }
            }

            return back()->with('success', 'Excel data imported successfully, including user accounts.');
        }
    }
}
