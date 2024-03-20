<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/constants.php";
global $PDO;
function getPersonHobbyByIdFromDatabase($personId):array
{
  global $PDO;
  $query = "SELECT * FROM hobby WHERE person_id LIKE '%$personId%' ";
  $statement = $PDO->prepare($query);
  $statement ->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getHobbyByIdFromDatabase($id)
{
  global $PDO;
  $query = "SELECT * FROM hobby WHERE id LIKE '%$id%'";
  $statement = $PDO->prepare($query);
  $statement->execute();
  return $statement->fetch(PDO::FETCH_ASSOC);
}