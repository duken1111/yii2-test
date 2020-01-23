<?php
/**
 * Created by PhpStorm.
 * User: DLepeshko
 * Date: 16.01.2020
 * Time: 12:44
 */

namespace app\components\helpers;


class StringHelper extends \yii\helpers\StringHelper
{
    public static function truncateByWord($string, $length, $suffix = '...', $encoding='UTF-8')
    {
        if (mb_strlen($string, $encoding) <= $length) {
            return $string;
        }

        $tmp = mb_substr($string, 0, $length, $encoding);
        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $suffix;
    }
}