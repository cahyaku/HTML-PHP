<?php
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/action/json-helper.php";
require_once __DIR__ . "/include/db.php";
global $PDO;

session_start();
//$persons = getPersonsDataFromJson();
//for ($i = 0; $i < count($persons); $i++) {
//  if ($persons[$i]["email"] == $_SESSION['email']) {
//    $persons[$i]["loggedIn"] = time();
//    saveDataIntoJson("persons.json",$persons);
//  }
//}


$person = getPersonDataByEmailFromDatabase($_SESSION["email"]);
if (intval($person["id"])) {
  $query = 'SELECT * FROM persons WHERE id = :id LIMIT 1';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "id" => $person["id"]
  ));
  
  if ($statement->rowCount() == 1) {
    $person = $statement->fetch(PDO::FETCH_ASSOC);
    $query = 'UPDATE persons SET logged_in = :logged_in WHERE id = :id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "id" => $person["id"],
      "logged_in" => time()
    ));
  }
}
session_unset();
session_destroy();
header('Location:login.php');
die();