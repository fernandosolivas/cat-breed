<?php

namespace app\services;

use app\clients\CatApiClient;
use app\models\Breed;

class BreedService {
    private $client;
    const DEFAULT_IMAGE_URL ='https://user-images.githubusercontent.com/194400/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png' ;

    public function __construct()
    {
        $this->client = new CatApiClient();
    }

    public function getBreeds() {
        $breeds = $this->client->getBreeds();
        $random_keys = array_rand($breeds, 5);
        $random_breeds = [];
        foreach ($random_keys as $key) {
            $randomBreed = $breeds[$key];
            $breed = $this->createBreed($randomBreed);
            $random_breeds[$key] = $breed;
        }
        return $random_breeds;
    }

    public function getSimilarBreeds($id) {
        $breedImage = $this->client->getBreedImage($id);
        $breeds = [];
        $breedsCount = 0;
        foreach ($breedImage->breeds as $rawBreed) {
            $breed = $this->createBreed($rawBreed, $breedImage->url);
            $breeds[$breedsCount] = $breed;
            $breedsCount++;
        }
        return $breeds;
    }

    public function getBreedDetail($id)
    {
        $breedImage = $this->client->getBreedImage($id);
        $breeds = [];
        $breedsCount = 0;
        foreach ($breedImage->breeds as $rawBreed) {
            $breed = $this->createBreedDetails($rawBreed, $breedImage->url);
            $breeds[$breedsCount] = $breed;
            $breedsCount++;
        }
        return $breeds;
    }

    private function getImage($breed, $imageUrl) {
        if ($imageUrl !== BreedService::DEFAULT_IMAGE_URL) {
            return $imageUrl;
        }
        if (property_exists($breed, 'image') && property_exists($breed->image, 'url')) {
            return $breed->image->url;
        }
        return BreedService::DEFAULT_IMAGE_URL;
    }

    private function createBreed($rawBreed, $imageUrl = BreedService::DEFAULT_IMAGE_URL)
    {
        $url = $this->getImage($rawBreed, $imageUrl);
        return Breed::createBreed($rawBreed->id, $rawBreed->name, $url);
    }

    private function createBreedDetails($rawBreed, $imageUrl = BreedService::DEFAULT_IMAGE_URL)
    {
        $url = $this->getImage($rawBreed, $imageUrl);
        return Breed::createDetailsBreed(
            $rawBreed->id,
            $rawBreed->name,
            $url,
            $rawBreed->description,
            $rawBreed->cfa_url,
            $rawBreed->wikipedia_url,
            $rawBreed->origin,
            $rawBreed->temperament,
            $rawBreed->life_span,
        );
    }
}