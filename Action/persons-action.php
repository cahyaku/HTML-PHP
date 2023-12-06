<?php

//require_once __DIR__ . "/persons-action.php";
//require_once __DIR__ . "/login-action.php";
require_once __DIR__ . "/json.php";


//echo $_POST["searchPerson"];

//$search = $_POST["searchPerson"];
function search($search):array
{
//  $search = $_GET['search'];
  $persons = personData();
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

function searchPerson()
{
  $persons = loadDataFromJson("persons.json");
  $search = $_GET['search'];
  $results = [];
  $resultsByNik = [];
  if (isset($search)) {
    foreach ($persons as $value) {
      if (preg_match("/$search[0]/i", $value["firstName"]) == 1) {
        $results [] = $value;
      }
    }
    
    foreach ($persons as $value) {
      if (preg_match("/$search[0]/i", $value["nik"]) == 1) {
        $resultsByNik[] = $value;
      }
    }
    
    foreach ($resultsByNik as $result) {
      if (in_array($result, $results) == 0) {
        $results[] = $result;
      }
    }
    
    if (count($results) != null) {
      return $results;
    }
  }
  return null;
}

//function personsData ()
//{
////    $searchInput = $_GET["search"];
//    $persons = search($_GET["search"]);
//    for ($i = 0; $i < count($persons); $i++) :
//    return $persons[$i];
//    endfor;
//  return $persons[$i];
//}

function personData() {
  return $person = loadDataFromJson("persons.json");
}