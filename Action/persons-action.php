<?php

//echo $_POST["searchPerson"];

$search = $_POST["searchPerson"];
function search(string $search): array
{
    $persons = loadDataFromJson("persons.json");
    $searchResult = [];
    foreach ($persons as $person => $value) {
        if (preg_match("/$search/i", $value["firstName"])) {
            if (in_array($value["firstName"], $searchResult) == false) {
                $searchResult[] = $value;
            }
        }
        if (preg_match("/$search/i", $value["lastName"])) {
            if (in_array($value["lastName"], $searchResult) == false) {
                $searchResult[] = $value;
            }
        }
        if (preg_match("/$search/i", $value["nik"])) {
            if (in_array($value["nik"], $searchResult) == false) {
                $searchResult[] = $value;
            }
        }
    }
    return $searchResult;
}

//function searchPerson(): array|null
//{
//    $persons = loadDataFromJson("persons.json");
//    $search = $_GET['search'];
//    $results = [];
//    $resultsByNik = [];
//    if (isset($search)) {
//        foreach ($persons as $value) {
//            if (preg_match("/$search[0]/i", $value["firstName"]) == 1) {
//                $results [] = $value;
//            }
//        }
//
//        foreach ($persons as $value) {
//            if (preg_match("/$search[0]/i", $value["nik"]) == 1) {
//                $resultsByNik[] = $value;
//            }
//        }
//
//        foreach ($resultsByNik as $result) {
//            if (in_array($result, $results) == 0) {
//                $results[] = $result;
//            }
//        }
//
//        if (count($results) != null) {
//            return $results;
//        }
//    }
//    return null;
//}