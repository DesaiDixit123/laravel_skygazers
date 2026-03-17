<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
