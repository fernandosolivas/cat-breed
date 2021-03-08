<?php

namespace app\controllers;

use app\clients\CatApiClient;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $client = new CatApiClient();
        $breeds = $client->getBreeds();

        return $this->render('breeds', ['breeds' => $breeds]);
    }

    public function actionBreedDetail($id) {
        $client = new CatApiClient();

        $breedImage = $client->getBreedImage($id);
        return $this->render('breed-detail', ['imageUrl' => $breedImage->url, 'breed' => $breedImage->breeds[0]]);
    }
}
