<?php

require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

//$persons = personsData();
//$id = count($persons) + 1;
//$birthDate = translateDateFromStringToInt($_POST['birthDate']);
//$personData = [
//  "id" => $id,
//  "nik" => $_POST['nik'],
//  "firstName" => $_POST['firstName'],
//  "lastName" => $_POST['lastName'],
//  "birthDate" => $birthDate,
//  "sex" => $_POST['sex'],
//  "email" => $_POST['email'],
//  "password" => $_POST['password'],
//  "address" => $_POST['address'],
//  "role" => $_POST['role'],
//  "internalNotes" => "internalNotes",
//  "loggedIn" => null
//];
//$persons[] = $personData;
//saveDataIntoJson($persons);
//redirect("../persons.php", null);
////  print_r($persons);
////    exit();

$persons = personsData();
$id = count($persons) + 1;
$birthDate = translateDateFromStringToInt($_POST['birthDate']);
$nik = isNikExists($_POST['nik'],$id);
$personData = [
  "id" => $id,
  "nik" => $_POST['nik'],
  "firstName" => $_POST['firstName'],
  "lastName" => $_POST['lastName'],
  "birthDate" => $birthDate,
  "sex" => $_POST['sex'],
  "email" => $_POST['email'],
  "password" => $_POST['password'],
  "address" => $_POST['address'],
  "role" => $_POST['role'],
  "internalNotes" => "internalNotes",
  "loggedIn" => null
];
$persons[] = $personData;
saveDataIntoJson($persons);
redirect("../persons.php", null);