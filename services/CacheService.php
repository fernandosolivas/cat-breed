<?php

namespace app\services;

use Yii;

class CacheService
{
    public static function getBreedsByName(string $name): ?array {
        $exists = Yii::$app->cache->redis->exists('breed-'.$name);
        if ($exists) {
            $breed = json_decode(Yii::$app->cache->redis->hget('breed-'.$name, 'breed'));
            return $breed;
        }
        return null;
    }

    public static function setBreedsByName(string $name, array $breeds): void {
        Yii::$app->cache->redis->hset('breed-'.$name, 'breed', json_encode($breeds));
    }

    public static function setBreeds(array $breeds): void
    {
        Yii::$app->cache->redis->hset('breeds', 'breed', json_encode($breeds));
    }

    public static function getBreeds(): ?array
    {
        $exists = Yii::$app->cache->redis->exists('breeds');
        if ($exists) {
            return json_decode(Yii::$app->cache->redis->hget('breeds', 'breed'));
        }
        return null;
    }

    public static function getBreedDetails(string $id): ?array
    {
        $exists = Yii::$app->cache->redis->exists('breed-detail-'.$id);
        if ($exists) {
            return json_decode(Yii::$app->cache->redis->hget('breed-detail-'.$id, 'breed'));
        }
        return null;
    }

    public static function setBreedDetail(string $id, array $breeds): void
    {
        Yii::$app->cache->redis->hset('breed-detail-'.$id, 'breed', json_encode($breeds));
    }
}