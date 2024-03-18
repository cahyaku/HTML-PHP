<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();

$id = $_GET['id'];
if (intval($id)) {
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
//    $hobby = $statement['name'];
//    $_SESSION['deleted'] = "Data hobby has been deleted";
    redirect("../jobs.php", "deleted");
  } else {
    $_SESSION['error'] = 'Jobs data with given ID was not found!';
  }
}
header('Location: ../index.php');
die();