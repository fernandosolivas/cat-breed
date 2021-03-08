<?php

namespace app\services;


class BreedService {
    private $client;

    /**
     * BreedService constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getBreeds() {
        $breeds = $this->client->getBreeds();
        $random_keys = array_rand($breeds, 5);
        $random_breeds = [];
        foreach ($random_keys as $key) {
            $random_breeds[$key] = $breeds[$key];
        }
        return $random_breeds;
    }
}