<?php

session_start();

require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

function validateErrorInput(string $nik,
                            string $password,
                            string $email,
                            string $firstName,
                            string $lastName,
                            int    $id
): array
{
  $validate = [];
  if (!checkNikInput($nik)) {
    $validate['nik'] = "1";
  }
  
  if (isNikExists($nik, $id)) {
    $validate['nik'] = "2";
  }
  
  if (!checkPasswordInput($password)) {
    $validate['password'] = "1";
  }
  
  if (isEmailExists($email, $id) == 1) {
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

$errorData = validateErrorInput($_POST['nik'],
                                $_POST['password'],
                                $_POST['email'],
                                $_POST['firstName'],
                                $_POST['lastName'],
                                $_GET['id']);
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
  $_SESSION['inputRole'] = $_POST['role'];
  $_SESSION['inputBirthDate'] = $_POST['birthDate'];
  $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
//  $id = $_GET['id'];
  header("Location: ../edit-person.php");
  exit();
} else {
  unset($_SESSION['errorNik']);
  unset($_SESSION['errorEmail']);
  unset($_SESSION['errorPassword']);
  unset($_SESSION['errorFirstName']);
  unset($_SESSION['errorLastName']);
  
  $persons = personsData();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  foreach ($persons as $person) {
    if ($person['id'] == $_GET['id']) {
      $person = [
        "id" => $person['id'],
        "nik" => $_POST['nik'],
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "birthDate" => $birthDate,
        "sex" => $_POST['sex'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "address" => $_POST['address'],
        "role" => null,
        "internalNotes" => $_POST['internalNotes'],
        "loggedIn" => null,
        "alive" => $_POST['alive']
      ];
      $persons[] = $person;
      saveDataIntoJson($persons);
      redirect("../edit-person.php", null);
    }
  }
}