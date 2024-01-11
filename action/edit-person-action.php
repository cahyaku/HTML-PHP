<?php

session_start();
require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

//validateDataAndSaved();

$errorData = validateErrorInput($_POST['nik'],
  $_POST['email'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['birthDate'],
  $_SESSION['id'],
);

//$errorPassword = validatePassword($_POST['currentPassword'],
//  $_POST['password'],
//  $_POST['confirmPassword'],
//  $_SESSION['id'],
//);

function editPasswordValidate($password,$confirmPassword):array
{
  $validatePassword = [];
  if (!checkNewPasswordInput($password)) {
    $validatePassword['password'] = "1";
  }

  if (!checkConfirmPassword($password, $confirmPassword)) {
    $validatePassword['confirmPassword'] = "1";
  }
  return$validatePassword;
}
$errorPassword = editPasswordValidate($_POST['password'], $_POST['confirmPassword']);

$_SESSION['errorInputData'] = $errorData;
//  $_SESSION['errorPasswordData'] = $errorPassword;
if (count($errorData) != 0 || count($errorPassword) != 0) {

//if (count($errorData) != 0) {
//  SESSION ERROR INPUT
  $_SESSION['errorNik'] = $errorData["nik"];
  $_SESSION['errorEmail'] = $errorData['email'];
  $_SESSION['errorFirstName'] = $errorData['firstName'];
  $_SESSION['errorLastName'] = $errorData['lastName'];
  $_SESSION['errorData'] = $errorData;
  
  $_SESSION['errorPassword'] = $errorPassword['password'];
//  $_SESSION['errorCurrentPassword'] = $errorPassword['currentPassword'];
  $_SESSION['errorConfirmPassword'] = $errorPassword['confirmPassword'];
  $_SESSION['inputPassword'] = $_POST['password'];
//  $_SESSION['inputCurrentPassword'] = $_POST['currentPassword'];
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
  $_SESSION['errorData'] = $errorData;
  $_SESSION['errorPasswordData'] = $errorPassword;
//  SESSION INPUT DATA
//  $_SESSION['inputEmail'] = $_POST['email'];
//  $_SESSION['inputNik'] = $_POST['nik'];
//  $_SESSION['inputFirstName'] = $_POST['firstName'];
//  $_SESSION['inputLastName'] = $_POST['lastName'];
//  $_SESSION['inputAddress'] = $_POST['address'];
//  $_SESSION['inputSex'] = $_POST['sex'];
//  $_SESSION['inputRole'] = $_POST['role'];
//  $_SESSION['inputBirthDate'] = $_POST['birthDate'];
//  $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
  inputData();
  header("Location: ../edit-person.php?id=" . $_SESSION['id']);
  exit();
} else {
  $persons = personsData();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    $password = checkedPassword($_POST['password'], $persons[$i]['password']);
//    $password = passwordHash($checkedPassword);
    if ($persons[$i]['id'] == $_SESSION['id']) {
      $persons[$i]["nik"] = htmlspecialchars($_POST['nik']);
      $persons[$i]["firstName"] = htmlspecialchars($_POST['firstName']);
      $persons[$i]["lastName"] = htmlspecialchars($_POST['lastName']);
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
      $persons[$i]["password"] = $password;
      $persons[$i]["address"] = htmlspecialchars($_POST['address']);
      $persons[$i]["role"] = $_POST['role'];
      $persons[$i]["internalNotes"] = htmlspecialchars($_POST['internalNotes']);
      $persons[$i]["alive"] = $_POST['alive'];
      saveDataIntoJson($persons);
      redirect("../persons.php", "changed");
    }
  }
}