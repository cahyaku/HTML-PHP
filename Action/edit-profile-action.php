<?php

session_start();
require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

function validateError(string $nik,
                       string $password,
                       string $email,
                       string $firstName,
                       string $lastName,
                              $id
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
  return $validate;
}
$person = getPersonDataByEmail($_SESSION['userEmail']);
$errorData = validateError($_POST['nik'],
  $_POST['password'],
  $_POST['email'],
  $_POST['firstName'],
  $_POST['lastName'],
  $person['id']);
if (count($errorData) != 0) {
  $_SESSION['errorNik'] = $errorData["nik"];
  $_SESSION['errorEmail'] = $errorData['email'];
  $_SESSION['errorPassword'] = $errorData['password'];
  $_SESSION['errorFirstName'] = $errorData['firstName'];
  $_SESSION['errorLastName'] = $errorData['lastName'];
  $_SESSION['inputEmail'] = $_POST['email'];
  $_SESSION['inputNik'] = $_POST['nik'];
  $_SESSION['inputPassword'] = $_POST['password'];
  $_SESSION['inputFirstName'] = $_POST['firstName'];
  $_SESSION['inputLastName'] = $_POST['lastName'];
  $_SESSION['inputAddress'] = $_POST['address'];
  $_SESSION['inputSex'] = $_POST['sex'];
  $_SESSION['inputBirthDate'] = $_POST['birthDate'];
  $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
  header("Location: ../edit-profile.php");
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
  unset($_SESSION['inputBirthDate']);
  unset($_SESSION['internalNotes']);
  
  $persons = personsData();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    if ($persons[$i]['email'] == $_SESSION['userEmail']) {
      $persons[$i]["nik"] = $_POST['nik'];
      $persons[$i]["firstName"] = $_POST['firstName'];
      $persons[$i]["lastName"] = $_POST['lastName'];
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = $_POST['email'];
      $persons[$i]["password"] = $_POST['password'];
      $persons[$i]["address"] = $_POST['address'];
      $persons[$i]["internalNotes"] = $_POST['internalNotes'];
      saveDataIntoJson($persons);
      redirect("../edit-profile.php", "success");
    }
  }
}