<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/jobs-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/hobby-action.php";
global $PDO;

$id = $_POST['id'];

function validateInputHobby($hobby, $id): array
{
  $validate = [];
  if (isHobbyExists($hobby, $id) == true) {
    $validate['hobby'] = "1";
  }
  return $validate;
}

$errorData = validateInputHobby($_POST['hobby'],$id);
if (count($errorData) != 0) {
  $_SESSION["errorInputHobby"] = $errorData['hobby'];
  $_SESSION["inputHobby"] = $_POST['hobby'];
  header("Location: ../edit-hobby.php?id=$id&errorInput=1");
  exit();
} else {
  unset ($_SESSION['errorInputHobby']);
  unset ($_SESSION['inputHobby']);
  
//  $id = $_POST['id'];
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
}
header('Location: ../index.php');
die();
