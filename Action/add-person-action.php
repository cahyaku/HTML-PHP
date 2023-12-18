<?php

//session_start();

require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

$nik = [];
if (strlen($_POST['nik']) != 16) {
  redirect("../add-person.php", "nik=1");
} elseif (isNikExists($_POST['nik'], null) == 0) {
  $nik = $_POST['nik'];
} else if (isNikExists($_POST['nik'], null) == 1) {
  redirect("../add-person.php", "nik=2");
} else {
   $nik = $_POST['nik'];
}

//$email = [];
//if (isEmailExists($_POST['email']) == 0) {
//  $email = $_POST['email'];
//} else if (isNikExists($_POST['nik']) == 1 && isNikExists($_POST['email']) ==1 ) {
//  redirect("../add-person.php", "nik=1" . "?email=1");
//} else {
//  redirect("../add-person.php", "email=1");
//}

$persons = personsData();
$id = count($persons) + 1;
$birthDate = translateDateFromStringToInt($_POST['birthDate']);

$personData = [
  "id" => $id,
  "nik" => $nik,
  "firstName" => $_POST['firstName'],
  "lastName" => $_POST['lastName'],
  "birthDate" => $birthDate,
  "sex" => $_POST['sex'],
  "email" => $_POST['email'],
  "password" => $_POST['password'],
  "address" => $_POST['address'],
  "role" => $_POST['role'],
  "internalNotes" => $_POST['internalNotes'],
  "loggedIn" => null
];
$persons[] = $personData;
saveDataIntoJson($persons);
//redirect("../persons.php", null);

//function createPerson($nik, $email)
//{
//  $persons = personsData();
//  $id = count($persons) + 1;
//  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
//  $personData = [
//    "id" => $id,
//    "nik" => $nik,
//    "firstName" => $_POST['firstName'],
//    "lastName" => $_POST['lastName'],
//    "birthDate" => $birthDate,
//    "sex" => $_POST['sex'],
//    "email" => $email,
//    "password" => $_POST['password'],
//    "address" => $_POST['address'],
//    "role" => $_POST['role'],
//    "internalNotes" => $_POST['internalNotes'],
//    "loggedIn" => null
//  ];
//  $persons[] = $personData;
//  saveDataIntoJson($persons);
//  redirect("../persons.php", null);
//}

if ($nik != null) {
  $_SESSION['userEmail'] = $_POST['email'];
  $_SESSION['userNik'] = $_POST['nik'];
  $_SESSION['userPassword'] = $_POST['password'];
//$_SESSION['userFirstName'] = $_POST['firstName'];
//$_SESSION['userLastName'] = $_POST['lastName'];
//$_SESSION['userLoggedIn'] = $_POST['loggedIn'];
//$_SESSION['userAddress'] = $_POST['address'];
//$_SESSION['userSex'] = $_POST['sex'];
//$_SESSION['userRole'] = $_POST['role'];
//$_SESSION['userBirthDate'] = $_POST['birthDate'];
  header("Location: ../add-person.php");
  exit();
} else {
  redirect("../add-person.php", "error=1");
}

//function validateError(string $nik, string $password, string $email): array
//{
//  $validate = [];
////  if (checkNikInput($nik) == null) {
////    $validate['nik'] = 1;
////  }
//
//  if (isNikExists($nik, null) == 0) {
//    $validate['nik'] = 2;
//  }
//
//  if (checkPasswordInput($password) == null) {
//    $validate['password'] = 1;
//  }
//}

//$errorData = validate($_POST['nik'], $_POST['password'], $_POST['email']);
//if (count($errorData) != null){
//  $_SESSION['nik'] = $errorData["nik"];
//  $_SESSION['email'] = $errorData['email'];
//  $_SESSION['password'] = $errorData['password'];
//  header("Location: ../create.php");
//  exit();