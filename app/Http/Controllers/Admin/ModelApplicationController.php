<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelApplication;
use Illuminate\Http\Request;

class ModelApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ModelApplication::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('instagram', 'like', "%{$search}%")
                  ->orWhere('affiliate_code', 'like', "%{$search}%")
                  ->orWhere('whatsapp_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $applications = $query->latest()->paginate(20);

        if ($request->ajax()) {
            return view('admin.model-applications.index', compact('applications'))->render();
        }

        return view('admin.model-applications.index', compact('applications'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = ModelApplication::findOrFail($id);
        return view('admin.model-applications.show', compact('application'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = ModelApplication::findOrFail($id);
        $application->delete();

        return redirect()->route('admin.model-applications.index')->with('success', 'Application deleted successfully.');
    }
}
