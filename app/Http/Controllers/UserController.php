<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {

        $client = new Client([
            'base_uri' => config('services.api.url'),
            'timeout'  => 10,
        ]);

        try {
            $response = $client->get('/api/users', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('access_token'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return view('users.general', [
                'users' => $data['data']['data']
            ]);
        } catch (RequestException $e) {
            $response = $e->getResponse();

            return back()->withErrors([
                'email' => 'No fue posible conectar con la API.',
            ])->withInput();
        }
    }
}
