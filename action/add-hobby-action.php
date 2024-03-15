<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;
session_start();

$id   = intval( $_POST['id'] );
try {
  $query = 'INSERT INTO hobby(person_id, name) VALUES(:person_id, :name)';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "person_id" =>$id,
    "name" => $_POST['hobby']
  ));
  $hobby = ucfirst($_POST["hobby"]);
  $_SESSION['hobby'] = "New hobby has been saved($hobby).";
  redirect("../persons.php", "hobby");
} catch (PDOException $e) {
  $_SESSION['error'] = 'Query error: ' . $e->getMessage();
  header('Location: ../persons.php');
  die();
}
header('Location: ../index.php');
die();