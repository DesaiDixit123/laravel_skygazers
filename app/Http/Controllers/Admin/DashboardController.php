<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Talent;
use App\Models\ContactMessage;
use App\Models\ModelApplication;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'services' => Service::count(),
            'talent' => Talent::count(),
            'messages' => ContactMessage::count(),
            'applications' => ModelApplication::count(),
        ];

        // Gather stats for the last 7 days
        $days = collect(range(6, 0))->map(function ($i) {
            return Carbon::now()->subDays($i)->format('Y-m-d');
        });

        $registrationStats = $days->map(function ($date) {
            return ModelApplication::whereDate('created_at', $date)->count();
        });

        $messageStats = $days->map(function ($date) {
            return ContactMessage::whereDate('created_at', $date)->count();
        });

        $labels = $days->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        });

        return view('admin.dashboard', compact('counts', 'labels', 'registrationStats', 'messageStats'));
    }
}
