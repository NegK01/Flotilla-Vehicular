<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Road\StoreRequest;


class RoadController extends Controller
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
            $response = $this->apiRequest()->get('travelRoutes');

            if (!$response->successful()) {
                dd("Error de API", $response->status(), $response->json());
            }

            $data = $response->json();

            return view('layouts.road.roads', [
                'roads' => $data['data']['data'] ?? []
            ]);
        } catch (\Exception $error) {
            dd("Excepción capturada en Index:", $error->getMessage());
        }
    }
    public function create()
    {
        return view('layouts.road.registerRoad');
    }
    public function store(StoreRequest $request)
    {
        try {

            $validatedData = $request->validated();
            $response = $this->apiRequest()->post('/travelRoutes', $validatedData);


            if ($response->successful()) {
                return redirect()
                    ->route('road.index')
                    ->with('success', 'La ruta se ha registrado correctamente.');
            }
            $errorData = $response->json();

            return back()
                ->withErrors($errorData['message'] ?? 'La API rechazó los datos.');
        } catch (\Exception $e) {
            return back()
                ->withErrors('Ocurrió un error inesperado al intentar registrar la ruta.')
                ->withInput();
        }
    }
}
