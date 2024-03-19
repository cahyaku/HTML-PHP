<?php

session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;

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
//  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
//  for ($i = 0; $i < count($persons); $i++) {
//    $password = checkPassword($_POST['password'], $persons[$i]['password']);
//    if ($persons[$i]['email'] == $_SESSION['userEmail']) {
//      $persons[$i]["nik"] = htmlspecialchars($_POST['nik']);
//      $persons[$i]["firstName"] = htmlspecialchars($_POST['firstName']);
//      $persons[$i]["lastName"] = htmlspecialchars($_POST['lastName']);
//      $persons[$i]["birthDate"] = $birthDate;
//      $persons[$i]["sex"] = $_POST['sex'];
//      $persons[$i]["email"] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
//      $persons[$i]["password"] = $password;
//      $persons[$i]["address"] = htmlspecialchars($_POST['address']);
//      $persons[$i]["internalNotes"] = htmlspecialchars($_POST['internalNotes']);
//      saveDataIntoJson("persons.json",$persons);
//      redirect("../persons.php", "changed");
//    }
//  }
    $person = getPersonsDataByEmailFromDatabase($_SESSION["email"]);
    $password = checkPassword($_POST['password'], $person['password']);
    $sex = translateGender($_POST["sex"]);
    $jobs = checkJobInput($_POST["jobs"]);
    try {
      $query = 'UPDATE persons SET nik = :nik, first_name = :first_name, last_name = :last_name,
                   birth_date = :birth_date, sex = :sex, email = :email, password = :password, address = :address,
                   internal_notes = :internal_notes, job_id = :job_id WHERE id = :id';
      $statement = $PDO->prepare($query);
      $statement->execute(array(
        "id" => $person["id"],
        "nik" => $_POST["nik"],
        "first_name" => $_POST["firstName"],
        "last_name" => $_POST["lastName"],
        "birth_date" => translateDateFromStringToInt($_POST["birthDate"]),
        "sex" => $sex,
        "email" => $_POST["email"],
        "password" => $password,
        "address" => $_POST["address"],
        "internal_notes" => $_POST["internalNotes"],
        "job_id" => $jobs
      ));
      $name = ucfirst($_POST["firstName"]) . " " . ucfirst($_POST["lastName"]);
      $_SESSION['info'] = "Person data has been updated ($name).";
      redirect("../persons.php", "success");
    } catch (PDOException $e) {
      $_SESSION['error'] = 'Query error: ' . $e->getMessage();
      header('Location: ../edit-person.php?error=1');
      die();
    }
}