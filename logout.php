<?php
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/action/json-helper.php";
require_once __DIR__ . "/include/db.php";
global $PDO;

session_start();
$persons = getPersonsDataFromJson();
for ($i = 0; $i < count($persons); $i++) {
  if ($persons[$i]["email"] == $_SESSION['email']) {
    $persons[$i]["loggedIn"] = time();
    saveDataIntoJson("persons.json",$persons);
  }
}
session_unset();
session_destroy();
header('Location:login.php');
exit();

//$id = $_GET['id'];
//if (intval($id)) {
//  // we should get the person data first, make sure it is in db or not, before actually deleting them
//  $query = 'SELECT * FROM persons WHERE email = :email';
//  $statement = $PDO->prepare($query);
//  $statement->execute(array(
//    "email" => $email
//  ));
//
//  if ($statement->rowCount() == 1) {
//    $person = $statement->fetch(PDO::FETCH_ASSOC);
//    $query = 'DELETE FROM persons WHERE id = :id';
//    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//      "id" => $id
//    ));
////    $_SESSION['info'] = '"' . $person['name'] . '" data has been deleted.';
//    redirect("../persons.php", "deleted");
//  } else {
//    $_SESSION['error'] = 'Person data with given ID was not found!';
//  }
//}
//header('Location: ../index.php');
//die();



//session_start();
//$person = getPersonByIdFromDatabase();
//    $query     = 'INSERT INTO persons(logged_in) VALUES(logged_in)';
//    $statement = $PDO->prepare( $query );
//    $statement->execute( array( "logged_in" => time()) );
//session_unset();
//session_destroy();
//header('Location:login.php');
//exit();