<?php
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/utils-action.php";

$id   = intval( $_SESSION['id'] );
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
//  $persons = getPersonsDataFromJson();
//  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
//  for ($i = 0; $i < count($persons); $i++) {
//    $password = checkPassword($_POST['password'], $persons[$i]['password']);
//    if ($persons[$i]['id'] == $_SESSION['id']) {
//      $persons[$i]["nik"] = htmlspecialchars($_POST['nik']);
//      $persons[$i]["firstName"] = htmlspecialchars($_POST['firstName']);
//      $persons[$i]["lastName"] = htmlspecialchars($_POST['lastName']);
//      $persons[$i]["birthDate"] = $birthDate;
//      $persons[$i]["sex"] = $_POST['sex'];
//      $persons[$i]["email"] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
//      $persons[$i]["password"] = $password;
//      $persons[$i]["address"] = htmlspecialchars($_POST['address']);
//      $persons[$i]["role"] = $_POST['role'];
//      $persons[$i]["internalNotes"] = htmlspecialchars($_POST['internalNotes']);
//      $persons[$i]["alive"] = $_POST['alive'];
//      saveDataIntoJson("persons.json", $persons);
//      redirect("../persons.php", "changed");
//    }
//  }
  
//      $birthDate = translateDateFromStringToInt($_POST['birthDate']);
      $person = getPersonByIdFromDatabase();
//      $password = checkPassword($_POST['password'], $persons['password']);
      try {
        $query = 'UPDATE persons SET nik = :nik, first_name = :first_name, last_name = :last_name, birth_date = :birth_date, sex = :sex WHERE id = :id';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
          "id" => $id,
          "nik" => $_POST["nik"],
          "first_name" => $_POST["firstName"],
          "last_name" => $_POST["lastName"],
          "birth_date" => translateDateFromStringToInt($_POST["birthDate"]),
          "sex" => $_POST["sex"]
        ));
        $name = $_POST['firstName'];
        $_SESSION['info'] = "Person data has been updated ($name).";
        redirect("../persons.php", "success");
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Query error: ' . $e->getMessage();
        header('Location: ../edit-person.php?error=1');
        die();
      }
      
//  try {
//    $query = 'UPDATE persons SET nik = :nik, first_name = :first_name, last_name = :last_name, birth_date = :birth_date,sex = :sex, email = :email, password = :password, address = :address, role = :role, internal_notes = :internal_notes, status = :status WHERE id = :id';
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "id" => $id,
//      "nik" => $_POST["nik"],
//      "first_name" => $_POST['firstName'],
//      "last_name" => $_POST['lastName'],
//      "birth_date" => $birthDate,
//      "sex" => translateGender($_POST["sex"]),
//      "email" => $_POST["email"],
//      "password" => $_POST["password"],
//      "address" => $_POST["address"],
//      "role" => translateRole($_POST["role"]),
//      "internal_notes" => $_POST['internalNotes'],
//      "status" => translateStatus($_POST["status"])
//    ));
//    $name = $_POST['firstName'];
//    $_SESSION['info'] = "Person data has been updated ($name).";
//    redirect("../persons.php", "success");
//  } catch (PDOException $e) {
//    $_SESSION['error'] = 'Query error: ' . $e->getMessage();
//    header('Location: ../edit-person.php?');
//    die();
//  }
}
header('Location: ../index.php');
die();