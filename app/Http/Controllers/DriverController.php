<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DriverController extends Controller
{
    private function apiRequest()
    {
        return Http::withToken(session('access_token'))
            ->acceptJson()
            ->baseUrl(config('services.api.url') . '/api');
    }

    private function currentUserId()
    {
        $user = session('auth_user');
        return $user['id'] ?? null;
    }

    public function index()
    {
        try {
            $response = $this->apiRequest()->get('vehicles');

            if (!$response->successful()) {
                dd("Error de API", $response->status(), $response->json());
            }

            $data = $response->json();

            return view('layouts.Components.driver_general', [
                'vehicles' => $data['data']['data'] ?? []
            ]);
        } catch (\Exception $error) {
            dd("Excepción capturada en Index:", $error->getMessage());
        }
    }
    public function create(Request $request)
    {
        $vehicle_id = $request->query('vehicle_id');
        return view('vehicles.request', [
            'vehicle_id' => $vehicle_id
        ]);
    }
    public function store(StoreRequest $request)
    {
        $payload = array_merge($request->validated(), [
            'user_id' => $this->currentUserId(),
        ]);

        $response = $this->apiRequest()->post('/vehicleRequests', $payload);

        if ($response->successful()) {
            return redirect()->route('driver.index');
        }
        dd($response->json());
        return back()->withErrors('La API rechazó los datos.');
    }

    public function requestHistorial()
    {

        $responseUsers = $this->apiRequest()
            ->get('users?role=3');

        if ($responseUsers->failed()) {
            abort(500, 'Error al obtener usuarios');
        }
        $users = $responseUsers->json('data.data');
        $trips = [];
        return view('layouts.driver.tripHistory', compact('users', 'trips'));
    }
    public function historial(Request $request)
    {
        try {

            $id = $request->query('user_id');

            $start_date = $request->query('start_date');
            $end_date = $request->query('end_date');

            $response = $this->apiRequest()->get("reports/drivers/{$id}/history", array_filter([
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]));

            if (!$response->successful()) {
                dd("Error de API", $response->status(), $response->json());
            }
            $usersResponse = $this->apiRequest()->get("users");

            $data = $response->json();
            $usersData = $usersResponse->json();

            return view('layouts.driver.tripHistory', [

                'users' => $usersData['data']['data'] ?? [],
                'trips' => $data['data']['vehicle_requests'] ?? [],
            ]);
        } catch (\Exception $error) {
            dd("Excepción capturada en historial:", $error->getMessage());
        }
    }
}
