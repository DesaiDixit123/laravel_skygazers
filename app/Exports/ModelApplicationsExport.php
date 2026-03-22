<?php

namespace App\Exports;

use App\Models\ModelApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ModelApplicationsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithColumnWidths
{
    protected $query;
    protected $rowsCount = 0;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        $collection = $this->query->get();
        $this->rowsCount = $collection->count();
        return $collection;
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
            'Photos',
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
            implode(', ', array_map(fn($p) => asset('storage/' . $p), $app->photos ?? [])),
            ucfirst($app->status),
            $app->created_at->format('Y-m-d H:i:s')
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $applications = $this->query->get();
        
        foreach ($applications as $index => $app) {
            if (!empty($app->photos)) {
                $photo = $app->photos[0]; // Just use the first photo for Excel to keep it clean
                $path = public_path('storage/' . $photo);
                
                if (file_exists($path)) {
                    $drawing = new Drawing();
                    $drawing->setName($app->full_name);
                    $drawing->setDescription($app->full_name);
                    $drawing->setPath($path);
                    $drawing->setHeight(50);
                    $drawing->setCoordinates('M' . ($index + 2)); // Column M is for Photos (13th column)
                    $drawings[] = $drawing;
                }
            }
        }
        
        return $drawings;
    }

    public function columnWidths(): array
    {
        return [
            'M' => 20, // Make the Photos column wider
        ];
    }
}
