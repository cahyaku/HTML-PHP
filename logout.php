<?php
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/action/json-helper.php";

session_start();
$persons = getPersonsDataFromJson();
for ($i = 0; $i < count($persons); $i++) {
  if ($persons[$i]["email"] == $_SESSION['email']) {
    $persons[$i]["loggedIn"] = time();
    saveDataIntoJson("persons.json",$persons);
  }
}
session_unset();
session_destroy();
header('Location:login.php');
exit();
