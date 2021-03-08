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

}