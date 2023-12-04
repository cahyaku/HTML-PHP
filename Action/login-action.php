<?php
session_start();
//if (isset($_SESSION['email'])) {
//  header("Location:../login.php");
//  exit();
//}

// echo $_POST["cahya"];
//$loginData = [
//  [
//    "email" => "cahya@gmail.com",
//    "password" => "cahya123"
//  ],
//  [
//    "email" => "kumala@gmail.com",
//    "password" => "kumala321"
//  ],
//];
//
// $_POST[$loginData];
// if ($loginData) {
//   header('Location: ../login.php?error=true');
//   die();
// }
//
//function loadDataFromJson(string $fileName): array
//{
//    if (file_exists($fileName)) {
//        $data = file_get_contents($fileName);
//        $result = json_decode($data, true);
//        return $result;
//    }
//    return [];
//}

function loadDataFromJson(string $fileName): array
{
    $path = __DIR__ . "/../" . $fileName;
    if (file_exists($path)) {
        $data = file_get_contents($path);
        $results = json_decode($data, true);
        if ($results == null) {
            return [];
        }
        return $results;
    }
    return [];
}

// Data persons dari JSON
$loginData = loadDataFromJson("persons.json");

function validateData($data)
{
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] == $_POST['email'] && $data[$i]["password"] == $_POST['password']) {
          return $data[$i];
//            return true;
        }
    }
    return null;
}

//if (validateData($loginData)) {
//    header('Location: ../dashboard.php', 'id=$id');
//    die();
//} else {
//    header('Location: ../login.php?error=1');
//    die();
//}


function redirect($url, $getParams)
{
  header('Location: ' . $url . '?' . $getParams);
  die();
}

if (validateData($loginData)) {
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['userFirstName'] = validateData($loginData)['firstName'];
  $_SESSION['userLastName'] = validateData($loginData)['lastName'];
    header("Location: ../dashboard.php");
    exit();
} else {
//  header('Location:../login.php?error=1');
redirect("../login.php", "error=1");
}

//function validateData($data): bool
//{
//    for ($i = 0; $i < count($data); $i++) {
//        if ($data[$i]["email"] == $_POST['email'] && $data[$i]["password"] == $_POST['password']) {
//            return true;
//        } else {
//            return true;
//        }
//    }
//    return false;
//}
//
//function checkData($loginData)
//{
//    for ($i = 0; $i < count($loginData); $i++) {
//        if ($loginData[$i]["email"] == $_POST['email'] && $loginData[$i]["password"] == $_POST['password']) {
//            header('Location: ../dashboard.php');
//            die();
//        }
//    }
//    header('Location: ../login.php?error=1');
//    die();
//}
//function askForDate(?string $sentence = null, ?string $errorMassage = null, ?string $format = 'd/m/Y', ?int $date = null): null|int
//{
//  while (true) {
//    if ($date != null) {
//      $birthDate = TerminalHelper::inputString($sentence ?: "Date (DD/MM/YYYY):");
//      if ($birthDate == "") {
//        return $date;
//      } else {
//        $dateFormat = date_create_from_format($format, $birthDate);
//        if ($dateFormat == false) {
//          return null;
//        } else {
//          $timeStamp = date_format($dateFormat, 'U');
//          return ($timeStamp);
//        }
//      }
//    }
//  }
//}