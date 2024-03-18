<?php
global $PDO;
session_start();
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/jobs-action.php";

$allJobs = getJobsDataFromDatabase();
function validateInputJobs($dbJobs, $jobs): array
{
  $validate = [];
  if (isJobsExists($dbJobs, $jobs, null)) {
    $validate['jobs'] = "1";
  }
  return $validate;
}

$errorData = validateInputJobs($allJobs, $_POST['jobs']);

if (count($errorData) != 0) {
  $_SESSION["errorInputJobs"] = $errorData['jobs'];
  $_SESSION["inputJobs"] = $_POST['jobs'];
  header("Location: ../add-jobs.php?errorInput=1");
  exit();
} else {
  unset ($_SESSION['errorInputJobs']);
  unset ($_SESSION['inputJobs']);
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
}

header('Location: ../index.php');
die();
