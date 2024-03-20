<?php
global $PDO;
session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";

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
  
  $birthDate = translateDateFromStringToInt($_POST['birthDate']);
  $password = encryptPassword($_POST['password']);
  $sex = translateGender($_POST["sex"]);
  $role = translateRole($_POST["role"]);
  $status = translateStatus($_POST["status"]);
  $jobs = checkJobInput($_POST["jobs"]);
  try {
    $query = 'INSERT INTO persons(nik,first_name,last_name,birth_date,sex,email, password,address,role,internal_notes,status, job_id)
VALUES(:nik,:first_name,:last_name,:birth_date,:sex,:email,:password,:address,:role,:internal_notes,:status,:job_id)';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "nik" => $_POST["nik"],
      "first_name" => $_POST["firstName"],
      "last_name" => $_POST["lastName"],
      "birth_date" => $birthDate,
      "sex" => $sex,
      "email" => $_POST["email"],
      "password" => $password,
      "address" => $_POST["address"],
      "role" => $role,
      "internal_notes" => $_POST["internalNotes"],
      "status" => $status,
      "job_id" => $jobs
    ));
    $name = ucfirst($_POST["firstName"]) . " " . ucfirst($_POST["lastName"]);
    $_SESSION['info'] = "New person data has been saved ($name).";
//    redirect("../persons.php", "success");
  } catch (PDOException $e) {
    $_SESSION['error'] = 'Query error: ' . $e->getMessage();
    header('Location: ../persons.php');
    die();
  }
  $person = getPersonDataByNik($_POST["nik"]);
  $personId = $person['id'];
  $dbJobs = 'INSERT INTO person_job(person_id,job_id) VALUES(:person_id,:job_id)';
  $statement = $PDO->prepare($dbJobs);
  $statement->execute(array(
    "person_id" => $personId,
    "job_id" => $jobs
  ));

//Update count in jobs database
  $jobsData = getJobsDataById($jobs);
  $count = count($jobsData);
  saveJobsData($jobs, $count);
  redirect("../persons.php", "success");
}
header('Location: ../index.php');
die();