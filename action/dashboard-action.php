<?php
//echo $_POST["name"];
//
//$loginData = loadDataFromJson("persons.json");
//function checkLogin($loginData): array
//{
//  for ($i = 0; $i < count($loginData); $i++) {
//    if ($loginData[$i]["email"] == $_POST['email'] && $loginData[$i]["password"] == $_POST['password']) {
//      return $loginData[$i]["name"];
//    }
//  }
//  return [];
//}

function customDateToString($timestamp):string
{
  if ($timestamp != null) {
//    $customFormat = date("F j, Y, H:i:s", $timestamp);
    return $customFormat = date("d F Y  H:i", $timestamp);
  }
  return "Welcome in dashboard page!!!";
}