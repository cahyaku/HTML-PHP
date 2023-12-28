<?php

session_start();
require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

function validateError(string $nik,
                       string $password,
                       string $email,
                       string $firstName,
                       string $lastName,
                              $id,
                              $currentPassword,
                              $confirmPassword
): array
{
  $validate = [];
  if (!checkNikInput($nik)) {
    $validate['nik'] = "1";
  }
  
  if (isNikExists($nik, $id) == true) {
    $validate['nik'] = "2";
  }
  
  if (!checkPasswordInput($password)) {
    $validate['password'] = "1";
  }
  
  if (isEmailExists($email, $id) == true) {
    $validate['email'] = "1";
  }
  
  if (!checkNameInput($firstName)) {
    $validate['firstName'] = "1";
  }
  
  if (!checkNameInput($lastName)) {
    $validate['lastName'] = "2";
  }
  
  if (!checkCurrentPassword($currentPassword, $id)) {
    $validate['currentPassword'] = "2";
  }
  
  if (!checkConfirmPassword($password, $confirmPassword)) {
      $validate['confirmPassword'] = "3";
  }
  return $validate;
}

$errorData = validateError($_POST['nik'],
  $_POST['password'],
  $_POST['email'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_SESSION['id'],
  $_POST['currentPassword'],
  $_POST['confirmPassword']
);
if (count($errorData) != 0) {
//  SESSION ERROR INPUT
  $_SESSION['errorNik'] = $errorData["nik"];
  $_SESSION['errorEmail'] = $errorData['email'];
  $_SESSION['errorPassword'] = $errorData['password'];
  $_SESSION['errorFirstName'] = $errorData['firstName'];
  $_SESSION['errorLastName'] = $errorData['lastName'];
  $_SESSION['errorCurrentPassword'] = $errorData['currentPassword'];
  $_SESSION['errorConfirmPassword'] = $errorData['confirmPassword'];

//  SESSION INPUT DATA
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
  $_SESSION['inputCurrentPassword'] = $_POST['currentPassword'];
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
  $_SESSION['errorData'] = count($errorData);
  
  header("Location: ../edit-person.php?id=" . $_SESSION['id']);
  exit();
} else {
  unset($_SESSION['errorNik']);
  unset($_SESSION['errorEmail']);
  unset($_SESSION['errorPassword']);
  unset($_SESSION['errorFirstName']);
  unset($_SESSION['errorLastName']);
  unset($_SESSION['inputEmail']);
  unset($_SESSION['inputNik']);
  unset($_SESSION['inputPassword']);
  unset($_SESSION['inputFirstName']);
  unset($_SESSION['inputLastName']);
  unset($_SESSION['inputAddress']);
  unset($_SESSION['inputSex']);
  unset($_SESSION['inputRole']);
  unset($_SESSION['inputBirthDate']);
  unset($_SESSION['internalNotes']);
//  $persons = personsData();
//  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
//  foreach ($persons as $person) {
//    if ($person['id'] == $_SESSION['id']) {
//      $person = [
//        "id" => $person['id'],
//        "nik" => $_POST['nik'],
//        "firstName" => $_POST['firstName'],
//        "lastName" => $_POST['lastName'],
//        "birthDate" => $birthDate,
//        "sex" => $_POST['sex'],
//        "email" => $_POST['email'],
//        "password" => $_POST['password'],
//        "address" => $_POST['address'],
//        "role" => $person['role'],
//        "internalNotes" => $_POST['internalNotes'],
//        "loggedIn" => null,
//        "alive" => $_POST['alive']
//      ];
//      $persons[] = $person;
//      $id = $person['id'];
//      saveDataIntoJson($persons);
//      redirect("../edit-person.php?id=$id", "success");
//    }
//  }
  
  $persons = personsData();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    if ($persons[$i]['id'] == $_SESSION['id']) {
      $persons[$i]["nik"] = $_POST['nik'];
      $persons[$i]["firstName"] = $_POST['firstName'];
      $persons[$i]["lastName"] = $_POST['lastName'];
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = $_POST['email'];
      $persons[$i]["password"] = $_POST['password'];
      $persons[$i]["address"] = $_POST['address'];
      $persons[$i]["internalNotes"] = $_POST['internalNotes'];
      $persons[$i]["alive"] = $_POST['alive'];
      saveDataIntoJson($persons);
      $id = $persons[$i]['id'];
      redirect("../edit-person.php?id=$id", null);
    }
  }
}