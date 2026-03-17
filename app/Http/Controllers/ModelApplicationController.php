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
            'photos' => 'required|array|min:1|max:4',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('model_applications', 'public');
                $photoPaths[] = $path;
            }
        }

        $applicationData = $validated;
        $applicationData['photos'] = $photoPaths;

        ModelApplication::create($applicationData);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your application with photos has been submitted successfully!'
            ]);
        }

        return back()->with('success', 'Your application with photos has been submitted successfully!');
    }
}
