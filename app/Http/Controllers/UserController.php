<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;


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
    public function show($id)
    {
        try {
            $response = $this->apiRequest()->get("/users/{$id}");

            if (!$response->successful()) {
                dd("Error de API:", $response->status(), $response->json());
            }

            $json = $response->json();

            return view('users.update', [
                'users' => $json['data'] ?? $json
            ]);
        } catch (\Exception $e) {
            dd("Excepción capturada:", $e->getMessage());
        }
    }
    public function update(UpdateUserRequest $request)
    {
        $response = $this->apiRequest()->put("/users/{$request->id}", $request->validated());

        if ($response->successful()) {
            return redirect()->route('users.index');
        }

        //dd($response->json());
        return back()->withErrors('La API rechazó los datos.');
    }
}
