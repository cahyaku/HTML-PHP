<?php
session_start();
require_once __DIR__ . "/json.php";

//if (isset($_SESSION['email'])) {
//  header("Location:../login.php");
//  exit();
//}
//
// echo $_POST["cahya"];
//$loginData = [
//  [
//    "email" => "cahya@gmail.com",
//    "password" => "cahya123"
//  ],
//  [
//    "email" => "kumala@gmail.com",
//    "password" => "kumala321"
//  ],
//];
//
// $_POST[$loginData];
// if ($loginData) {
//   header('Location: ../login.php?error=true');
//   die();
// }
//

// Data persons dari JSON
$loginData = loadDataFromJson("persons.json");

function validateData($data)
{
  for ($i = 0; $i < count($data); $i++) {
    if ($data[$i]["email"] == $_POST['email'] && $data[$i]["password"] == $_POST['password']) {
      return $data[$i];
//            return true;
    }
  }
  return null;
}

//if (validateData($loginData)) {
//    header('Location: ../dashboard.php', 'id=$id');
//    die();
//} else {
//    header('Location: ../login.php?error=1');
//    die();
//}

function redirect($url, $getParams)
{
  header('Location: ' . $url . '?' . $getParams);
  die();
}

if (validateData($loginData)) {
  $_SESSION['userEmail'] = $_POST['email'];
  $_SESSION['userNik'] = validateData($loginData)['nik'];
  $_SESSION['userSex'] = validateData($loginData)['sex'];
  $_SESSION['userFirstName'] = validateData($loginData)['firstName'];
  $_SESSION['userLastName'] = validateData($loginData)['lastName'];
  $loggedIn = ($loginData)['loggedIn'];
  header("Location: ../dashboard.php?=$loggedIn");
  exit();
} else {
//  header('Location:../login.php?error=1');
  redirect("../login.php", "error=1");
}

// get last logged from $_SESSION['loggedIn']
//function lastLogged() {
//  if(isset($_SESSION['loggedIn'])) {
//   $date = [];
//  } else {
//    $date = time();
//  }
//}

//function getLoggedIn(){
//  $persons = personsData();
//  for ($i = 0; $i <count($persons); $i++) {
//    if($persons[$i]["loggedIn"] == $_SESSION['loggedIn']) {
//       $persons[$i]["loggedIn"] = time();
//       saveDataIntoJson($persons, "persons.json");
//    }
//  }
//}