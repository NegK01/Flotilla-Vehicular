<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use Illuminate\Support\Facades\Http;

class MaintenanceController extends Controller
{
    public function apiClient()
    {
        return Http::withToken(session('access_token'))
            ->baseUrl(config('services.api.url'))
            ->acceptJson();
    }

    public function index()
    {
        $response = $this->apiClient()->get('api/maintenances');

        if ($response->failed()) {
            return back()->withErrors('Error al obtener mantenimientos');
        }

        $maintenances = $response->json('data.data');

        return view('maintenances.maintenances_general', compact('maintenances'));
    }

    public function create()
    {
        $response = $this->apiClient()->get('api/vehicles');

        $vehicles = $response->json('data.data');

        return view('maintenances.maintenance_registration', compact('vehicles'));
    }

    public function store(StoreMaintenanceRequest $request)
    {
        $data = $request->validated();

        $response = $this->apiClient()
            ->post('api/maintenances', $data);

        if ($response->failed()) {
            return back()->withInput()
                ->withErrors('No se pudo crear el mantenimiento');
        }

        return redirect()->route('maintenances.index')
            ->with('success', 'Mantenimiento creado con éxito');
    }

    public function show($id)
    {
        $response = $this->apiClient()
            ->get("api/maintenances/{$id}");

        if ($response->failed()) {
            return null;
        }

        return $response->json('data');
    }

    public function edit($id)
    {
        $maintenance = $this->show($id);

        if (!$maintenance) {
            return redirect()->route('maintenances.index')
                ->withErrors('No se pudo encontrar el mantenimiento');
        }

        return view('maintenances.maintenance_finished', compact('maintenance'));
    }

    public function update(UpdateMaintenanceRequest $request, $id)
    {
        $data = $request->validated();

        $response = $this->apiClient()
            ->put("api/maintenances/{$id}", $data);

        if ($response->failed()) {
            return back()->withInput()
                ->withErrors('No se pudo actualizar el mantenimiento');
        }

        return redirect()->route('maintenances.index')
            ->with('success', 'Mantenimiento actualizado con éxito');
    }

    
}
