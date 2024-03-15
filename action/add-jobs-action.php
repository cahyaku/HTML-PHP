<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();

//function isInputDataExists($array, $inputData, $filter, ?int $id): bool
//{
//  for ($i = 0; $i < count($array); $i++) :
//    if ($id == null) {
//      if ($array[$i][$filter] == $inputData) {
//        return true;
//      }
//    } else {
//      if ($inputData == $array[$i][$filter] && $id != $array[$i]['id']) {
//        return true;
//      }
//    }
//  endfor;
//  return false;
//}
//
//$jobs = getJobsDataFromDatabase();
//$input = $_POST["jobs"];
//
//function validateInput($jobs, $input, $filter, ?int $id = null): array
//{
//  $validate = [];
//  if (isInputDataExists($jobs, $input, $filter, null)) {
//    $validate["jobs"] = "Sorry jobs data already exits";
//  }
//  return $validate;
//}
//
//$errorData = validateInput($jobs, $input, "job_name");
//if (count($errorData) != 0) {
//  $_SESSION["errorInputJobs"] = $errorData["jobs"];
//  $_SESSION["inputJobs"] = $input;
//  redirect("../jobs.php", "success");
//} else {
//  unset ($_SESSION['errorInputJobs']);
//  unset ($_SESSION['inputJobs']);
//  }

try {
  $query = 'INSERT INTO jobs(job_name) VALUE(:job_name)';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "job_name" => $_POST['jobs']
  ));
  $jobs = ucfirst($_POST["jobs"]);
  $_SESSION['info'] = "New jobs data has been saved($jobs).";
  redirect("../jobs.php", "success");
} catch (PDOException $e) {
  $_SESSION['error'] = 'Query error: ' . $e->getMessage();
  header('Location: ../jobs.php');
  die();
}
header('Location: ../index.php');
die();
