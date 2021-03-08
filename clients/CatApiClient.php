<?php

namespace app\clients;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class CatApiClient {
    private $client;
    private $defaultHeaders;

    function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://api.thecatapi.com/v1/',
            'timeout' => 10.0,
        ]);

        $this->defaultHeaders = ['x-api-key' => 'ea8a3bdd-07dc-4310-86ea-358f1ef9b0df'];
    }

    public function getBreeds() {
        $request = new Request('GET', 'breeds', $this->defaultHeaders);
        $response = $this->client->send($request);
        return json_decode($response->getBody());
    }

    public function getBreedImage($id) {
        $request = new Request('GET',  'images/search?breed_id='.$id);
        $response = $this->client->send($request);
        return json_decode($response->getBody())[0];
    }
}
?>