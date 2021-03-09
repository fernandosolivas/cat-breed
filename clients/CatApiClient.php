<?php

namespace app\clients;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class CatApiClient {
    private Client $client;
    private $defaultHeaders;

    function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://api.thecatapi.com/v1/',
            'timeout' => 10.0,
        ]);

        $this->defaultHeaders = ['x-api-key' => getenv('CAT_API_KEY')];
    }

    public function getBreeds(): array {
        $request = new Request('GET', 'breeds', $this->defaultHeaders);
        $response = $this->client->send($request);
        return json_decode($response->getBody());
    }

    public function getBreedImage($id): ?object {
        $request = new Request('GET',  'images/search?breed_id='.$id);
        $response = $this->client->send($request);
        if (is_array($response->getBody()) &&  count((array) $response->getBody()) > 0 ) {
            return json_decode($response->getBody())[0];
        }
        return null;
    }
}
?>