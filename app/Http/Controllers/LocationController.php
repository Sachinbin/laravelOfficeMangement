<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    protected $base = 'https://www.universal-tutorial.com/api';

    // Fetch countries
    public function countries()
    {
        $token = config('services.universal.token');
        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get($this->base . '/countries/');

        return $res->json();
    }

    // Fetch states by country
    public function states($country)
    {
        $token = config('services.universal.token');
        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get($this->base . '/states/'.$country);

        return $res->json();
    }

    // Fetch cities by state
    public function cities($state)
    {
        $token = config('services.universal.token');
        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get($this->base . '/cities/'.$state);

        return $res->json();
    }
}
