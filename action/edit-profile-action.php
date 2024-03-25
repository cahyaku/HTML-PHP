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
  $_SESSION['inputJobs'] = $_POST['jobs'];
  
//  SESSION INPUT DATA
  transformPersonFormIntoSession();
  $_SESSION['errorData'] = count($errorData);
  header("Location: ../edit-profile.php");
  exit();
} else {

    $person = getPersonDataByEmailFromDatabase($_SESSION["email"]);
    $password = checkPassword($_POST['password'], $person['password']);
    $sex = translateGender($_POST["sex"]);
    $personJobs = checkLastPersonJobs($person['id']);
    $jobs = checkJobInputWhenEditPersonData($personJobs['job_id'], $_POST['jobs']);
    
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
        "birth_date" => $_POST["birthDate"],
        "sex" => $sex,
        "email" => $_POST["email"],
        "password" => $password,
        "address" => $_POST["address"],
        "internal_notes" => $_POST["internalNotes"],
        "job_id" => $jobs
      ));
      $name = ucfirst($_POST["firstName"]) . " " . ucfirst($_POST["lastName"]);
      $_SESSION['info'] = "Person data has been updated ($name).";
    } catch (PDOException $e) {
      $_SESSION['error'] = 'Query error: ' . $e->getMessage();
      header('Location: ../edit-person.php?error=1');
      die();
    }
    updateCountOfJobsWhenEditPersonData($person['id']);
    $personLastJobs = checkLastPersonJobs($person['id']);
    $dbJobs = 'UPDATE person_job SET job_id = :job_id WHERE person_id = :person_id';
    $statement = $PDO->prepare($dbJobs);
    $statement->execute(array(
      "person_id" => $personLastJobs['id'],
      "job_id" => $jobs
    ));
    $updateJobs = getJobsDataById($jobs);
    $countUpdateJobs = count($updateJobs);
    saveJobsData($jobs, $countUpdateJobs);
    redirect("../persons.php", "success");
}