<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VehicleRequestsController extends Controller
{
    public function apiClient()
    {
        return Http::withToken(session('access_token'))
            ->baseUrl(config('services.api.url'))
            ->acceptJson();
    }


    public function create()
    {
        $response = $this->apiClient()
            ->get('api/vehicles')->json();

        $vehicles = $response['data']['data'];

        return view('vehicleRequests.registerRequest', compact('vehicles'));
    }
}
