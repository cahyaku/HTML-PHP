<?php
session_start();
require_once __DIR__ . "/json.php";
require_once __DIR__ . "/common-action.php";

$loginData = loadDataFromJson("persons.json");

function validateData($data)
{
  for ($i = 0; $i < count($data); $i++) {
    if ($data[$i]["email"] == $_POST['email'] && password_verify($_POST['password'], $data[$i]["password"]) && $data[$i]["alive"] != null) {
      return $data[$i];
    }
  }
  return null;
}

if (validateData($loginData)) {
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['userFirstName'] = validateData($loginData)['firstName'];
  $_SESSION['userLastName'] = validateData($loginData)['lastName'];
  $_SESSION['userLoggedIn'] = validateData($loginData)['loggedIn'];
  header("Location: ../dashboard.php");
} else {
  redirect("../login.php", "error=1");
}
exit();
