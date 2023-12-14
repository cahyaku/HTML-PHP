<?php

require_once __DIR__ . "/json.php";

//Untuk mendapatkan input data dari $_POST
if (isset($_POST['firstName'])) {
  echo "Hi, " . $_POST['firstName'];
  $persons = $_GET['firstName'];
  saveDataIntoJson($persons);
  redirect("../persons.php", "error=1");
} else {
  echo " HI Hi HI";
  redirect("../persons.php", "error=1");
}