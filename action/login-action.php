<?php
session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ ."/../include/db.php";
global $PDO;

$loginData = getPersonsDataByEmailFromDatabase($_POST['email']);
function validateData($data)
{
  for ($i = 0; $i < count($data); $i++) {
    if ($data[$i]["email"] == $_POST['email'] && password_verify($_POST['password'], $data[$i]["password"]) && $data[$i]["status"] != 0) {
      return $data[$i];
    }
  }
  return null;
}

//$loginData = loadDataFromJson("persons.json");
//
//function validateData($data)
//{
//  for ($i = 0; $i < count($data); $i++) {
//    if ($data[$i]["email"] == $_POST['email'] && password_verify($_POST['password'], $data[$i]["password"]) && $data[$i]["alive"] != null) {
//      return $data[$i];
//    }
//  }
//  return null;
//}

if (validateData($loginData)) {
  $_SESSION['email'] = $_POST['email'];
// DATABASE Mysql
  $_SESSION['userFirstName'] = validateData($loginData)['first_name'];
  $_SESSION['userLastName'] = validateData($loginData)['last_name'];
  $_SESSION['userLoggedIn'] = validateData($loginData)['logged_in'];
// JSON
//  $_SESSION['userFirstName'] = validateData($loginData)['firstName'];
//  $_SESSION['userLastName'] = validateData($loginData)['lastName'];
//  $_SESSION['userLoggedIn'] = validateData($loginData)['loggedIn'];
  header("Location: ../dashboard.php");
} else {
  redirect("../login.php", "error=1");
}
exit();
