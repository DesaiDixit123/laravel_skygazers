<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ServicesExport implements FromCollection, WithHeadings, WithMapping
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
            'Title',
            'Summary',
            'Status',
            'Created At'
        ];
    }

    public function map($service): array
    {
        return [
            $service->id,
            $service->title,
            $service->summary,
            $service->is_active ? 'Active' : 'Inactive',
            $service->created_at->format('Y-m-d H:i:s')
        ];
    }
}
