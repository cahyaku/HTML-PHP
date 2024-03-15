<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
global $PDO;

$id = $_POST['id'];
try {
  $query = 'UPDATE hobby SET name = :name WHERE id = :id';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "id" => $id,
    "name" => $_POST['hobby']
  ));
  redirect("../persons.php", "changed-hobby");
} catch (PDOException $e) {
  $_SESSION['error'] = 'Query error: ' . $e->getMessage();
  header('Location: ../persons.php');
  die();
}
header('Location: ../index.php');
die();
