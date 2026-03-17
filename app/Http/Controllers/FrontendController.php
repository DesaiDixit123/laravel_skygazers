<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Talent;
use App\Models\SiteContent;
use App\Models\TalentCategory;
use App\Models\TalentCountry;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)->latest()->take(6)->get();
        $talents = Talent::where('is_active', true)->latest()->take(8)->get();
        
        $creatorsCount = SiteContent::where('key', 'talent_creators_count')->value('value') ?? '500+';
        $campaignsCount = SiteContent::where('key', 'talent_campaigns_count')->value('value') ?? '250+';
        $talentCategories = TalentCategory::where('is_active', true)->orderBy('name')->get();
        $talentCountries = TalentCountry::where('is_active', true)->orderBy('name')->get();

        return view('welcome', compact('services', 'talents', 'creatorsCount', 'campaignsCount', 'talentCategories', 'talentCountries'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->latest()->get();
        return view('services', compact('services'));
    }

    public function talentNetwork()
    {
        $talents = Talent::where('is_active', true)->latest()->get();
        
        $creatorsCount = SiteContent::where('key', 'talent_creators_count')->value('value') ?? '500+';
        $campaignsCount = SiteContent::where('key', 'talent_campaigns_count')->value('value') ?? '250+';
        $talentCategories = TalentCategory::where('is_active', true)->orderBy('name')->get();
        $talentCountries = TalentCountry::where('is_active', true)->orderBy('name')->get();

        return view('talent', compact('talents', 'creatorsCount', 'campaignsCount', 'talentCategories', 'talentCountries'));
    }

    public function talentDetails($name)
    {
        $formattedName = str_replace('-', ' ', $name);
        $talent = Talent::with('images')->where(function ($q) use ($formattedName) {
            $q->where('name', 'like', $formattedName);
        })->first();
        return view('talent-details', [
            'name' => $formattedName,
            'talent' => $talent
        ]);
    }
}
