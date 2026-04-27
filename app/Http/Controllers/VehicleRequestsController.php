<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest\StoreRequest;
use App\Http\Requests\VehicleRequest\DirectAssignmentRequest;
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

        $responseUsers = $this->apiClient()
            ->get('api/users?role=3');
        if ($response->failed()) {
            abort(500, 'Error al obtener vehiculos');
        }
        if ($responseUsers->failed()) {
            abort(500, 'Error al obtener usuarios');
        }
        $users = $responseUsers->json('data.data');

        $vehicles = $response->json('data.data');

        return view('vehicleRequests.registerRequest', compact('vehicles', 'users'));
    }

    public function aprove($id)
    {
        $response = $this->apiClient()
            ->patch("api/vehicleRequests/{$id}/approve");
        if ($response->failed()) {
            abort(500, 'Error al aprovar solicitud');
        }
        return redirect()->route('vehicle-requests.index');
    }
    public function reject($id)
    {
        $response = $this->apiClient()
            ->patch("api/vehicleRequests/{$id}/reject");
        if ($response->failed()) {
            abort(500, 'Error al rechazar solicitud');
        }
        return redirect()->route('vehicle-requests.index');
    }

    public function store(StoreRequest $request)
    {
        $response = $this->apiClient()->post('api/vehicleRequests', $request->validated());

        if ($response->failed()) {
            return back()->with('error', 'Error al crear la solicitud');
        }

        return redirect()->route('vehicle-requests.index')
            ->with('success', 'Solicitud creada correctamente');
    }
    public function directStore(DirectAssignmentRequest $request)
    {
        //dd($request->all());
        $response = $this->apiClient()->post('api/vehicleRequests/directAssignment', $request->validated());
        //dd($response->json());
        if ($response->failed()) {
            return back()->with('error', 'Error al crear la solicitud');
        }

        return redirect()->route('vehicle-requests.index')
            ->with('success', 'Asignado correctamente');
    }
}
