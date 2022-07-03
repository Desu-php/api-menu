<?php

namespace App\Helpers;

class SeederHelper
{
    public static function firstOrCreate($model, $data, $filterKey = 'name', $callback = null)
    {
        self::query('firstOrCreate', $model, $data, $filterKey, $callback);
    }

    public static function updateOrCreate($model, $data, $filterKey = 'name', $callback = null)
    {
        self::query('updateOrCreate', $model, $data, $filterKey, $callback);
    }

    private static function query($method,$model, $data, $filterKey = 'name', $callback = null)
    {
        foreach ($data as $datum) {
            $tempModel = $model::$method([
                $filterKey => $datum[$filterKey]
            ], $datum);

            if ($callback) {
                $callback($tempModel);
            }
        }
    }
}
