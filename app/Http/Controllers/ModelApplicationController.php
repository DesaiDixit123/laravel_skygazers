<?php

namespace App\Http\Controllers;

use App\Models\ModelApplication;
use Illuminate\Http\Request;

class ModelApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string',
            'age' => 'required|integer|min:18',
            'gender' => 'required|string',
            'height' => 'required|string',
            'measurements' => 'required|string',
            'affiliate_code' => 'nullable|string',
            'instagram' => 'required|string',
            'telegram' => 'required|string',
            'whatsapp_number' => 'required|string',
        ]);

        ModelApplication::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your application has been submitted successfully!'
            ]);
        }

        return back()->with('success', 'Your application has been submitted successfully!');
    }
}
