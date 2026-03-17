<?php

namespace App\Exports;

use App\Models\TalentCountry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TalentCountriesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Status',
            'Created At'
        ];
    }

    public function map($country): array
    {
        return [
            $country->id,
            $country->name,
            $country->is_active ? 'Active' : 'Inactive',
            $country->created_at->format('Y-m-d H:i:s')
        ];
    }
}
