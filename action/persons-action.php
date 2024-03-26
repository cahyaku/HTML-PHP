<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/constants.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;

/**
 * validate value search by age
 */
function validateSearchByAge(?string $value):?string
{
  if($value === "toddler" ||
    $value === "child" ||
    $value === "productiveAges" ||
    $value === "elderly" ||
    $value === "passedAway" ||
    $value === "allPersons"
  ){
    return $value;
  }
    return null;
}

/**
 * Function paginated data (LIMIT dan OFFSET)
 * All Persons Data
 */
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
 * Function search persons data by first name or nik.
 */
//function searchPersons($search): array
//{
//  global $PDO;
//  $query = "SELECT * FROM persons WHERE first_name LIKE '%$search%' OR nik LIKE '%$search%'";
////  $query = "SELECT * FROM persons WHERE concat(first_name, nik) LIKE '%$search%'";
//  $statement = $PDO->prepare($query);
//  $statement->execute();
//  return $statement->fetchAll(PDO::FETCH_ASSOC);
//}

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

/**
 * Get count persons data by age from database
 * @param $filter (allPerson, toddler, child, productiveAges, elderly, passesAway)
 */
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

/**
 * Paginated person data
 * @param $search (input data)
 */
function paginatedPersonsData($search, int $page, int $limit, $filter,$searchByAge): array
{
  global $PDO;
  $offset = ($page - 1) * $limit;
  if ($searchByAge != null && $filter != "") {
    $totalData = searchPersonsWithFilterByAges($filter, $limit, $offset, $search);
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
  elseif ($filter != null) {
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


/**
 * Get persons data by age
 */
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

/**
 * Search persons data by age
 */
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