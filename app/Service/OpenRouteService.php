<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OpenRouteService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://api.openrouteservice.org/']);
        $this->apiKey = env('ORS_API_KEY'); // Tambahkan API key di .env file
    }

    public function getRoutePolyline($start, $end)
    {
        try {
            $response = $this->client->get('v2/directions/driving-car', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'start' => $start['lng'] . ',' . $start['lat'],
                    'end' => $end['lng'] . ',' . $end['lat'],
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            // Log::debug($data);
            // Ambil polyline dari response
            
            $coordinates = $data['features'][0]['geometry']['coordinates'];
            $reverseCoordinate =  array_map(function ($coordinate) {
                return [$coordinate[1], $coordinate[0]];  // [latitude, longitude]
            }, $coordinates);
            return $reverseCoordinate;
        } catch (\Exception $e) {
            Log::error('Error fetching route polyline: ' . $e->getMessage());
            throw new Exception('Error fetching route polyline: ' . $e->getMessage());
        }
    }
}
