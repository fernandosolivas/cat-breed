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
            Yii::debug('filtering breeds by name '.$breed->getName(), __METHOD__);

            $breeds = $service->getBreedsByName($breed->getName());

            Yii::debug(''.count($breeds).' found with name '.$breed->getName(), __METHOD__);
            return $this->render('breeds', ['breeds' => $breeds, 'model' => $breed]);
        }

        $breeds = $service->getFiveRandomBreeds();
        Yii::info('retrieving five random breeds', __METHOD__);
        return $this->render('breeds', ['breeds' => $breeds, 'model' => $breed]);
    }

    public function actionBreedDetail(string $id): string
    {
        $service = new BreedService();

        $breeds = $service->getBreedDetail($id);
        Yii::debug('retrieving breed details', __METHOD__);
        return $this->render('breed-detail', ['breed' => $breeds[0]]);
    }
}
