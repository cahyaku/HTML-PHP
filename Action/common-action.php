<?php

require_once __DIR__ . "/json.php";

function personsData()
{
  return $person = loadDataFromJson("persons.json");
}

//function redirect($url, $getParams)
//{
//  header('Location: ' . $url . '?' . $getParams);
//  die();
//}

function redirect($url, $getParams)
{
  if ($getParams == null) {
    header('Location: ' . $url . '?');
    die();
  } else {
    header('Location: ' . $url . '?' . $getParams);
    die();
  }
}

function getPersonData($id)
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($id == $persons[$i]['id']) {
      return $persons[$i];
    }
  }
  return $persons[$i];
}

function getPersonDataByEmail($email)
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($email == $persons[$i]['email']) {
      return $persons[$i];
    }
  }
  return null;
}

function translateDateFromIntToString($date)
{
  return $date = date("m/d/Y", $date);
}

function translateDateFromStringToInt($date)
{
  return $date = strtotime($date);
}

function checkRole($email)
{
  $persons = personsData();
  foreach ($persons as $person):
    if ($email == $person['email'] && $person['role'] == "ADMIN") {
      return $person;
    }
  endforeach;
  return null;
}

//function translateRoleIntoString($role){
//   if($role == 1) {
//     return "ADMIN";
//   } else if ($role == 2) {
//     return "MEMBER";
//   }
//   return null;
//}
//function translateGenderIntoString($sex){
//  if($sex == 1) {
//     return "MALE";
//   } else if ($sex == 2) {
//     return "FEMALE";
//   }
//   return null;
//}

function checkNikInput(string $nik = null): string
{
  if ($nik != null) {
    while (true) {
      $nik = $_GET['nik'];
      if (strlen($nik) != 16) {
        echo "The maximum length of NIK input is 16 characters" . "\n";
      } else {
        return $nik;
      }
    }
  } else {
    while (true) {
      $nik = $_GET['nik'];
      if (strlen($nik) != 16) {
        echo "The maximum length of NIK input is 16 characters" . "\n";
      } else {
        return $nik;
      }
    }
  }
}

function isNikExists($nik, int $id): bool
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) :
    if ($id == null) {
      if ($persons[$i]['nik'] == $nik) {
        return true;
      }
    } else {
      if ($nik == $persons[$i]['nik'] && $id != $persons[$i]['id']) {
        return true;
      }
    }
  endfor;
  return false;
}

function isEmailExists($email, int $id): bool
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) :
    if ($id == null) {
      if ($persons[$i]['email'] == $email) {
        return true;
      }
    } else {
      if ($email == $persons[$i]['email'] && $id != $persons[$i]['id']) {
        return true;
      }
    }
  endfor;
  return false;
}

function generateId($array): int
{
  return $array == null ? 1 : (end($array['id']) + 1);
}

//function save($person)
//{
//  $persons = personsData();
//  if ($person['id'] == null) {
//    $id = generateId($persons);
//    $person->setId($id);
//    $persons[] = $person;
//    saveDataIntoJson($persons);
//  } else {
//    for ($i = 0; $i < count($persons); $i++) {
//      if ($persons[$i]['id'] == $person['id']) {
//        $persons[$i]['firstName'] = $person['firstName'];
////        $persons[$i]['lastName'] = $person['lastName'];
////        $persons[$i]['email'] = $person['email'];
////        $persons[$i]['nik'] = $person['nik'];
//        saveDataIntoJson($persons);
//      }
//    }
//  }
//  return null;
//}


