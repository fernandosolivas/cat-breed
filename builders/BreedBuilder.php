<?php
namespace app\builders;

use app\models\Breed;

class BreedBuilder
{
    private Breed $breed;

    public function createBreed(): BreedBuilder {
        $this->breed = new Breed();
        return $this;
    }

    public function addId(string $id): BreedBuilder {
        $this->breed->setId($id);
        return $this;
    }

    public function addName(string $name): BreedBuilder {
        $this->breed->setName($name);
        return $this;
    }

    public function addImageUrl(string $imageUrl): BreedBuilder {
        $this->breed->setImageUrl($imageUrl);
        return $this;
    }

    public function addDescription(string $description): BreedBuilder {
        $this->breed->setDescription($description);
        return $this;
    }

    public function addCfaUrl(string $cfaUrl): BreedBuilder {
        $this->breed->setCfaUrl($cfaUrl);
        return $this;
    }

    public function addWikipediaUrl(string $wikipediaUrl): BreedBuilder {
        $this->breed->setWikipediaUrl($wikipediaUrl);
        return $this;
    }

    public function addOrigin(string $origin): BreedBuilder {
        $this->breed->setOrigin($origin);
        return $this;
    }

    public function addTemperament(string $temperament): BreedBuilder {
        $this->breed->setTemperament($temperament);
        return $this;
    }

    public function addLifeSpan(string $lifeSpan): BreedBuilder {
        $this->breed->setLifeSpan($lifeSpan);
        return $this;
    }

    public function getBreed(): Breed {
        return $this->breed;
    }
}