<?php

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