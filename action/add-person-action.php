<?php

session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/common-action.php";

/**
 * Validate error input when add new person data
 */
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
  if (!checkNikInput($nik)) {
    $validate['nik'] = "1";
  }

  if (isNikExists($nik, null)) {
    $validate['nik'] = "2";
  }

  if (!checkNewPasswordInput($password)) {
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
  $_SESSION['errorBirthDate'] = $errorData['birthDate'];
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
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
  $_SESSION['inputStatus'] = $_POST['alive'];
  $_SESSION['errorData'] = count($errorData);
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
  
  $persons = getPersonsDataFromJson();
  $lastPerson = $persons[count($persons) -1];
  $id = $lastPerson["id"] + 1;
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  $password = encryptPassword($_POST['password']);
  $personData = [
    "id" => $id,
    "nik" => htmlspecialchars($_POST['nik']),
    "firstName" =>htmlspecialchars($_POST['firstName']),
    "lastName" => htmlspecialchars($_POST['lastName']),
    "birthDate" => $birthDate,
    "sex" => $_POST['sex'],
    "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
    "password" => $password,
    "address" => htmlspecialchars($_POST['address']),
    "role" => $_POST['role'],
    "internalNotes" => htmlspecialchars($_POST['internalNotes']),
    "loggedIn" => null,
    "alive" => $_POST['alive']
  ];
  $persons[] = $personData;
  saveDataIntoJson("persons.json",$persons);
  redirect("../persons.php", "success");
}