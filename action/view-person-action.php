<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();

//// DELETE PERSON
//if (isset($_GET['id'])) {
//  $persons = getPersonsDataFromJson();
//    for($i = 0; $i < count($persons); $i++):
//    if ($_GET['id'] == $persons[$i]['id']) {
//      unset ($persons[$i]);
//      $persons = array_values($persons);
//      saveDataIntoJson("persons.json",$persons);
//      redirect("../persons.php", "deleted");
//    }
//  endfor;
//}

$id = $_GET['id'];
if (intval($id)) {
  // we should get the person data first, make sure it is in db or not, before actually deleting them
  $query = 'SELECT * FROM persons WHERE id = :id LIMIT 1';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "id" => $id
  ));
  
  if ($statement->rowCount() == 1) {
    $person = $statement->fetch(PDO::FETCH_ASSOC);
    $query = 'DELETE FROM persons WHERE id = :id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "id" => $id
    ));
    
    $personLastJobs = checkLastPersonJobs($id);
    $dbJobs = 'DELETE FROM person_job WHERE person_id = :person_id';
    $statement = $PDO->prepare($dbJobs);
    $statement->execute(array(
      "person_id" => $personLastJobs['person_id'],
    ));
    $_SESSION['delete'] = '"' . $person['first_name'] . " " . $person['last_name'] . '" data has been deleted.';
    
//  Update count in jobs database
    $jobsData = getJobsDataById($person['job_id']);
    $count = count($jobsData);
    saveJobsData($person['job_id'], $count);
    redirect("../persons.php", "deleted");
  } else {
    $_SESSION['error'] = 'Person data with given ID was not found!';
  }
}
header('Location: ../index.php');
die();