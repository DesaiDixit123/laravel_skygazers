<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SiteContent;

class TalentSettingController extends Controller
{
    public function index()
    {
        $creatorsCount = SiteContent::where('key', 'talent_creators_count')->value('value') ?? '500+';
        $campaignsCount = SiteContent::where('key', 'talent_campaigns_count')->value('value') ?? '250+';
        
        return view('admin.talent.settings', compact('creatorsCount', 'campaignsCount'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'creators_count' => 'required|string',
            'campaigns_count' => 'required|string',
        ]);

        SiteContent::updateOrCreate(['key' => 'talent_creators_count'], ['value' => $request->creators_count]);
        SiteContent::updateOrCreate(['key' => 'talent_campaigns_count'], ['value' => $request->campaigns_count]);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
