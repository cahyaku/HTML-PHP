<?php
require_once __DIR__ . "/Action/common-action.php";
require_once __DIR__ . "/Action/json.php";

session_start();
//if (!isset($_SESSION['email'])) {
//  header("Location: login.php");
//  exit();
//}
//if (isset($_SESSION['email'])) {
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($persons[$i]["email"] == $_SESSION['email']) {
      $persons[$i]["loggedIn"] = time();
      saveDataIntoJson($persons);
    }
  }
//  return null;
//}
session_unset();
session_destroy();
header('Location:login.php');
exit();
