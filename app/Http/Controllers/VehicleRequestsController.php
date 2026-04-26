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

    public function index(){
        $response = $this->apiClient()->get('api/vehicleRequests');

        if ($response->failed()) {
            abort(500, 'Error al obtener solicitudes');
        }

        $requests = $response->json('data.data'); 

        return view('vehicleRequests.viewRequests', compact('requests'));
    }


    public function create()
    {
        $response = $this->apiClient()
            ->get('api/vehicles')->json();

        $vehicles = $response['data']['data'];

        return view('vehicleRequests.registerRequest', compact('vehicles'));
    }
}
