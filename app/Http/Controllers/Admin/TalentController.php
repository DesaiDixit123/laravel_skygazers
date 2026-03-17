<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Talent;
use App\Models\TalentCategory;
use App\Models\TalentImage;
use Illuminate\Support\Facades\Storage;

class TalentController extends Controller
{
    public function index(Request $request)
    {
        $query = Talent::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('label', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $isActive = $request->status == 'active';
            $query->where(function ($q) use ($isActive) {
                $q->where('is_active', '=', $isActive);
            });
        }

        $talents = $query->latest()->get();
        return view('admin.talent.index', compact('talents'));
    }

    public function toggleStatus(Talent $talent)
    {
        $talent->update(['is_active' => !$talent->is_active]);
        return response()->json(['success' => true, 'is_active' => $talent->is_active]);
    }

    public function create()
    {
        $categories = TalentCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.talent.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'label' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'height' => 'nullable|string|max:50',
            'bust' => 'nullable|string|max:50',
            'waist' => 'nullable|string|max:50',
            'hips' => 'nullable|string|max:50',
            'shoe_size' => 'nullable|string|max:50',
            'gallery.*' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('talent', 'public');
        }

        $talentData = collect($validated)->except('gallery')->toArray();
        $talent = Talent::create($talentData);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('talent/gallery', 'public');
                $talent->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.talent.index')->with('success', 'Talent created successfully.');
    }

    public function edit(Talent $talent)
    {
        $categories = TalentCategory::where('is_active', true)->orderBy('name')->get();
        $talent->load('images');
        return view('admin.talent.edit', compact('talent', 'categories'));
    }

    public function update(Request $request, Talent $talent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'label' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'height' => 'nullable|string|max:50',
            'bust' => 'nullable|string|max:50',
            'waist' => 'nullable|string|max:50',
            'hips' => 'nullable|string|max:50',
            'shoe_size' => 'nullable|string|max:50',
            'gallery.*' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($talent->image) {
                Storage::disk('public')->delete($talent->image);
            }
            $validated['image'] = $request->file('image')->store('talent', 'public');
        }

        $talentData = collect($validated)->except('gallery')->toArray();
        $talent->update($talentData);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('talent/gallery', 'public');
                $talent->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.talent.index')->with('success', 'Talent updated successfully.');
    }

    public function deleteImage(TalentImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function destroy(Talent $talent)
    {
        if ($talent->image) {
            Storage::disk('public')->delete($talent->image);
        }
        $talent->delete();

        return redirect()->route('admin.talent.index')->with('success', 'Talent deleted successfully.');
    }
}
