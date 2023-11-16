<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Team;

class CountryController extends Controller
{
    public function index()
    {
        // TASK: load the relationship average of team size
        $country = Country::create(['name' => 'United Kingdom']);
        Team::create([
            'name' => 'Team 1',
            'country_id' => $country->id,
            'size' => 3
        ]);
        Team::create([
            'name' => 'Team 2',
            'country_id' => $country->id,
            'size' => 5
        ]);

        $countries = Country::with('teams')->get();

        $countries->each(function ($country) {
            $averageTeamSize = $country->teams->avg('size');
            $country->teams_avg_size = $averageTeamSize;
        });

        return view('countries.index', compact('countries'));
    }
}
