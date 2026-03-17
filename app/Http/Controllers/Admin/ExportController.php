<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    public function export(Request $request, $resource, $format)
    {
        $exportClass = $this->getExportClass($resource);
        $modelClass = $this->getModelClass($resource);
        
        if (!$exportClass || !$modelClass) {
            return back()->with('error', 'Invalid export resource.');
        }

        $query = $modelClass::query();

        // Apply same filters as in the index controllers
        if ($request->filled('search')) {
            $search = $request->search;
            $query = $this->applySearch($query, $resource, $search);
        }

        $filename = Str::slug($resource) . '-' . now()->format('Y-m-d-His');

        if ($format === 'excel') {
            return Excel::download(new $exportClass($query), $filename . '.xlsx');
        }

        if ($format === 'pdf') {
            $export = new $exportClass($query);
            $data = [
                'title' => Str::headline($resource) . ' Export',
                'headings' => $export->headings(),
                'rows' => $export->collection()->map(fn($item) => $export->map($item))
            ];
            
            $pdf = Pdf::loadView('admin.exports.pdf_template', $data)->setPaper('a4', 'landscape');
            return $pdf->download($filename . '.pdf');
        }

        return back()->with('error', 'Invalid export format.');
    }

    protected function getExportClass($resource)
    {
        $map = [
            'model-applications' => \App\Exports\ModelApplicationsExport::class,
            'contact-messages' => \App\Exports\ContactMessagesExport::class,
            'services' => \App\Exports\ServicesExport::class,
            'talent' => \App\Exports\TalentsExport::class,
            'talent-categories' => \App\Exports\TalentCategoriesExport::class,
            'talent-countries' => \App\Exports\TalentCountriesExport::class,
        ];

        return $map[$resource] ?? null;
    }

    protected function getModelClass($resource)
    {
        $map = [
            'model-applications' => \App\Models\ModelApplication::class,
            'contact-messages' => \App\Models\ContactMessage::class,
            'services' => \App\Models\Service::class,
            'talent' => \App\Models\Talent::class,
            'talent-categories' => \App\Models\TalentCategory::class,
            'talent-countries' => \App\Models\TalentCountry::class,
        ];

        return $map[$resource] ?? null;
    }

    protected function applySearch($query, $resource, $search)
    {
        switch ($resource) {
            case 'model-applications':
                return $query->where(function($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('country', 'like', "%{$search}%")
                      ->orWhere('instagram', 'like', "%{$search}%")
                      ->orWhere('affiliate_code', 'like', "%{$search}%")
                      ->orWhere('whatsapp_number', 'like', "%{$search}%");
                });
            case 'contact-messages':
                return $query->where(function($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('message', 'like', "%{$search}%");
                });
            case 'services':
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('summary', 'like', "%{$search}%");
            case 'talent':
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%")
                             ->orWhere('label', 'like', "%{$search}%");
            case 'talent-categories':
                return $query->where('name', 'like', "%{$search}%");
            case 'talent-countries':
                return $query->where('name', 'like', "%{$search}%");
        }
        return $query;
    }
}
