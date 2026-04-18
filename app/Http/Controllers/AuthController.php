<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    private function apiClient(): Client
    {
        return new Client([
            'base_uri' => config('services.api.url'),
            'timeout'  => 10,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $client = $this->apiClient();

        try {
            $response = $client->post('/api/login', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'email' => $credentials['email'],
                    'password' => $credentials['password'],
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            session([
                'access_token' => $data['access_token'],
                'auth_user' => $data['user'],
            ]);

            return match ($data['user']['role_id'] ?? null) {
                //hay que asignarle los nombres de las vistas correctas luego
                1 => redirect()->route('users.index'),
                2 => redirect()->route('users'),
                3 => redirect()->route('users'),
                default => back()->withErrors([
                    'email' => 'El usuario no tiene un rol válido para ingresar al sistema.',
                ])->onlyInput('email'),
            };
        } catch (RequestException $e) {
            $response = $e->getResponse();

            if ($response) {
                $data = json_decode($response->getBody()->getContents(), true);

                return back()->withErrors([
                    'email' => $data['message'] ?? 'No fue posible iniciar sesión.',
                ])->onlyInput('email');
            }

            return back()->withErrors([
                'email' => 'No fue posible conectar con el backend.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        $token = session('access_token');

        if ($token) {
            $client = $this->apiClient();

            try {
                $client->post('/api/logout', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $token,
                    ],
                ]);
            } catch (\Throwable $e) {
            }
        }

        $request->session()->forget(['access_token', 'auth_user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string'],
            'email'     => ['required', 'email'],
            'phone'     => ['nullable', 'string'],
            'role_id'   => ['required', 'integer'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $this->apiClient()->post('api/registerDriver', [
                'headers' =>  [
                    'Accept' => 'application/json',
                ],
                'json'    => [
                    'full_name'             => $validated['full_name'],
                    'email'                 => $validated['email'],
                    'phone'                 => $validated['phone'] ?? null,
                    'role_id'               => $validated['role_id'],
                    'password'              => $validated['password'],
                    'password_confirmation' => $request->password_confirmation,
                ],
            ]);

            return redirect()->route('login')->onlyInput('email');
        } catch (RequestException $e) {
            dd($e);
            return $this->handleValidationError($e);
        }
    }
    private function handleValidationError(RequestException $e)
    {
        $response = $e->getResponse();

        if ($response) {
            $data = json_decode($response->getBody()->getContents(), true);
            return back()->withErrors($data['errors'] ?? ['general' => $data['message'] ?? 'Error al procesar.'])->withInput();
        }

        return back()->withErrors(['general' => 'No fue posible conectar con el backend.'])->withInput();
    }

    private function handleError(RequestException $e, string $redirectRoute)
    {
        $response = $e->getResponse();
        $message  = 'Error inesperado.';

        if ($response) {
            $data    = json_decode($response->getBody()->getContents(), true);
            $message = $data['message'] ?? $message;

            if ($response->getStatusCode() === 401) {
                return redirect()->route('login')->withErrors(['email' => 'Sesión expirada.']);
            }
        }

        return redirect()->route($redirectRoute)->with('error', $message);
    }
}
