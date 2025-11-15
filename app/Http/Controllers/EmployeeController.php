<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function getStates(Request $request)
    {
        $country = $request->country;

        $response = Http::post('https://countriesnow.space/api/v0.1/countries/states', [
            "country" => $country
        ]);

        return $response->json()['data']['states'];
    }

    public function getCities(Request $request)
    {
        $country = $request->country;
        $state = $request->state;

        $response = Http::post('https://countriesnow.space/api/v0.1/countries/state/cities', [
            "country" => $country,
            "state"   => $state,
        ]);

        return $response->json()['data'];
    }
}
