<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/constants.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;

//function paginatedData($array, int $page, int $limit): array|null
//{
//  global $PDO;
////  $db = "SELECT count(*) FROM persons";
////  $s = $PDO->query($db);
////  $total_results = $s->fetchColumn();
////  $totalPage = ceil($total_results / $limit);
////  $offset = ($page - 1) * $limit;
////  $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
////  $statement = $PDO->prepare($query);
////  $statement->execute();
////  $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
////  return [
////    PAGING_TOTAL_PAGE => $totalPage,
////    PAGING_DATA => $dbArray,
////    PAGING_CURRENT_PAGE => $page,
////  ];
//
//  $totalPage = ceil((float)count($array) / (float)$limit);
//  $offset = ($page - 1) * $limit;
//  for($i = 0; $i < count($array); $i++) {
//    $birthDate = checkAges($array[$i]["birth_date"]);
//    echo "$birthDate";
////    if ($array[$i]["status"] == 0) {
////      $status = $array[$i]["status"];
////      $query = "SELECT * FROM persons WHERE status LIKE '%$status%' LIMIT $limit OFFSET $offset";
////      $statement = $PDO->prepare($query);
////      $statement->execute();
////      $array = $statement->fetchAll(PDO::FETCH_ASSOC);
////      return [
////        PAGING_TOTAL_PAGE => $totalPage,
////        PAGING_DATA => $array,
////        PAGING_CURRENT_PAGE => $page,
////      ];
////    } else
//      if ($birthDate <= 5 ) {
//      $minAges = time() - (6* (60 * 60 * 24 *365));
//      $query = "SELECT * FROM persons WHERE birth_date >= $minAges AND status = :alive LIMIT $limit OFFSET $offset";
//      $statement = $PDO->prepare($query);
//      $statement->execute([
//        "alive" => 1
//      ]);
//      $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
//      var_dump($dbArray);
//      return [
//        PAGING_TOTAL_PAGE => $totalPage,
//        PAGING_DATA => $dbArray,
//        PAGING_CURRENT_PAGE => $page,
//      ];
//    }
////    else {
////      $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
////      $statement = $PDO->prepare($query);
////      $statement->execute();
////      $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
////      return [
////        PAGING_TOTAL_PAGE => $totalPage,
////        PAGING_DATA => $dbArray,
////        PAGING_CURRENT_PAGE => $page,
////      ];
////    }
//  }
//  return null;
//}

/**
 * Function paginated data (LIMIT dan OFFSET)
 */
//function paginatedData($array, int $page, int $limit): array|null
//{
//  global $PDO;
//  $persons = [];
//  $totalPage = ceil((float)count($array) / (float)$limit);
//  $offset = ($page - 1) * $limit;
//  for ($i = 0; $i < count($array); $i++) {
//    $personData = $array[$i]['nik'];
//    $query = "SELECT * FROM persons WHERE nik LIKE '%$personData%' LIMIT $limit OFFSET $offset";
//    $statement = $PDO->prepare($query);
//    $statement->execute();
//    $result = $statement->fetch(PDO::FETCH_ASSOC);
//    $persons[] = $result;
//  }
////  var_dump($persons);
//  $sortingData = sortingDataForPagination($page, $limit, $persons);
//  return [
//    PAGING_TOTAL_PAGE => $totalPage,
//    PAGING_DATA => array_slice($persons, $sortingData["indexStart"], $sortingData["length"]),
//    PAGING_CURRENT_PAGE => $page
//  ];
////  PAGING_DATA => $persons,
////  PAGING_DATA => array_slice($persons, $sortingData["indexStart"], $sortingData["length"]),
//}

//function sortingDataForPagination(int $page, int $limit, array $array): array
//{
//  // sorting array person that will be shown for pagination
//  $indexStart = ($page - 1) * $limit;
//  $length = $limit;
//  if (($indexStart + $limit) > count($array)) {
//    $length = count($array) - $indexStart;
//  }
//  return array(
//    "length" => $length,
//    "indexStart" => $indexStart
//  );
//}

//function paginatedData($array, int $page, int $limit): array|null
//{
//  global $PDO;
//  $offset = ($page - 1) * $limit;
//  $query = "SELECT * FROM persons WHERE nik LIKE '%$array%' LIMIT $limit OFFSET $offset";
//  $statement = $PDO->prepare($query);
//  $statement->execute();
//  return $statement->fetch(PDO::FETCH_ASSOC);
//}

/**
 * Function paginated data (LIMIT dan OFFSET)
 * All Persons Data
 */
function paginatedData($array, int $page, int $limit): array
{
  $totalPage = ceil((float)count($array) / (float)$limit);
  $indexStart = ($page - 1) * $limit;
  $length = $limit;
  if (($indexStart + $limit) > count($array)) {
    $length = count($array) - $indexStart;
  }
  return [
    PAGING_TOTAL_PAGE => $totalPage,
    PAGING_DATA => array_slice($array, $indexStart, $length),
    PAGING_CURRENT_PAGE => $page,
  ];
}


/**
 * Function search persons data by first name or nik.
 */
function searchPersons($search): array
{
  global $PDO;
  $query = "SELECT * FROM persons WHERE first_name LIKE '%$search%' OR nik LIKE '%$search%'";
//  $query = "SELECT * FROM persons WHERE concat(first_name, nik) LIKE '%$search%'";
  $statement = $PDO->prepare($query);
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Check and get toddler data
 * @return array
 */
function getToddlerData($persons): array
{
  $toddler = [];
  foreach ($persons as $person) {
    if (checkAges($person["birth_date"]) <= 5 && $person["status"] != 0) {
      $toddler[] = $person;
    }
  }
  return $toddler;
}

function getToddler(): array
{
  global $PDO;
  $minAges = time() - (6 * (60 * 60 * 24 * 365));
  $query = "SELECT * FROM persons WHERE birth_date >= $minAges AND status = :alive";
  $statement = $PDO->prepare($query);
  $statement->execute([
    "alive" => 1
  ]);
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getElderly(): array
{
  global $PDO;
  $minAges = time() - (60 * (60 * 60 * 24 * 365));
  $query = "SELECT * FROM persons WHERE birth_date <= $minAges AND status = :alive";
  $statement = $PDO->prepare($query);
  $statement->execute([
    "alive" => 1
  ]);
  return $statement->fetchAll(PDO::FETCH_ASSOC);
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

function getPassedAway(): array
{
  global $PDO;
  $query = "SELECT * FROM persons WHERE status = :status";
  $statement = $PDO->prepare($query);
  $statement->execute(
    array(
      "status" => 0
    )
  );
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

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