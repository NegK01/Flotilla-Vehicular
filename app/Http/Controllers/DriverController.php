<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    private function apiRequest()
    {
        return Http::withToken(session('access_token'))
            ->acceptJson()
            ->baseUrl(config('services.api.url') . '/api');
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
            'user_id' => Auth::id(),
        ]);

        $response = $this->apiRequest()->post('/vehicleRequests', $payload);

        if ($response->successful()) {
            return redirect()->route('driver.index');
        }
        dd($response->json());
        return back()->withErrors('La API rechazó los datos.');
    }
}
