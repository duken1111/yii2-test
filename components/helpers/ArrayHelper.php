<?php

namespace app\components\helpers;


class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * @param array $array
     * @param array $keysToDelete
     * @return array
     */
    public static function removeKeys(array $array, array $keysToDelete): array
    {
        foreach ($keysToDelete as $key) {
            if (array_key_exists($key, $array)) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}