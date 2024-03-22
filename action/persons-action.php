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
function paginatedDataFromDatabase($array, int $page, int $limit): array|null
{
  global $PDO;
//  $persons = [];
  $totalPage = ceil((float)count($array) / (float)$limit);
  $offset = ($page - 1) * $limit;
  for ($i = 0; $i < count($array); $i++) {
    $personData = $array[$i]['nik'];
    $query = "SELECT * FROM persons WHERE nik LIKE '%$personData%' LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
//    $persons[] = $result;
  }
//  $totalPage = ceil((float)count($array)/ (float)$limit);

//  var_dump($persons);
//  $sortingData = sortingDataForPagination($page, $limit, $persons);
  return [
    PAGING_TOTAL_PAGE => $totalPage,
    PAGING_DATA => $result,
    PAGING_CURRENT_PAGE => $page,
  ];
//  PAGING_DATA => $persons,
//  PAGING_DATA => array_slice($persons, $sortingData["indexStart"], $sortingData["length"]),
}

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
  $birthDateTimestamp = strtotime($birthDate);
  $date = date("d-m-Y", $birthDateTimestamp);
  list($day, $month, $year) = explode('-', $date);
  $born = mktime(0, 0, 0, (int)$day, (int)$month, $year); //hour,minute,second,date,month,year
  $t = time();
  $age = ($born < 0) ? ($t + ($born * -1)) : $t - $born;
  $years = 60 * 60 * 24 * 365;
  $yearOfBirthDate = $age / $years;
  return floor($yearOfBirthDate);
}

//Refactor function get all person when filter persons data
function getPassedAway(?array $persons = null): array
{
  global $PDO;
  if ($persons == null) {
    $query = "SELECT * FROM persons WHERE status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(
      array(
        "status" => 0
      )
    );
    $persons = $statement->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $query = "SELECT * FROM persons WHERE status = :status AND id = :person_id";
    $statement = $PDO->prepare($query);
    $statement->execute(
      array(
        "status" => 0,
        "person_id" => $persons['id']
      )
    );
    $persons = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  return $persons;
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

//function getElderly(): array
//{
//  global $PDO;
//  $minAges = time() - (15 * (60 * 60 * 24 * 365));
//  $query = "SELECT * FROM persons WHERE birth_date >= $minAges AND status = :alive";
//  $statement = $PDO->prepare($query);
//  $statement->execute([
//    "alive" => 1
//  ]);
//  return $statement->fetchAll(PDO::FETCH_ASSOC);
//}

//$max = time() - (15 * (60 * 60 * 24 * 365));
//$min = time() - (64 * (60 * 60 * 24 * 365));
//$query = 'SELECT count(*) FROM Persons WHERE birth_date < :time AND alive = :alive';
//$statement = $PDO->prepare($query);
//$statement->execute(array(
//  'time' => $min,
//  'alive' => 1
//));

//function paginatedPersonsData($search, int $page, int $limit, ?string $filter = null): array
//{
//  global $PDO;
//  $offset = ($page - 1) * $limit;
//
//  if ($search != null) {
//    $queryData = "SELECT count(*) FROM persons WHERE first_name LIKE '%$search%' or nik LIKE '%$search%'";
//    $statementData = $PDO->query($queryData);
//    $totalData = $statementData->fetchColumn();
//
//    $query = "SELECT * FROM persons WHERE first_name LIKE '%$search%' or nik LIKE '%$search%' LIMIT $limit OFFSET $offset";
//    $statement = $PDO->prepare($query);
//    $statement->execute();
//    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//  } else {
//    $queryData = 'SELECT count(*) FROM persons';
//    $statementData = $PDO->query($queryData);
//    $totalData = $statementData->fetchColumn();
//
//    $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
//    $statement = $PDO->prepare($query);
//    $statement->execute();
//    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//  }
//  if ($filter != null) {
//    $totalData = getPersonDataByFilter($filter);
//    $result = getSearchResultByFilter($filter, $limit, $offset);
//  }
//  $totalPage = ceil((float)$totalData / (float)$limit);
//  return [
//    PAGING_TOTAL_PAGE => $totalPage,
//    PAGING_DATA => $result,
//    PAGING_CURRENT_PAGE => $page,
//  ];
//}

function getPersonDataByFilter($filter)
{
  global $PDO;
  $max = time() - (5 * (60 * 60 * 24 * 365));
  $min = time() - (100 * (60 * 60 * 24 * 365));
  if ($filter == "productiveAges") {
    $query = "SELECT count(*) FROM persons WHERE birth_date >= :min AND birth_date <= :max AND status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'min' => $min,
      'max' => $max,
      'status' => 1
    ));
    return $statement->fetchColumn();
  } elseif ($filter == "toddler") {
    $query = 'SELECT count(*) FROM persons WHERE birth_date < :time AND status = :status';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'time' => $min,
      'status' => 1
    ));
    return $statement->fetchColumn();
  } elseif ($filter == "passedAway") {
    $query = 'SELECT count(*) FROM persons WHERE status = :status';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'status' => 0
    ));
    return $statement->fetchColumn();
  } elseif ($filter == "elderly") {
    $query = 'SELECT count(*) FROM persons WHERE birth_date < :time status = :status';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'time' => $min,
      'status' => 1
    ));
    return $statement->fetchColumn();
  } elseif ($filter == "allPersons") {
    $query = "SELECT count(*) FROM persons";
    $statement = $PDO->query($query);
    $statement->execute();
    return $statement->fetchColumn();
  } else {
    return null;
  }
}

function getSearchResultByFilter($filter, $limit, $offset): array|null
{
  global $PDO;
  $max = time() - (5 * (60 * 60 * 24 * 365));
  $min = time() - (60 * (60 * 60 * 24 * 365));
  if ($filter == "productiveAges") {
    $query = "SELECT * FROM persons WHERE birth_date >= :min AND birth_date <= :max AND alive = :alive LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'min' => $min,
      'max' => $max,
      'status' => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  } elseif ($filter == "toddler") {
    $query = "SELECT * FROM persons WHERE birth_date < :time AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'time' => $min,
      'status' => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  } elseif ($filter == "passedAway") {
    $query = "SELECT * FROM persons WHERE status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'status' => 0
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  } elseif ($filter == "elderly") {
    $query = "SELECT * FROM persons WHERE birth_date < :time AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      'time' => $min,
      'status' => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  } else if ($filter == "allPersons") {
    $query = "SELECT * FROM persons LIMIT $limit OFSSET $offset";
    $statement = $PDO->query($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  return null;
}

// ini filter dengan menggunakan query(mendapatkan jumlah data dari masing" kategori)
function getCountPersonDataByAges($filter)
{
  global $PDO;
  if ($filter == "allPersons"):
    $query = "SELECT count(*) FROM persons";
    $statement = $PDO->prepare($query);
    $statement->execute();
    return $statement->fetchColumn();
  elseif ($filter == "toddler"):
    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) <= 5 AND status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchColumn();
  elseif ($filter == "child"):
    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) > 5 AND YEAR(NOW()) - YEAR(birth_date) <= 17 AND status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchColumn();
  elseif ($filter == "productiveAges"):
    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) > 17 AND YEAR(NOW()) - YEAR(birth_date) <= 60 AND status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchColumn();
  elseif ($filter == "elderly"):
    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) > 60 AND status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchColumn();
  elseif ($filter == "passedAway"):
    $query = "SELECT count(*) FROM persons WHERE status = :status";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 0
    ));
    return $statement->fetchColumn();
  else :
    return null;
  endif;
}

function paginatedPersonsData($search, int $page, int $limit, $filter,$searchByAge): array
{
  global $PDO;
  $offset = ($page - 1) * $limit;
  if ($searchByAge != null && $filter != "") {
//    $totalData = getPersonDataByFilter($filter);
    $totalData =getCountPersonDataByAges($filter);
    $result = searchPersonsWithFilterByAges($filter, $limit, $offset, $search);
  }
  elseif ($search != null) {
    $queryData = "SELECT count(*) FROM persons WHERE first_name LIKE '%$search%' or nik LIKE '%$search%'";
    $statementData = $PDO->query($queryData);
    $totalData = $statementData->fetchColumn();

    $query = "SELECT * FROM persons WHERE first_name LIKE '%$search%' or nik LIKE '%$search%' LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  elseif ($filter != "") {
    $totalData = getCountPersonDataByAges($filter);
    $result = getPersonsDataByAges($filter, $limit, $offset);
  } else {
    $queryData = 'SELECT count(*) FROM persons';
    $statementData = $PDO->query($queryData);
    $totalData = $statementData->fetchColumn();
    
    $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  
  $totalPage = ceil((float)$totalData / (float)$limit);
  return [
    PAGING_TOTAL_PAGE => $totalPage,
    PAGING_DATA => $result,
    PAGING_CURRENT_PAGE => $page,
  ];
}

function getPersonsDataByAges($filter, $limit, $offset): array|null
{
  global $PDO;
  if ($filter == "allPersons"):
    $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "toddler"):
    $query = "SELECT * FROM persons WHERE YEAR(NOW()) - YEAR(birth_date) <= 5 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "child"):
    $query = "SELECT * FROM persons WHERE YEAR(NOW()) - YEAR(birth_date) >= 6 AND YEAR(NOW()) - YEAR(birth_date) <= 17 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "productiveAges"):
    $query = "SELECT * FROM persons WHERE YEAR(NOW()) - YEAR(birth_date) > 17 AND YEAR(NOW()) - YEAR(birth_date) <= 60 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "elderly"):
    $query = "SELECT * FROM persons WHERE YEAR(NOW()) - YEAR(birth_date) > 60 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "passedAway"):
    $query = "SELECT * FROM persons WHERE status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 0
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  else :
    return null;
  endif;
}

function searchPersonsWithFilterByAges($filter, $limit, $offset, $search): array|null
{
  global $PDO;
  if ($filter == "allPersons"):
    $query = "SELECT * FROM persons WHERE (first_name LIKE '%$search%' or nik LIKE '%$search%') LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
    elseif ($filter == "toddler"):
    $query = "SELECT * FROM persons WHERE (first_name LIKE '%$search%' or nik LIKE '%$search%') AND YEAR(NOW()) - YEAR(birth_date) <= 5 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "child"):
    $query = "SELECT * FROM persons WHERE (first_name LIKE '%$search%' or nik LIKE '%$search%') AND YEAR(NOW()) - YEAR(birth_date) > 5 AND YEAR(NOW()) - YEAR(birth_date) <= 17 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "productiveAges"):
    $query = "SELECT * FROM persons WHERE (first_name LIKE '%$search%' or nik LIKE '%$search%')  AND YEAR(NOW()) - YEAR(birth_date) > 17 AND YEAR(NOW()) - YEAR(birth_date) <= 60 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "elderly"):
    $query = "SELECT * FROM persons WHERE (first_name LIKE '%$search%' or nik LIKE '%$search%') AND YEAR(NOW()) - YEAR(birth_date) > 60 AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 1
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  elseif ($filter == "passedAway"):
    $query = "SELECT * FROM persons WHERE (first_name LIKE '%$search%' or nik LIKE '%$search%') AND status = :status LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "status" => 0
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  else :
    return null;
  endif;
}