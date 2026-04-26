<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class VehicleController extends Controller
{
    public function apiClient()
    {
        return Http::withToken(session('access_token'))
            ->baseUrl(config('services.api.url'))
            ->acceptJson();
    }

    public function index()
    {
        $response = $this->apiClient()->get('api/vehicles');

        if ($response->failed()) {
            abort(500, 'Error al obtener vehículos');
        }

        $vehicles = $response->json('data.data'); 

        return view('vehicles.vehicle-general', compact('vehicles'));
    }

    public function inactive()
    {
        $response = $this->apiClient()->get('api/vehicles?trashed=only')->json();

        $vehicles = $response['data']['data'];

        return view('vehicles.vehicle-general', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.vehicle-registration');
    }

    public function store(StoreVehicleRequest $request)
    {

        $data = $request->validated();

        $image = $request->file('image_path');
        $payload = Arr::except($data, ['image_path']);

        $response = $this->apiClient()
            ->attach(
                'image_path',
                file_get_contents($image->getRealPath()),
                $image->getClientOriginalName()
            )
            ->post('api/vehicles', $payload);


        if ($response->failed()) {
            return back()->withInput()
                ->withErrors('No se pudo crear el vehiculo');
        }

        return redirect()->route('vehicles.index')
            ->with('sucess', 'Vehiculo creado con exito');
    }

    public function show($id)
    {
        $response = $this->apiClient()
            ->get("api/vehicles/{$id}");

        if ($response->failed()) {
            return null;
        }

        $vehicle = $response->json('data');

        return $vehicle;
    }

    public function edit($id)
    {
        $vehicle = $this->show($id);

        if (!$vehicle) {
            return redirect()->route('vehicles.index')
                ->withErrors('No se pudo encontrar el vehículo');
        }

        return view('vehicles.vehicle-edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, $id)
    {
        $data = $request->validated();

        $image = $request->file('image_path');
        $payload = Arr::except($data, ['image_path']);

        if ($image) {
            $response = $this->apiClient()
                ->attach(
                    'image_path',
                    file_get_contents($image->getRealPath()),
                    $image->getClientOriginalName()
                )
                ->post("api/vehicles/{$id}", [
                    ...$payload,
                    '_method' => 'PUT'
                ]);
        } else {
            $response = $this->apiClient()
                ->post("api/vehicles/{$id}", [
                    ...$payload,
                    '_method' => 'PUT'
                ]);
        }


        if ($response->failed()) {
            return back()->withInput()
                ->withErrors('No se pudo actualizar el vehiculo');
        }

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehiculo actualizado con exito');
    }

    public function destroy($id)
    {
        $response = $this->apiClient()
            ->delete("api/vehicles/{$id}");

        if ($response->failed()) {
            return back()
                ->withErrors('No se pudo eliminar el vehículo');
        }

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehículo eliminado con éxito');
    }

    public function restore($id)
    {
        $response = $this->apiClient()
            ->patch("api/vehicles/{$id}/restore");

        if ($response->failed()) {
            return back()
                ->withErrors('No se pudo activar el vehículo');
        }

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehículo activado con éxito');
    }
}
