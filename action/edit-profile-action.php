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
//  if (!checkNewPasswordInput($password)) {
//    $validate['password'] = "1";
//  }
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
//  if ($_POST['password'] != null || $_POST['currentPassword'] != null) {
//    if (!checkCurrentPassword($currentPassword, $id)) {
//      $validate['currentPassword'] = "1";
//    }
//  } else {
//    $validate = [];
//  }
//
////  if (!checkCurrentPasswordInput($currentPassword, $id , $password)) {
////    $validate['currentPassword'] = "2";
////  }
//
//  if (!checkConfirmPassword($password, $confirmPassword)) {
//    $validate['confirmPassword'] = "3";
//  }
//  return $validate;
//}
//function validatePassword($password, $currentPassword, $id): array
//{
//  $validatePass = [];
//  if ($password != "") {
//    if (!checkCurrentPassword($currentPassword, $id)) {
//      $validatePass['currentPassword'] = "1";
//    }
//  } else {
//    $validatePass['currentPassword'] = [];
//  }
//  return $validatePass;
//}
//function passwordValidate(int $id, string $currentPassword, string $newPassword, string $confirmPassword):array
//{
//  $validate = [];
//  if ($currentPassword != null){
//    if (!checkCurrentPassword($currentPassword, $id)){
//      $validate['currentPass'] = "Password input is not correct";
//    }else{
//      $errorNewPass = checkNewPasswordInput($newPassword, $currentPassword);
//      if ($errorNewPass != "") {
//        $validate['newPass'] = $errorNewPass;
//      }
//    }
//  }else{
//    $validate['currentPass'] = "Please input the current password first!";
//  }
//  return $validate;
//}

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

$person = getPersonDataByEmail($_SESSION['userEmail']);
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
  $_SESSION['inputBirthDate'] = $_POST['birthDate'];
  $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
  $_SESSION['inputCurrentPassword'] = $_POST['currentPassword'];
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
  $_SESSION['errorData'] = count($errorData);
  header("Location: ../edit-profile.php");
  exit();
} else {
//  unset($_SESSION['errorNik']);
//  unset($_SESSION['errorEmail']);
//  unset($_SESSION['errorPassword']);
//  unset($_SESSION['errorFirstName']);
//  unset($_SESSION['errorLastName']);
//  unset($_SESSION['inputEmail']);
//  unset($_SESSION['inputNik']);
//  unset($_SESSION['inputPassword']);
//  unset($_SESSION['inputFirstName']);
//  unset($_SESSION['inputLastName']);
//  unset($_SESSION['inputAddress']);
//  unset($_SESSION['inputSex']);
//  unset($_SESSION['inputBirthDate']);
//  unset($_SESSION['internalNotes']);

  $persons = personsData();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    $password= checkedPassword($_POST['password'], $persons[$i]['password']);
//    $password = passwordHash($checkedPassword);
    if ($persons[$i]['email'] == $_SESSION['userEmail']) {
      $persons[$i]["nik"] = $_POST['nik'];
      $persons[$i]["firstName"] = $_POST['firstName'];
      $persons[$i]["lastName"] = $_POST['lastName'];
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = $_POST['email'];
      $persons[$i]["password"] = $password;
      $persons[$i]["address"] = $_POST['address'];
      $persons[$i]["internalNotes"] = $_POST['internalNotes'];
      saveDataIntoJson($persons);
      redirect("../persons.php", "changed");
    }
  }
}