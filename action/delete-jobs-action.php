<?php
require_once  __DIR__ ."/../action/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();

$id = $_GET['id'];
if (intval($id)) {
  // we should get the person data first, make sure it is in db or not, before actually deleting them
  $query = 'SELECT * FROM jobs WHERE id = :id LIMIT 1';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "id" => $id
  ));
  
  if ($statement->rowCount() == 1) {
    $person = $statement->fetch(PDO::FETCH_ASSOC);
    $query = 'DELETE FROM jobs WHERE id = :id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "id" => $id
    ));
    redirect("../jobs.php", "deleted");
  } else {
    $_SESSION['error'] = 'Jobs data with given ID was not found!';
  }
}
header('Location: ../index.php');
die();