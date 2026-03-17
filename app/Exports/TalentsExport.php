<?php

namespace App\Exports;

use App\Models\Talent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TalentsExport implements FromCollection, WithHeadings, WithMapping
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
            'Category',
            'Label',
            'Height',
            'Bust',
            'Waist',
            'Hips',
            'Shoe Size',
            'Status',
            'Created At'
        ];
    }

    public function map($talent): array
    {
        return [
            $talent->id,
            $talent->name,
            $talent->category,
            $talent->label,
            $talent->height,
            $talent->bust,
            $talent->waist,
            $talent->hips,
            $talent->shoe_size,
            $talent->is_active ? 'Active' : 'Inactive',
            $talent->created_at->format('Y-m-d H:i:s')
        ];
    }
}
