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

    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public static function createBreed($id, $name, $imageUrl) {
        $breed = new Breed();
        $breed->id = $id;
        $breed->name = $name;
        $breed->imageUrl = $imageUrl;
        return $breed;
    }

    public static function createDetailsBreed($id, $name, $imageUrl, $description, $cfaUrl, $wikipediaUrl, $origin, $temperament, $lifeSpan)
    {
        $breed = Breed::createBreed($id, $name, $imageUrl);
        $breed->description = $description;
        $breed->cfaUrl = $cfaUrl;
        $breed->wikipediaUrl = $wikipediaUrl;
        $breed->origin = $origin;
        $breed->temperament = $temperament;
        $breed->lifeSpan = $lifeSpan;
        return $breed;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getCfaUrl()
    {
        return $this->cfaUrl;
    }

    /**
     * @return mixed
     */
    public function getWikipediaUrl()
    {
        return $this->wikipediaUrl;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return mixed
     */
    public function getTemperament()
    {
        return $this->temperament;
    }

    /**
     * @return mixed
     */
    public function getLifeSpan()
    {
        return $this->lifeSpan;
    }


    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}