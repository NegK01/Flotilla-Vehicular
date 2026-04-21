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
        $response = $this->apiClient()->get('api/vehicles')->json();

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

    public function show() {}

    public function edit() {}

    public function update(UpdateVehicleRequest $request) {}

    public function destroy() {}
}
