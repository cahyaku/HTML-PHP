<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/constants.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;

function paginatedData($array, int $page, int $limit): array
{
  global $PDO;
  $db = "SELECT count(*) FROM persons";
  $s = $PDO->query($db);
  $total_results = $s->fetchColumn();
  $totalPage = ceil($total_results / $limit);

  $offset = ($page - 1) * $limit;
  $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
  $statement = $PDO->prepare($query);
  $statement->execute();
  $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);

  return [
    PAGING_TOTAL_PAGE => $totalPage,
    PAGING_DATA => $dbArray,
    PAGING_CURRENT_PAGE => $page,
  ];
}

//function paginatedData($array, int $page, int $limit): array|null
//{
//    global $PDO;
//    $db = "SELECT count(*) FROM persons";
//    $s = $PDO->query($db);
//    $total_results = $s->fetchColumn();
////    $totalPage = ceil($total_results / $limit);
//
//    for($i = 0; $i < count($array); $i++) {
//      $totalPage = ceil((float)count($array) / (float)$limit);
//      $offset = ($page - 1) * $limit;
//      $birthDate = $array[$i]["birth_date"];
//      $query = "SELECT * FROM persons WHERE birth_date LIKE '%$birthDate%' LIMIT $limit OFFSET $offset";
//      $statement = $PDO->prepare($query);
//      $statement->execute();
//      $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//      return [
//        PAGING_TOTAL_PAGE => $totalPage,
//        PAGING_DATA => $dbArray,
//        PAGING_CURRENT_PAGE => $page,
//      ];
//    }
////  if (isset($array)) {
////    for($i = 0; $i < count($array); $i++) {
////      $birthDate = $array[$i]["status"];
////      $query = "SELECT * FROM persons WHERE birth_date LIKE '%$birthDate%' LIMIT $limit OFFSET $offset";
////      $statement = $PDO->prepare($query);
////      $statement->execute();
////      $array = $statement->fetchAll(PDO::FETCH_ASSOC);
////    }
////    return [
////      PAGING_TOTAL_PAGE => $totalPage,
////      PAGING_DATA => $array,
////      PAGING_CURRENT_PAGE => $page,
////    ];
////  } else {
////    $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
////    $statement = $PDO->prepare($query);
////    $statement->execute();
////    $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
////    return [
////      PAGING_TOTAL_PAGE => $totalPage,
////      PAGING_DATA => $dbArray,
////      PAGING_CURRENT_PAGE => $page,
////    ];
////  }
//  return null;
//}

//function paginatedData($array, int $page, int $limit): array
//{
//  $totalPage = ceil((float)count($array) / (float)$limit);
//  $indexStart = ($page - 1) * $limit;
//  $length = $limit;
//  if (($indexStart + $limit) > count($array)) {
//    $length = count($array) - $indexStart;
//  }
//  return [
//    PAGING_TOTAL_PAGE => $totalPage,
//    PAGING_DATA => array_slice($array, $indexStart, $length),
//    PAGING_CURRENT_PAGE => $page,
//  ];
//}

/**
 * Search person data by first name or NIK
 */
//function searchPersons($search, ?array $persons = null): array
//{
//  if ($persons == null) {
//    $persons = getPersonsDataFromDatabase();
//  }
//  $searchResult = [];
//  foreach ($persons as $person => $value) {
//    if (preg_match("/$search/i", $value["first_name"])) {
//      if (in_array($value["first_name"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
//    if (preg_match("/$search/i", $value["nik"])) {
//      if (in_array($value["nik"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
//  }
//  return $searchResult;
//}

/**
 * Function search persons data by first name or nik.
 */
function searchPersons($search, ?array $persons = null): array|null
{
  global $PDO;
//      $query = "SELECT * FROM persons WHERE first_name LIKE '%$search%' OR nik LIKE '%$search%'";
  $query = "SELECT * FROM persons WHERE concat(first_name, nik) LIKE '%$search%'";
  $statement = $PDO->prepare($query);
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//function getProductiveAgesData(): array
//{
//  $persons = getPersonsDataFromJson();
//  $productiveAges = [];
//  foreach ($persons as $person) {
//    if (checkAges($person["birthDate"]) >= 6 && checkAges($person["birthDate"]) <= 60 && $person["alive"] != null) {
//      $productiveAges[] = $person;
//    }
//  }
//  return $productiveAges;
//}

/**
 * Check and get toddler data
 * @return array
 */
function getToddlerData(?array $persons = null): array
{
//  if ($persons == null) {
//    $persons = getPersonsDataFromDatabase();
//  }
  $toddler = [];
  foreach ($persons as $person) {
    if (checkAges($person["birth_date"]) <= 5 && $person["status"] != 0) {
      $toddler[] = $person;
    }
  }
  return $toddler;
}

/**
 * Get passed away data
 */
function getPassedAwayData($persons): array
{
  $passedAway = [];
  foreach ($persons as $person) {
    if ($person["status"] == 0) {
      $passedAway[] = $person;
    }
  }
  return $passedAway;
}

/**
 * Get productive ages data
 * @return array
 */
function getProductiveAgesData($persons): array
{
  $productiveAges = [];
  foreach ($persons as $person) {
    if (checkAges($person["birth_date"]) >= 6 && checkAges($person["birth_date"]) <= 60 && $person["status"] != 0) {
      $productiveAges[] = $person;
    }
  }
  return $productiveAges;
}

/**
 * Get elderly data
 * @return array
 */
function getElderlyData(?array $persons = null): array
{
  $elderly = [];
  foreach ($persons as $person) {
    if (checkAges($person["birth_date"]) > 60 && $person["status"] != 0) {
      $elderly[] = $person;
    }
  }
  return $elderly;
}

/**
 * Check and get person age by date of birth
 */
function checkAges($birthDate): int
{
  $date = date("d-m-Y", $birthDate);
  list($day, $month, $year) = explode('-', $date);
  $born = mktime(0, 0, 0, (int)$day, (int)$month, $year); //hour,minute,second,date,month,year
  $t = time();
  $age = ($born < 0) ? ($t + ($born * -1)) : $t - $born;
  $years = 60 * 60 * 24 * 365;
  $yearOfBirthDate = $age / $years;
  return floor($yearOfBirthDate);
}