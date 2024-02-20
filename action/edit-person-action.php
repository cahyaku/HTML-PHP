<?php

session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/utils-action.php";

$errorData = validateErrorInput($_POST['nik'],
  $_POST['email'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['birthDate'],
  $_SESSION['id'],
);

/**
 * validate password input and current password input
 * @param $password
 * @param $confirmPassword
 * @return array
 */
function editPasswordValidate($password, $confirmPassword): array
{
  $validatePassword = [];
  if ($password != null) {
    if (!checkNewPasswordInput($password)) {
      $validatePassword['password'] = "1";
    }
    
    if (!checkConfirmPassword($password, $confirmPassword)) {
      $validatePassword['confirmPassword'] = "1";
    }
  }
  
  if ($confirmPassword != null && $password == null) {
    $validatePassword['password'] = "2";
  }
  return $validatePassword;
}

$errorPassword = editPasswordValidate($_POST['password'], $_POST['confirmPassword']);

$_SESSION['errorInputData'] = $errorData;
if (count($errorData) != 0 || count($errorPassword) != 0) {
//  SESSION ERROR INPUT
  $_SESSION['errorNik'] = $errorData["nik"];
  $_SESSION['errorEmail'] = $errorData['email'];
  $_SESSION['errorFirstName'] = $errorData['firstName'];
  $_SESSION['errorLastName'] = $errorData['lastName'];
  $_SESSION['errorData'] = $errorData;
  $_SESSION['errorPassword'] = $errorPassword['password'];
  $_SESSION['errorConfirmPassword'] = $errorPassword['confirmPassword'];
  $_SESSION['inputPassword'] = $_POST['password'];
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
  $_SESSION['errorData'] = $errorData;
  $_SESSION['errorPasswordData'] = $errorPassword;
//  SESSION INPUT DATA
  transformPersonFormIntoSession();
  header("Location: ../edit-person.php?id=" . $_SESSION['id']);
  exit();
} else {
  $persons = getPersonsDataFromJson();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    $password = checkPassword($_POST['password'], $persons[$i]['password']);
    if ($persons[$i]['id'] == $_SESSION['id']) {
      $persons[$i]["nik"] = htmlspecialchars($_POST['nik']);
      $persons[$i]["firstName"] = htmlspecialchars($_POST['firstName']);
      $persons[$i]["lastName"] = htmlspecialchars($_POST['lastName']);
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $persons[$i]["password"] = $password;
      $persons[$i]["address"] = htmlspecialchars($_POST['address']);
      $persons[$i]["role"] = $_POST['role'];
      $persons[$i]["internalNotes"] = htmlspecialchars($_POST['internalNotes']);
      $persons[$i]["alive"] = $_POST['alive'];
      saveDataIntoJson("persons.json", $persons);
      redirect("../persons.php", "changed");
    }
  }
}