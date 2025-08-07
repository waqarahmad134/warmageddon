<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
class CountryController extends Controller
{
    public function state($name)
    {
        $getCountryId = Country::find($name);
        $state = [
            'state' => [State::where('country_id',$getCountryId->id)->pluck('name')]
        ];
        return response()->json($state);

    }
}
