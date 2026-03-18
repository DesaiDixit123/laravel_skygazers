<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TalentCountry;

class TalentCountryController extends Controller
{
    public function index(Request $request)
    {
        $query = TalentCountry::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $isActive = $request->status == 'active';
            $query->where('is_active', '=', $isActive);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $countries = $query->latest()->get();
        return view('admin.talent-countries.index', compact('countries'));
    }

    public function toggleStatus(TalentCountry $talentCountry)
    {
        $talentCountry->update(['is_active' => !$talentCountry->is_active]);
        return response()->json(['success' => true, 'is_active' => $talentCountry->is_active]);
    }

    public function create()
    {
        return view('admin.talent-countries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:talent_countries,name',
        ]);
        
        TalentCountry::create($validated);
        return redirect()->route('admin.talent-countries.index')->with('success', 'Country added successfully.');
    }

    public function edit(TalentCountry $talentCountry)
    {
        return view('admin.talent-countries.edit', compact('talentCountry'));
    }

    public function update(Request $request, TalentCountry $talentCountry)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:talent_countries,name,' . $talentCountry->id,
        ]);

        $talentCountry->update($validated);
        return redirect()->route('admin.talent-countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(TalentCountry $talentCountry)
    {
        $talentCountry->delete();
        return redirect()->route('admin.talent-countries.index')->with('success', 'Country deleted successfully.');
    }
}
