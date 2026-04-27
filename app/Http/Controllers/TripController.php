<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class TripController extends Controller
{
    public function apiClient()
    {
        return Http::withToken(session('access_token'))
            ->baseUrl(config('services.api.url'))
            ->acceptJson();
    }

    public function index()
    {
        $response = $this->apiClient()->get('api/trips');

        if ($response->failed()) {
            return back()->withErrors('Error al obtener la lista de viajes');
        }

        $trips = $response->json('data.data');

        return view('trips.viewTrips', compact('trips'));
    }

    public function create()
    {
        $responseVehicles = $this->apiClient()->get('api/vehicles');
        $responseDrivers = $this->apiClient()->get('api/users?role=3');
        $responseRoutes = $this->apiClient()->get('api/travelRoutes');

        if ($responseVehicles->failed()) {
            return back()->withInput()->withErrors('No se pudo obtener los vehiculos');
        }

        if ($responseDrivers->failed()) {
            return back()->withInput()->withErrors('No se pudo obtener los conductores');
        }

        if ($responseRoutes->failed()) {
            return back()->withInput()->withErrors('No se pudo obtener las rutas');
        }

        $vehicles = $responseVehicles->json('data.data');
        $drivers = $responseDrivers->json('data.data');
        $routes = $responseRoutes->json('data.data');

        return view('trips.trip_registration', compact('vehicles', 'drivers', 'routes'));
    }

    public function store(StoreTripRequest $request)
    {
        $data = $request->validated();

        $response = $this->apiClient()->post('api/trips', $data);

        if ($response->failed()) {
            return back()->withInput()->withErrors('No se pudo registrar el viaje');
        }

        return redirect()->route('trips.index')->with('success', 'Viaje creado correctamente');
    }

    public function show($id)
    {
        $response = $this->apiClient()
            ->get("api/trips/{$id}");

        if ($response->failed()) {
            return null;
        }

        return $response->json('data');
    }

    public function edit($id)
    {
        $trip = $this->show($id);

        if (!$trip) {
            return redirect()->route('trips.index')->withErrors('No se encontró el viaje');
        }

        return view('trips.trip_edit', compact('trip'));
    }

    public function update(UpdateTripRequest $request, $trip)
    {
        //dd('Aqui ando', $trip);
        $data = $request->validated();

        $response = $this->apiClient()->put("api/trips/{$trip}", $data);
        //dd($response->json());
        if ($response->failed()) {
            return back()->withInput()->withErrors('No se pudo actualizar el viaje');
        }

        return redirect()->route('trips.index')->with('success', 'Viaje actualizado correctamente');
    }

    public function destroy($id)
    {
        $response = $this->apiClient()->delete("api/trips/{$id}");

        if ($response->failed()) {
            return back()->withErrors('No se pudo eliminar el viaje');
        }

        return redirect()->route('trips.index')->with('success', 'Viaje eliminado con éxito');
    }
}
