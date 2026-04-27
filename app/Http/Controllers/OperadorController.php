<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class OperadorController extends Controller
{
    private function apiRequest()
    {
        return Http::withToken(session('access_token'))
            ->acceptJson()
            ->baseUrl(config('services.api.url') . '/api');
    }
    public function index()
    {
        $response = $this->apiRequest()->get('vehicleRequests');

        if ($response->failed()) {
            abort(500, 'Error al obtener solicitudes');
        }

        $requests = $response->json('data.data');

        return view('layouts.Components.operador_general', compact('requests'));
    }
}
