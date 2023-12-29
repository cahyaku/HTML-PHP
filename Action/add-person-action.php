<?php

session_start();

require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

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

//if (isNikExists($_POST['nik'], null) == 1 && isNikExists($_POST['email'], null) ==1 ) {
//  redirect("../add-person.php", "nik=1?email=1");
//}
//$email = [];
//if (isEmailExists($_POST['email'], null) == 0) {
//  $email = $_POST['email'];
//}  else {
//  redirect("../add-person.php", "email=1");
//}
//
//$nik = [];
//if (strlen($_POST['nik']) != 16) {
//  redirect("../add-person.php", "nik=1");
//} elseif (isNikExists($_POST['nik'], null) == 0) {
//  $nik = $_POST['nik'];
//} else if (isNikExists($_POST['nik'], null) == 1) {
//  redirect("../add-person.php", "nik=2");
//} else {
//   $nik = $_POST['nik'];
//}
//
//$persons = personsData();
//$id = count($persons) + 1;
//$birthDate = translateDateFromStringToInt($_POST['birthDate']);
//
//$personData = [
//  "id" => $id,
//  "nik" => $nik,
//  "firstName" => $_POST['firstName'],
//  "lastName" => $_POST['lastName'],
//  "birthDate" => $birthDate,
//  "sex" => $_POST['sex'],
//  "email" => $_POST['email'],
//  "password" => $_POST['password'],
//  "address" => $_POST['address'],
//  "role" => $_POST['role'],
//  "internalNotes" => $_POST['internalNotes'],
//  "loggedIn" => null
//];
//$persons[] = $personData;
//saveDataIntoJson($persons);
//redirect("../persons.php", null);

function validateError(string $nik,
                       string $password,
                       string $email,
                       string $firstName,
                       string $lastName,
                       string $confirmPassword,
                       string $birthDate
): array

{
  $validate = [];
//  if (checkNikInput($nik) == false) {
//    $validate['nik'] = "1";
//  }
//
//  if (isNikExists($nik, null) == true) {
//    $validate['nik'] = "2";
//  }
//
//  if (checkPasswordInput($password) == false) {
//    $validate['password'] = "1";
//  }
//
//  if (isEmailExists($email, null) == 1) {
//    $validate['email'] = "1";
//  }
  if (!checkNikInput($nik)) {
    $validate['nik'] = "1";
  }
  
  if (isNikExists($nik, null)) {
    $validate['nik'] = "2";
  }
  
  if (!checkPasswordInput($password)) {
    $validate['password'] = "1";
  }
  
  if (isEmailExists($email, null) == 1) {
    $validate['email'] = "1";
  }
  
  if (!checkNameInput($firstName)) {
    $validate['firstName'] = "1";
  }
  
  if (!checkNameInput($lastName)) {
    $validate['lastName'] = "2";
  }
  
  if (!checkConfirmPassword($password, $confirmPassword)) {
    $validate['confirmPassword'] = "1";
  }
  
  if (!checkBirthDateInput($birthDate)) {
    $validate['birthDate'] = "1";
  }
  return $validate;
}

$errorData = validateError($_POST['nik'],
  $_POST['password'],
  $_POST['email'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['confirmPassword'],
  $_POST['birthDate']
);

if (count($errorData) != 0) {
  $_SESSION['errorNik'] = $errorData["nik"];
  $_SESSION['errorEmail'] = $errorData['email'];
  $_SESSION['errorPassword'] = $errorData['password'];
  $_SESSION['errorFirstName'] = $errorData['firstName'];
  $_SESSION['errorLastName'] = $errorData['lastName'];
  $_SESSION['errorConfirmPassword'] = $errorData['confirmPassword'];
  $_SESSION['errorBirthDate'] = $errorData['birthDate'];
  
  $_SESSION['inputEmail'] = $_POST['email'];
  $_SESSION['inputNik'] = $_POST['nik'];
  $_SESSION['inputPassword'] = $_POST['password'];
  $_SESSION['inputFirstName'] = $_POST['firstName'];
  $_SESSION['inputLastName'] = $_POST['lastName'];
  $_SESSION['inputAddress'] = $_POST['address'];
  $_SESSION['inputSex'] = $_POST['sex'];
  $_SESSION['inputRole'] = $_POST['role'];
  $_SESSION['inputBirthDate'] = $_POST['birthDate'];
  $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
  header("Location: ../add-person.php?errorInput=1");
  exit();
} else {
  unset($_SESSION['errorNik']);
  unset($_SESSION['errorEmail']);
  unset($_SESSION['errorPassword']);
  unset($_SESSION['errorFirstName']);
  unset($_SESSION['errorLastName']);
  unset($_SESSION['errorBirthDate']);
  
  unset ($_SESSION['inputEmail']);
  unset ($_SESSION['inputNik']);
  unset ($_SESSION['inputPassword']);
  unset ($_SESSION['inputFirstName']);
  unset ($_SESSION['inputLastName']);
  unset ($_SESSION['inputAddress']);
  unset ($_SESSION['inputSex']);
  unset ($_SESSION['inputRole']);
  unset ($_SESSION['inputBirthDate']);
  unset ($_SESSION['internalNotes']);
  
  $persons = personsData();
  $id = count($persons) + 1;
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  
  $personData = [
    "id" => $id,
    "nik" => $_POST['nik'],
    "firstName" => $_POST['firstName'],
    "lastName" => $_POST['lastName'],
    "birthDate" => $birthDate,
    "sex" => $_POST['sex'],
    "email" => $_POST['email'],
    "password" => $_POST['password'],
    "address" => $_POST['address'],
    "role" => $_POST['role'],
    "internalNotes" => $_POST['internalNotes'],
    "loggedIn" => null,
    "alive" => $_POST['alive']
  ];
  $persons[] = $personData;
  saveDataIntoJson($persons);
  redirect("../persons.php", "success");
}