<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TalentCategory;
use Illuminate\Support\Str;

class TalentCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = TalentCategory::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $isActive = $request->status == 'active';
            $query->where(function ($q) use ($isActive) {
                $q->where('is_active', '=', $isActive);
            });
        }

        $categories = $query->latest()->get();
        return view('admin.talent-categories.index', compact('categories'));
    }

    public function toggleStatus(TalentCategory $talentCategory)
    {
        $talentCategory->update(['is_active' => !$talentCategory->is_active]);
        return response()->json(['success' => true, 'is_active' => $talentCategory->is_active]);
    }

    public function create()
    {
        return view('admin.talent-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:talent_categories,name',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        TalentCategory::create($validated);
        return redirect()->route('admin.talent-categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(TalentCategory $talentCategory)
    {
        return view('admin.talent-categories.edit', compact('talentCategory'));
    }

    public function update(Request $request, TalentCategory $talentCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:talent_categories,name,' . $talentCategory->id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $talentCategory->update($validated);
        return redirect()->route('admin.talent-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(TalentCategory $talentCategory)
    {
        $talentCategory->delete();
        return redirect()->route('admin.talent-categories.index')->with('success', 'Category deleted successfully.');
    }
}
