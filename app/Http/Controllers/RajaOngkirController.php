<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->apiKey = env('API_RAJA_ONGKIR ');
        $this->client = new Client([
            'base_uri' => 'https://api.rajaongkir.com/starter/',
        ]);
    }

    public function getProvinces()
    {
        $response = $this->client->get('province', [
            'headers' => [
                'key' => $this->apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Lakukan sesuatu dengan data yang diterima dari API
        return response()->json($data);
    }
}