<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/jobs-action.php";
session_start();
global $PDO;

$id = $_POST['id'];
$jobsData = getJobDataFromDatabase($_POST['jobs']);

function validateInputJobs($dbJobs, $jobs,$id): array
{
  $validate = [];
  if (isJobsExists($dbJobs, $jobs, $id) == true) {
    $validate['jobs'] = "1";
  }
  return $validate;
}

$errorData = validateInputJobs($jobsData, $_POST['jobs'],$id);

if (count($errorData) != 0) {
  $_SESSION["errorInputJobs"] = $errorData['jobs'];
  $_SESSION["inputJobs"] = $_POST['jobs'];
  header("Location: ../edit-jobs.php?id=$id");
  exit();
} else {
  unset ($_SESSION['errorInputJobs']);
  unset ($_SESSION['inputJobs']);
  try {
    $query = 'UPDATE jobs SET job_name = :job_name WHERE id = :id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "id" => $id,
      "job_name" => $_POST['jobs']
    ));
    $jobs = ucfirst($_POST["jobs"]);
    $_SESSION['changedJobs'] = "New jobs data has been saved($jobs).";
    redirect("../jobs.php", "changed");
  } catch (PDOException $e) {
    $_SESSION['error'] = 'Query error: ' . $e->getMessage();
    header('Location: ../jobs.php');
    die();
  }
}
header( 'Location: ../index.php' );
die();
