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
            'timeout' => 15.0,
        ]);

        $this->defaultHeaders = ['x-api-key' => getenv('CAT_API_KEY')];
    }

    public function getBreeds(): array {
        $request = new Request('GET', 'breeds', $this->defaultHeaders);
        $response = $this->client->send($request);
        return json_decode($response->getBody());
    }

    public function getBreedsByName(string $name): array {
        $request = new Request('GET', 'breeds/search?q='.$name, $this->defaultHeaders);
        $response = $this->client->send($request);
        return json_decode($response->getBody());
    }

    public function getImage(string $id): ?object {
        $request = new Request('GET',  'images/'.$id);
        $response = $this->client->send($request);
        return json_decode($response->getBody());
    }

    public function getBreedImageByBreedId(string $breedId): ?object {
        $request = new Request('GET',  'images/search?breed_id='.$breedId);
        $response = $this->client->send($request);
        return json_decode($response->getBody())[0];
    }
}
?>