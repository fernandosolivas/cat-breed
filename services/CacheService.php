<?php
use Yii;

namespace app\services;


class CacheService
{
    public function getSimilarBreed($id): array {
        $cachedSimilarBreeds = Yii::$app->cache->redis->get('similar-breed-'.$id);
    }
}