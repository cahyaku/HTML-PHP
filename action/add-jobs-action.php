<?php

require_once __DIR__ ."/utils-action.php";
require_once __DIR__ ."/../include/db.php";
global $PDO;
session_start();

try {
  $query = 'INSERT INTO jobs(job_name) VALUE(:job_name)';
  $statement = $PDO->prepare( $query );
  $statement->execute( array(
    "job_name" => $_POST['jobs']
  ) );
  $jobs = ucfirst($_POST["jobs"]);
  $_SESSION['info'] = "New jobs data has been saved($jobs).";
  redirect("../jobs.php", "success");
} catch ( PDOException $e ) {
  $_SESSION['error'] = 'Query error: ' . $e->getMessage();
  header( 'Location: ../jobs.php' );
  die();
}
header( 'Location: ../index.php' );
die();
