<?php
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/utils-action.php";

$id = intval($_SESSION['id']);
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
  $_SESSION['inputJobs'] = $_POST['jobs'];
  /**
   * SESSION INPUT DATA
   */
  transformPersonFormIntoSession();
  header("Location: ../edit-person.php?id=" . $_SESSION['id']);
  exit();
} else {
  $person = getPersonByIdFromDatabase($_SESSION["id"]);
  $password = checkPassword($_POST['password'], $person['password']);
  $role = translateRole($_POST["role"]);
  $sex = translateGender($_POST["sex"]);
  $status = translateStatus($_POST["status"]);
  
  $personJobs = checkLastPersonJobs($id);
  $jobs = checkJobInputWhenEditPersonData($personJobs['job_id'], $_POST['jobs'], $status);
  try {
    $query = 'UPDATE persons SET nik = :nik, first_name = :first_name, last_name = :last_name,
                   birth_date = :birth_date, sex = :sex, email = :email, password = :password, address = :address,
                   role = :role, internal_notes = :internal_notes, status = :status, job_id = :job_id WHERE id = :id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "id" => $id,
      "nik" => $_POST["nik"],
      "first_name" => $_POST["firstName"],
      "last_name" => $_POST["lastName"],
      "birth_date" => $_POST["birthDate"],
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
    $_SESSION['changed'] = "Person data has been updated ($name).";
  } catch (PDOException $e) {
    $_SESSION['error'] = 'Query error: ' . $e->getMessage();
    header('Location: ../edit-person.php?error=1');
    die();
  }
  updateCountOfJobsWhenEditPersonData($id);
  $personLastJobs = checkLastPersonJobs($id);
  $dbJobs = 'UPDATE person_job SET job_id = :job_id WHERE person_id = :person_id';
  $statement = $PDO->prepare($dbJobs);
  $statement->execute(array(
    "person_id" => $id,
    "job_id" => $jobs,
  ));
  $updateJobs = getJobsDataById($jobs);
  $countUpdateJobs = count($updateJobs);
  saveJobsData($jobs, $countUpdateJobs);
  redirect("../persons.php", "changed");
}
header('Location: ../index.php');
die();