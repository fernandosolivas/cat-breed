<?php

namespace app\services;

use app\builders\BreedBuilder;
use app\clients\CatApiClient;
use app\models\Breed;
use Yii;

class BreedService
{
    private CatApiClient $client;
    const DEFAULT_IMAGE_URL = 'https://user-images.githubusercontent.com/194400/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png';

    public function __construct()
    {
        $this->client = new CatApiClient();
    }

    public function getFiveRandomBreeds(): array
    {
        $breeds = $this->client->getBreeds();
        $random_keys = array_rand($breeds, 5);
        $random_breeds = [];
        foreach ($random_keys as $key) {
            $randomBreed = $breeds[$key];
            $breed = $this->createBreed($randomBreed);
            $random_breeds[$key] = $breed;
        }
        Yii::debug('retrieving five random breeds', __METHOD__);
        return $random_breeds;
    }

    public function getBreedsByName(string $name): array {
        $cachedBreeds = CacheService::getBreedsByName($name);
        if ($cachedBreeds !== null) {
            Yii::debug('retrieving breeds from cache by name '.$name, __METHOD__);
            return $cachedBreeds;
        }

        $breeds = [];
        $breedsByName = $this->client->getBreedsByName($name);
        if (count($breedsByName) > 0) {
            $breedsCount = 0;
            foreach ($breedsByName as $rawBreed) {
                $breed = $this->createBreed($rawBreed);
                $breeds[$breedsCount] = $breed;
                $breedsCount++;
            }

            Yii::debug('retrieving breeds by name '.$name, __METHOD__);
            CacheService::setBreedsByName($name, $breeds);
        }
        return $breeds;
    }

    public function getBreedDetail(string $id): array
    {
        $cachedBreed = CacheService::getBreedDetails($id);
        if ($cachedBreed != null) {
            Yii::debug('retrieving breed with details from cache by id '.$id, __METHOD__);
            return $cachedBreed;
        }

        $breeds = [];
        $breedImage = $this->client->getBreedImageByBreedId($id);
        if ($breedImage !== null) {
            $breedsCount = 0;
            foreach ($breedImage->breeds as $rawBreed) {
                $breed = $this->createBreedDetails($rawBreed, $breedImage->url);
                $breeds[$breedsCount] = $breed;
                $breedsCount++;
            }
            Yii::debug('retrieving breed with details by id '.$id, __METHOD__);
            CacheService::setBreedDetail($id, $breeds);
        }
        return $breeds;
    }

    private function getImageUrl($breed, $imageUrl): string
    {
        if ($imageUrl !== BreedService::DEFAULT_IMAGE_URL) {
            Yii::debug('using image url'.$breed->id, __METHOD__);
            return $imageUrl;
        }

        if (property_exists($breed, 'image') && property_exists($breed->image, 'url')) {
            return $breed->image->url;
        }

        if (property_exists($breed, 'reference_image_id')) {
            Yii::debug('fetching image with reference id '.$breed->reference_image_id, __METHOD__);
            $breedImage = $this->client->getImage($breed->reference_image_id);

            return $breedImage->url;
        }

        return BreedService::DEFAULT_IMAGE_URL;
    }

    private function createBreed($rawBreed): Breed
    {
        $url = $this->getImageUrl($rawBreed, BreedService::DEFAULT_IMAGE_URL);
        $builder = new BreedBuilder();
        return $builder
            ->createBreed()
            ->addId($rawBreed->id)
            ->addName($rawBreed->name)
            ->addImageUrl($url)
            ->getBreed();
    }

    private function createBreedDetails($rawBreed, $imageUrl = BreedService::DEFAULT_IMAGE_URL): Breed
    {
        $url = $this->getImageUrl($rawBreed, $imageUrl);
        $builder = new BreedBuilder();
        return $builder
            ->createBreed()
            ->addId($rawBreed->id ?? '')
            ->addName($rawBreed->name ?? '')
            ->addImageUrl($url ?? '')
            ->addDescription($rawBreed->description ?? '')
            ->addCfaUrl($rawBreed->cfa_url ?? '')
            ->addWikipediaUrl($rawBreed->wikipedia_url ?? '')
            ->addOrigin($rawBreed->origin ?? '')
            ->addTemperament($rawBreed->temperament ?? '')
            ->addLifeSpan($rawBreed->life_span ?? '')
            ->getBreed();
    }
}