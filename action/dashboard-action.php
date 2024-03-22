<?php
//require_once __DIR__ . "/../include/db.php";
//global $PDO;

function customDateToString($timestamp): string
{
  if ($timestamp != null) {
    return date("d F Y  H:i", $timestamp);
  }
  return "Welcome in dashboard page!!!";
}

//function getCountPersonDataByAges($filter)
//{
//  global $PDO;
//  if ($filter == "allPersons"):
//    $query = "SELECT count(*) FROM persons";
//    $statement = $PDO->prepare($query);
//    $statement->execute();
//    return $statement->fetchColumn();
//  elseif ($filter == "toddler"):
//    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) <= 5 AND status = :status";
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "status" => 1
//    ));
//    return $statement->fetchColumn();
//  elseif ($filter == "child"):
//    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) > 5 AND YEAR(NOW()) - YEAR(birth_date) <= 17 AND status = :status";
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "status" => 1
//    ));
//    return $statement->fetchColumn();
//  elseif ($filter == "productiveAges"):
//    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) > 17 AND YEAR(NOW()) - YEAR(birth_date) <= 60 AND status = :status";
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "status" => 1
//    ));
//    return $statement->fetchColumn();
//  elseif ($filter == "elderly"):
//    $query = "SELECT count(*) FROM persons WHERE  YEAR(NOW()) - YEAR(birth_date) > 60 AND status = :status";
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "status" => 1
//    ));
//    return $statement->fetchColumn();
//  elseif ($filter == "passedAway"):
//    $query = "SELECT count(*) FROM persons WHERE status = :status";
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "status" => 0
//    ));
//    return $statement->fetchColumn();
//  else :
//    return null;
//  endif;
//}
