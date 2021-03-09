<?php

namespace app\controllers;

use app\models\Breed;
use app\services\BreedService;
use yii\web\Controller;
use Yii;

class SiteController extends Controller
{
    public function actionIndex(): string
    {
        $service = new BreedService();
        $breed = new Breed();

        if ($breed->load(Yii::$app->request->post()) && $breed->validate()) {
            $breeds = $service->getBreedsByName($breed->getName());

            return $this->render('breeds', ['breeds' => $breeds, 'model' => $breed]);
        }

        $breeds = $service->getFiveRandomBreeds();
        return $this->render('breeds', ['breeds' => $breeds, 'model' => $breed]);
    }

    public function actionBreedDetail($id): string
    {
        $service = new BreedService();

        $breeds = $service->getBreedDetail($id);
        return $this->render('breed-detail', ['breed' => $breeds[0]]);
    }
}
