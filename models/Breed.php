<?php

namespace app\models;

use yii\base\Model;

class Breed extends Model
{
    private $id;
    private $name;
    private $imageUrl;
    private $description;
    private $cfaUrl;
    private $wikipediaUrl;
    private $origin;
    private $temperament;
    private $lifeSpan;

    public function rules(): array
    {
        return [
            [['name'], 'required'],
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCfaUrl()
    {
        return $this->cfaUrl;
    }

    /**
     * @param mixed $cfaUrl
     */
    public function setCfaUrl($cfaUrl): void
    {
        $this->cfaUrl = $cfaUrl;
    }

    /**
     * @return mixed
     */
    public function getWikipediaUrl()
    {
        return $this->wikipediaUrl;
    }

    /**
     * @param mixed $wikipediaUrl
     */
    public function setWikipediaUrl($wikipediaUrl): void
    {
        $this->wikipediaUrl = $wikipediaUrl;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return mixed
     */
    public function getTemperament()
    {
        return $this->temperament;
    }

    /**
     * @param mixed $temperament
     */
    public function setTemperament($temperament): void
    {
        $this->temperament = $temperament;
    }

    /**
     * @return mixed
     */
    public function getLifeSpan()
    {
        return $this->lifeSpan;
    }

    /**
     * @param mixed $lifeSpan
     */
    public function setLifeSpan($lifeSpan): void
    {
        $this->lifeSpan = $lifeSpan;
    }
}