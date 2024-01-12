<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json.php";

//function deletePerson($personId)
//{
//  $persons = personsData();
//  foreach ($persons as $person) {
//    if ($personId == $person['id']) {
//      unset ($person);
//      $persons = array_values($persons);
//      saveDataIntoJson($persons);
//    }
//  }
//}
//session_start();

// DELETE PERSON
if (isset($_GET['id'])) {
  $persons = getPersonsDataFromJson();
    for($i = 0; $i < count($persons); $i++):
    if ($_GET['id'] == $persons[$i]['id']) {
      unset ($persons[$i]);
      $persons = array_values($persons);
      saveDataIntoJson($persons);
      redirect("../persons.php", "deleted");
    }
  endfor;
}

//session_unset();
//session_destroy();
//header('Location:persons.php');
//exit();
//session_unset();
//session_destroy();
//header('Location:persons.php');
//exit();