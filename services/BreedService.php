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
        return $random_breeds;
    }

    public function getBreedsByName(string $name): array {
        $breeds = [];
        $breedsByName = $this->client->getBreedsByName($name);
        if (count($breedsByName) > 0) {
            $breedsCount = 0;
            foreach ($breedsByName as $rawBreed) {
                $breed = $this->createBreed($rawBreed);
                $breeds[$breedsCount] = $breed;
                $breedsCount++;
            }
        }
        return $breeds;
    }

    public function getSimilarBreeds($id): array
    {
        $breeds = [];
        $breedImage = $this->client->getBreedImage($id);
        if ($breedImage !== null) {
            $breedsCount = 0;
            foreach ($breedImage->breeds as $rawBreed) {
                $breed = $this->createBreed($rawBreed, $breedImage->url);
                $breeds[$breedsCount] = $breed;
                $breedsCount++;
            }
        }
        return $breeds;
    }

    public function getBreedDetail($id): array
    {
        $breeds = [];
        $breedImage = $this->client->getBreedImage($id);
        if ($breedImage !== null) {
            $breedsCount = 0;
            foreach ($breedImage->breeds as $rawBreed) {
                $breed = $this->createBreedDetails($rawBreed, $breedImage->url);
                $breeds[$breedsCount] = $breed;
                $breedsCount++;
            }
        }
        return $breeds;
    }

    private function getImageUrl($breed, $imageUrl): string
    {
        if ($imageUrl !== BreedService::DEFAULT_IMAGE_URL) {
            return $imageUrl;
        }

        if (property_exists($breed, 'image') && property_exists($breed->image, 'url')) {
            return $breed->image->url;
        }

        if (property_exists($breed, 'reference_image_id')) {
            $breedImage = $this->client->getBreedImage($breed->reference_image_id);

            return $breedImage->url;
        }

        return BreedService::DEFAULT_IMAGE_URL;
    }

    private function createBreed($rawBreed, string $imageUrl = BreedService::DEFAULT_IMAGE_URL): Breed
    {
        $url = $this->getImageUrl($rawBreed, $imageUrl);
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
            ->addId($rawBreed->id)
            ->addName($rawBreed->name)
            ->addImageUrl($url)
            ->addDescription($rawBreed->description)
            ->addCfaUrl($rawBreed->cfa_url)
            ->addWikipediaUrl($rawBreed->wikipedia_url)
            ->addOrigin($rawBreed->origin)
            ->addTemperament($rawBreed->temperament)
            ->addLifeSpan($rawBreed->life_span)
            ->getBreed();
    }
}