<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/hobby-action.php";
global $PDO;
session_start();

$id   = intval( $_POST['id'] );

function validateInputHobby($hobby,$id): array
{
  $validate = [];
  if (isHobbyExists($hobby, $id,null)) {
    $validate['hobby'] = "1";
  }
  return $validate;
}

$errorData = validateInputHobby($_POST['hobby'],$id);

if (count($errorData) != 0) {
  $_SESSION["errorInputHobby"] = $errorData['hobby'];
  $_SESSION["inputHobby"] = $_POST['hobby'];
  header("Location: ../view-person.php?id=$id");
  exit();
} else {
  unset ($_SESSION['errorInputHobby']);
  unset ($_SESSION['inputHobby']);
  try {
    $query = 'INSERT INTO hobby(person_id, name) VALUES(:person_id, :name)';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
      "person_id" => $id,
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
}
header('Location: ../index.php');
die();