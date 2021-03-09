<?php

namespace app\clients;

use app\services\CacheService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Exception;
use Yii;

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
        $cachedBreeds = CacheService::getBreeds();
        if ($cachedBreeds != null) {
            return $cachedBreeds;
        }

        try {
            $request = new Request('GET', 'breeds', $this->defaultHeaders);
            $response = $this->client->send($request);
            $breeds = json_decode($response->getBody());
            CacheService::setBreeds($breeds);
            return $breeds;
        } catch (Exception $exception) {
            Yii::error('Error when returning breeds '.$exception->getMessage());
        }
        return [];
    }

    public function getBreedsByName(string $name): array {
        try {
            $request = new Request('GET', 'breeds/search?q='.$name, $this->defaultHeaders);
            $response = $this->client->send($request);
            return json_decode($response->getBody());
        } catch (Exception $exception) {
            Yii::error('Error when returning breed by name'.$name.' error message' .$exception->getMessage());
        }
        return [];
    }

    public function getImage(string $id): ?object {
        try {
            $request = new Request('GET',  'images/'.$id);
            $response = $this->client->send($request);
            return json_decode($response->getBody());
        } catch (Exception $exception) {
            Yii::error('Error when returning image id '.$id.' error message '.$exception->getMessage());
        }
        return null;
    }

    public function getBreedImageByBreedId(string $breedId): ?object {
        $request = new Request('GET',  'images/search?breed_id='.$breedId);
        $response = $this->client->send($request);
        return json_decode($response->getBody())[0];
    }
}
?>