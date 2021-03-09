<?php

namespace app\controllers;

use app\models\Breed;
use app\models\SearchForm;
use app\services\BreedService;
use yii\web\Controller;
use Yii;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $service = new BreedService();
        $breed = new Breed();

        if ($breed->load(Yii::$app->request->post()) && $breed->validate()) {
            $breeds = $service->getSimilarBreeds($breed->name);

            return $this->render('breeds', ['breeds' => $breeds, 'model' => $breed]);
        }

        $breeds = $service->getBreeds();
        return $this->render('breeds', ['breeds' => $breeds, 'model' => $breed]);
    }

    public function actionBreedDetail($id) {
        $service = new BreedService();

        $breeds = $service->getBreedDetail($id);
        return $this->render('breed-detail', ['breed' => $breeds[0]]);
    }
}
