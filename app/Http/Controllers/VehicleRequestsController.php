<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequestRequest;
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

    public function index()
    {
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
            ->get('api/vehicles');

        if ($response->failed()) {
            abort(500, 'Error al obtener vehiculos');
        }

        $vehicles = $response->json('data.data');

        return view('vehicleRequests.registerRequest', compact('vehicles'));
    }

    public function store(StoreVehicleRequestRequest $request)
    {
        $response = $this->apiClient()->post('api/vehicleRequests', $request->validated());

        if ($response->failed()) {
            return back()->with('error', 'Error al crear la solicitud');
        }

        return redirect()->route('vehicle-requests.index')
            ->with('success', 'Solicitud creada correctamente');
    }
}
