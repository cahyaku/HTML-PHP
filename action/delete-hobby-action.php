<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();

$id = $_GET['id'];
if (intval($id)) {
  $query = 'SELECT * FROM hobby WHERE id = :id LIMIT 1';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "id" => $id
  ));
  
  if ($statement->rowCount() == 1) {
    $person = $statement->fetch(PDO::FETCH_ASSOC);
    $query = 'DELETE FROM hobby WHERE id = :id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "id" => $id
    ));
    redirect("../persons.php", "deleted-hobby");
  } else {
    $_SESSION['error'] = 'Delete data with given ID was not found!';
  }
}
header('Location: ../index.php');
die();