<?php
function saveDataIntoJson(array $array)
{
  $json = json_encode($array, JSON_PRETTY_PRINT);
  file_put_contents(__DIR__ . "/../persons.json", $json);
}

function loadDataFromJson(string $fileName): array
{
  $path = __DIR__ . "/../" . $fileName;
  if (file_exists($path)) {
    $data = file_get_contents($path);
    $results = json_decode($data, true);
    if ($results == null) {
      return [];
    }
    return $results;
  }
  return [];
}

//function saveDataIntoJson(array $array)
//{
//  $path = __DIR__ . "/../persons.json";
//  if (file_exists($path)) {
//    $json = json_encode($array, JSON_PRETTY_PRINT);
//    $array = file_put_contents($path, $json);
//  }
//}

