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
  transformPersonFormIntoSession();
  $_SESSION['errorData'] = count($errorData);
  header("Location: ../edit-profile.php");
  exit();
} else {
//  $persons = getPersonsDataFromJson();
  $persons = getPersonsDataFromDatabase();
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  for ($i = 0; $i < count($persons); $i++) {
    $password = checkPassword($_POST['password'], $persons[$i]['password']);
    if ($persons[$i]['email'] == $_SESSION['userEmail']) {
      $persons[$i]["nik"] = htmlspecialchars($_POST['nik']);
      $persons[$i]["firstName"] = htmlspecialchars($_POST['firstName']);
      $persons[$i]["lastName"] = htmlspecialchars($_POST['lastName']);
      $persons[$i]["birthDate"] = $birthDate;
      $persons[$i]["sex"] = $_POST['sex'];
      $persons[$i]["email"] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $persons[$i]["password"] = $password;
      $persons[$i]["address"] = htmlspecialchars($_POST['address']);
      $persons[$i]["internalNotes"] = htmlspecialchars($_POST['internalNotes']);
      saveDataIntoJson("persons.json",$persons);
      redirect("../persons.php", "changed");
    }
  }
}