<?php

namespace App\Exports;

use App\Models\ModelApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ModelApplicationsExport implements FromCollection, WithHeadings, WithMapping
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
            'Full Name',
            'Email',
            'Country',
            'Age',
            'Gender',
            'Height',
            'Measurements',
            'Referral',
            'Instagram',
            'Telegram',
            'WhatsApp',
            'Status',
            'Applied On'
        ];
    }

    public function map($app): array
    {
        return [
            $app->id,
            $app->full_name,
            $app->email,
            ucfirst($app->country),
            $app->age,
            ucfirst($app->gender),
            $app->height,
            $app->measurements,
            $app->affiliate_code ?? 'None',
            $app->instagram,
            $app->telegram,
            $app->whatsapp_number,
            ucfirst($app->status),
            $app->created_at->format('Y-m-d H:i:s')
        ];
    }
}
