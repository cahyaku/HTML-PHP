<?php

require_once __DIR__ . "/persons-action.php";
//function getPerson()
//{
//  $person = $_GET['btn-view'] == "id";
//  $persons = personsData();
//  for ($i = 0; $i < count($persons); $i++) {
//    if
//    ($person== $persons[$i]["nik"]) {
//      return $persons[$i];
//    }
//  }
//  return null;
//}
//$id = $_GET['id'];

function getPersonData($id) {
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($id == $persons[$i]['id']) {
      return $persons[$i];
    }
  }
  return $persons[$i];
}

//function loginAction(Request $request)
//{
//    $authenticationUtils = $this->get('security.authentication_utils');
//
//    // get the login error if there is one
//    $error = $authenticationUtils->getLastAuthenticationError();
//
//    // last username entered by the user
//    $lastUsername = $authenticationUtils->getLastUsername();
//
//    return $this->render(
//        'users/login.html.twig',
//        [
//            'page' => 'login',
//            'last_username' => $lastUsername,
//            'error'         => $error,
//        ]
//    );
//}