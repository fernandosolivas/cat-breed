<?php

namespace app\clients;

use app\services\CacheService;
use codemix\yii2confload\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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

        $this->defaultHeaders = ['x-api-key' => Config::env('CAT_API_KEY', 'host.docker.internal')];
    }

    public function getBreeds(): array {
        $cachedBreeds = CacheService::getBreeds();
        if ($cachedBreeds != null) {
            Yii::debug('retrieving breeds from cache', __METHOD__);
            return $cachedBreeds;
        }

        try {
            $request = new Request('GET', 'breeds', $this->defaultHeaders);
            $response = $this->client->send($request);
            $breeds = json_decode($response->getBody());
            CacheService::setBreeds($breeds);
            Yii::debug('retrieving breeds', __METHOD__);
            return $breeds;
        } catch (Exception $exception) {
            Yii::error('Error when returning breeds '.$exception->getMessage(), __METHOD__);
        }
        return [];
    }

    public function getBreedsByName(string $name): array {
        try {
            Yii::debug('retrieving breeds by name '.$name, __METHOD__);
            $request = new Request('GET', 'breeds/search?q='.$name, $this->defaultHeaders);
            $response = $this->client->send($request);
            return json_decode($response->getBody());
        } catch (GuzzleException $exception) {
            Yii::error('Error when returning breed by name'.$name.' error message' .$exception->getMessage(), __METHOD__);
        }
        return [];
    }

    public function getImage(string $id): ?object {
        try {
            Yii::debug('retrieving image from id '.$id, __METHOD__);
            $request = new Request('GET',  'images/'.$id);
            $response = $this->client->send($request);
            return json_decode($response->getBody());
        } catch (GuzzleException $exception) {
            Yii::error('Error when returning image id '.$id.' error message '.$exception->getMessage(), __METHOD__);
        }
        return null;
    }

    public function getBreedImageByBreedId(string $breedId): ?object {
        try {
            Yii::debug('retrieving breed image from breedId '.$breedId, __METHOD__);
            $request = new Request('GET',  'images/search?breed_id='.$breedId);
            $response = $this->client->send($request);
            return json_decode($response->getBody())[0];
        } catch (GuzzleException $exception) {
            Yii::error('Error when returning breedImage from breedId '.$breedId.' error message '.$exception->getMessage(), __METHOD__);
        }
        return null;
    }
}
?>