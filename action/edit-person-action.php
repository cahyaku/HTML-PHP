<?php

session_start();
require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

//function validateError(string $nik,
//                       string $password,
//                       string $email,
//                       string $firstName,
//                       string $lastName,
//                              $id,
//                              $currentPassword,
//                              $confirmPassword
//): array
//{
//  $validate = [];
//  if (!checkNikInput($nik)) {
//    $validate['nik'] = "1";
//  }
//
//  if (isNikExists($nik, $id) == true) {
//    $validate['nik'] = "2";
//  }
//
////  if (!checkNewPasswordInput($password)) {
////    $validate['password'] = "1";
////  }
//
//  if (isEmailExists($email, $id) == true) {
//    $validate['email'] = "1";
//  }
//
//  if (!checkNameInput($firstName)) {
//    $validate['firstName'] = "1";
//  }
//
//  if (!checkNameInput($lastName)) {
//    $validate['lastName'] = "2";
//  }
//
////  if (!checkCurrentPassword($currentPassword, $id)) {
////    $validate['currentPassword'] = "2";
////  }
//
////  if ($_POST['currentPassword'] != null) {
//  if ($currentPassword != null) {
//    if (checkCurrentPassword($currentPassword, $id) == false) {
//      $validate['currentPassword'] = "1";
//    } else {
//      $errorPass = checkNewPasswordInput($password);
//      if ($errorPass == "") {
//      $validate['password'] = "1";
//      }
//    }
//  } else {
//    $validate = [];
//  }
//
//  if ($_POST['currentPassword'] == null && $password != null) {
//    $validate['confirmPassword'] = "1";
//  } else {
//    if (!checkConfirmPassword($password, $confirmPassword)) {
//      $validate['confirmPassword'] = "2";
//    }
//  }
//  return $validate;
//}

//$errorData = validateError($_POST['nik'],
//  $_POST['password'],
//  $_POST['email'],
//  $_POST['firstName'],
//  $_POST['lastName'],
//  $_SESSION['id'],
//  $_POST['currentPassword'],
//  $_POST['confirmPassword']
//);

//validateDataAndSaved();

$errorData = validateErrorInput($_POST['nik'],
  $_POST['email'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_SESSION['id'],
);

$errorPassword = validatePassword($_POST['currentPassword'],
  $_POST['password'],
  $_POST['confirmPassword'],
  $_SESSION['id']
);

if (count($errorData) != 0 || count($errorPassword) != 0) {
//  SESSION ERROR INPUT
  $_SESSION['errorNik'] = $errorData["nik"];
  $_SESSION['errorEmail'] = $errorData['email'];
  $_SESSION['errorPassword'] = $errorPassword['password'];
  $_SESSION['errorFirstName'] = $errorData['firstName'];
  $_SESSION['errorLastName'] = $errorData['lastName'];
  $_SESSION['errorCurrentPassword'] = $errorPassword['currentPassword'];
  $_SESSION['errorConfirmPassword'] = $errorPassword['confirmPassword'];

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
  $_SESSION['errorData'] = $errorData;
  $_SESSION['errorPasswordData'] = $errorPassword;

  header("Location: ../edit-person.php?id=" . $_SESSION['id']);
  exit();
} else {
  $persons = personsData();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    $password = checkedPassword($_POST['password'], $persons[$i]['password']);
//    $password = passwordHash($checkedPassword);
    if ($persons[$i]['id'] == $_SESSION['id']) {
      $persons[$i]["nik"] = $_POST['nik'];
      $persons[$i]["firstName"] = $_POST['firstName'];
      $persons[$i]["lastName"] = $_POST['lastName'];
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = $_POST['email'];
      $persons[$i]["password"] = $password;
      $persons[$i]["address"] = $_POST['address'];
      $persons[$i]["role"] = $_POST['role'];
      $persons[$i]["internalNotes"] = $_POST['internalNotes'];
      $persons[$i]["alive"] = $_POST['alive'];
      saveDataIntoJson($persons);
      redirect("../persons.php", "changed");
    }
  }
}