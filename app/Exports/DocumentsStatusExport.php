<?php

namespace App\Exports;

use App\Models\UploadedDocument;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DocumentsStatusExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Fetch documents with their associated cooperative data
        // Group by region but exclude 'Unknown' regions
        return UploadedDocument::with('cooperative')
            ->get()
            ->groupBy(function($document) {
                return $document->cooperative ? $document->cooperative->region : 'Unknown';
            })
            ->filter(function($documents, $region) {
                return $region !== 'Unknown'; // Exclude Unknown region
            });
    }

    public function headings(): array
    {
        return [
            'Cooperative Region',
            'Financial Statement',
            'Resolution for Voting delegates',
            'Deposit Slip for Registration Fee',
         
            'Deposit Slip for CETF Remittance',
            'CETF Undertaking',
            'Certificate of Candidacy',
            'CETF Utilization invoice'
        ];
    }

    public function map($documents): array
    {
        // Get the cooperative region (first entry's region)
        $coopRegion = $documents->first()->cooperative->region;

        // Count the number of each document type in this region
        return [
            $coopRegion,
            $this->getDocumentCount($documents, 'Financial Statement'),
            $this->getDocumentCount($documents, 'Resolution for Voting delegates'),
            $this->getDocumentCount($documents, 'Deposit Slip for Registration Fee'),

            $this->getDocumentCount($documents, 'Deposit Slip for CETF Remittance'),
            $this->getDocumentCount($documents, 'CETF Undertaking'),
            $this->getDocumentCount($documents, 'Certificate of Candidacy'),
            $this->getDocumentCount($documents, 'CETF Utilization invoice'),
        ];
    }

    /**
     * Helper method to get the count of a specific document type in the group.
     */
    protected function getDocumentCount($documents, $type)
    {
        return $documents->filter(function($document) use ($type) {
            return $document->document_type === $type;
        })->count();
    }
}


