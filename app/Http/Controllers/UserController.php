<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;


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
        } catch (\Exception $error) {
            dd("Excepción capturada en Index:", $error->getMessage());
        }
    }
    public function store(StoreUserRequest $request)
    {
        $response = $this->apiRequest()->put("/users/{$request->id}", $request->validated());

        if ($response->successful()) {
            return redirect()->route('users.index');
        }

        //dd($response->json());
        return back()->withErrors('La API rechazó los datos.');
    }
    public function show($id)
    {
        try {

            $response = $this->apiRequest()->get("/users/{$id}");

            if (!$response->successful()) {
                throw new \Exception("Error API ({$response->status()}): " . $response->body());
            }

            $data = $response->json();
            return $data['data'] ?? $data;
        } catch (\Exception $error) {
            return back()->withErrors("Error al obtener usuario: " . $error->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $user = $this->show($id);

            return view('users.update', [
                'users' => $user
            ]);
        } catch (\Exception $error) {
            dd("Excepción capturada en Edit:", $error->getMessage());
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {

        $response = $this->apiRequest()->put("/users/{$id}", $request->validated());

        if ($response->successful()) {
            return redirect()->route('users.index')->with('success', 'Usuario actualizado');
        }

        return back()->withErrors('La API rechazó los datos: ' . $response->body());
    }
    public function destroy($id)
    {
        try {
            $response = $this->apiRequest()->delete("/users/{$id}");

            if (!$response->successful()) {
                dd("Error de API:", $response->status(), $response->json());
            }

            return redirect()->route('users.index')->with('success', 'Usuario eliminado');
        } catch (\Exception $error) {
            dd("Excepción capturada:", $error->getMessage());
        }
    }

    public function restore($id)
    {
        try {

            $response =  $this->apiRequest()->patch("/users/{$id}/restore");

            if (!$response->successful()) {
                dd("Error de API:", $response->status(), $response->json());
            }

            return redirect()->route('users.index')->with('success', 'Usuario restaurado');
        } catch (\Exception $e) {
            dd("Excepción capturada:", $e->getMessage());
        }
    }
    public function inactive()
    {
        try {
            $response = $this->apiRequest()->get('/users/inactive');


            if (!$response->successful()) {
                return back()->withErrors([
                    'api' => "Error de API: {$response->status()}",
                    'detail' => $response->json(),
                ]);
            }

            $res = $response->json();

            return view('layouts.Components.users_general', [
                'users' => $res['data']['data']
            ]);
        } catch (\Exception $e) {
            dd("Excepción capturada:", $e->getMessage());
        }
    }
}
