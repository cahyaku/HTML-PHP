<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;

$id = $_POST['id'];
try {
  $query     = 'UPDATE jobs SET job_name = :job_name WHERE id = :id';
  $statement = $PDO->prepare( $query );
  $statement->execute( array(
    "id" => $id,
    "job_name" => $_POST['jobs']
  ) );
  $jobs = ucfirst($_POST["jobs"]);
  $_SESSION['changed'] = "New jobs data has been saved($jobs).";
  redirect("../jobs.php", "changed");
} catch ( PDOException $e ) {
  $_SESSION['error'] = 'Query error: ' . $e->getMessage();
  header( 'Location: ../jobs.php' );
  die();
}
header( 'Location: ../index.php' );
die();
