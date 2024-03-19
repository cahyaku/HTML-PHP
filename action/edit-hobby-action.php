<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/jobs-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/hobby-action.php";
global $PDO;

$id = $_POST['hobbyId'];
$personId = $_POST['personId'];

function validateInputHobby($hobby,$personId, $id): array
{
  $validate = [];
  $allHobby = getPersonHobbyByIdFromDatabase($personId);
  if (isHobbyExists($allHobby, $hobby, $id) == true) {
    $validate['hobby'] = "1";
  }
  return $validate;
}

$errorData = validateInputHobby($_POST['hobby'],$personId,$id);
if (count($errorData) != 0) {
  $_SESSION["errorInputHobby"] = $errorData['hobby'];
  $_SESSION["inputHobby"] = $_POST['hobby'];
  header("Location: ../edit-hobby.php?hobbyId=$id&personId=$personId&errorInput=1");
  exit();
} else {
  unset ($_SESSION['errorInputHobby']);
  unset ($_SESSION['inputHobby']);
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
