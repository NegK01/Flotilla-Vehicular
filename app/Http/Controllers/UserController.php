<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;


class UserController extends Controller
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
            $response = $this->apiRequest()->get('/users');

            if (!$response->successful()) {
                dd("Error de API", $response->status(), $response->json());
            }
            return view('layouts.Components.users_general', [
                'users' => $response->json()['data']['data']
            ]);
        } catch (\Exception $e) {
            dd("Excepción capturada en Index:", $e->getMessage());
        }
    }
}
