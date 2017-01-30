<?php

/**
 * Created by PhpStorm.
 * User: fg
 * Date: 30.01.17
 * Time: 21:05
 * перегоняет ассоциативный пхп-массив в JSON
 */
class GetJSONfromArray
{
    public static function ArrToJson($result)
    {
        $arrayStat = [];

        for ($i = 0; $i < count($result); $i++) {
            $subArrayStat = [];
            for ($l = 0; $l < count($result[$i]); $l++) {
                if (isset($result[$i][$l])) $subArrayStat[] = $result[$i][$l];
                else $subArrayStat[] = "";
            };
            $arrayStat[] = $subArrayStat;
        };

        $json = json_encode($arrayStat);
        return $json;

    }


}