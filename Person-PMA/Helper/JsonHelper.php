<?php

namespace App\Helper;
class JsonHelper
{
    static function saveDataIntoJson(array $array, string $fileName)
    {
        $json = json_encode($array, JSON_PRETTY_PRINT);
        $array = file_put_contents($fileName, $json);
    }

    static function loadDataFromJson(string $fileName): array
    {
        if (file_exists($fileName)) {
            $data = file_get_contents($fileName);
            $result = json_decode($data, true);
            return $result;
        }
        return [];
    }
}