<?php

require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../include/db.php";

// DELETE PERSON
if (isset($_GET['id'])) {
  $persons = getPersonsDataFromJson();
    for($i = 0; $i < count($persons); $i++):
    if ($_GET['id'] == $persons[$i]['id']) {
      unset ($persons[$i]);
      $persons = array_values($persons);
      saveDataIntoJson("persons.json",$persons);
      redirect("../persons.php", "deleted");
    }
  endfor;
}