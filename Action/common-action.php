<?php

require_once __DIR__ . "/json.php";

function personsData():array
{
  return $person = loadDataFromJson("persons.json");
}

//function redirect($url, $getParams):void
//{
//  header('Location: ' . $url . '?' . $getParams);
//  die();
//}

function redirect($url, $getParams):void
{
  if ($getParams == null) {
    header('Location: ' . $url );
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

function getPersonDataByEmail($email):mixed
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($email == $persons[$i]['email']) {
      return $persons[$i];
    }
  }
  return null;
}

function translateDateFromIntToString($date):string
{
  return $date = date("Y-m-d", $date);
}

function translateDateFromStringToInt($date):int
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

//function askForNik( string $nik = null): string
//{
//  if ($nik != null) {
//    while (true) {
//      if (strlen($nik) != 16) {
//        echo "The maximum length of NIK input is 16 characters" . "\n";
//      } else {
//        return $nik;
//      }
//    }
//  } else {
//    while (true) {
//     if (strlen($nik) != 16) {
//        echo "The maximum length of NIK input is 16 characters" . "\n";
//      } else {
//        return $nik;
//      }
//    }
//  }
//}

//function isNikExists($nik, ?int $id): bool
//{
//  foreach ($this->getAll() as $person => $value) {
//    if ($id == null) {
//      if ($value->getNik() == $nik) {
//        return true;
//      }
//    } else {
//      if ($nik == $value->getNik() && $id != $value->getId()) {
//        return true;
//      }
//    }
//  }
//  return false;
//}

function isNikExists($nik, ?int $id): bool
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

//function isNikExits(string $nik, int|null $id):bool
//{
//  $personsData = getPersonsData();
//  foreach ($personsData as $person){
//    if ($id == null) {
//      if ($person['nik'] == $nik) {
//        return true;
//      }
//    }else{
//      if ($person['nik'] == $nik && $person['id'] != $id){
//        return true;
//      }
//    }
//  }
//  return false;
//}

function isEmailExists($email, ?string $id): bool
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

//function generateId($array): int
//{
//  return $array == null ? 1 : (end($array['id']) + 1);
//}
//
//function save($person):null
//{
//  $persons = personsData();
//  if ($person['id'] == null) {
//    $id = generateId($persons);
//    $person['id'] = $id;
//    $persons[] = $person;
//    saveDataIntoJson($persons);
//  } else {
//    for ($i = 0; $i < count($persons); $i++) {
//      if ($persons[$i]['id'] == $person['id']) {
//        $persons[$i]['firstName'] = $person['firstName'];
//        $persons[$i]['lastName'] = $person['lastName'];
//        $persons[$i]['email'] = $person['email'];
//        $persons[$i]['nik'] = $person['nik'];
//        $persons[$i]['sex'] = $person['sex'];
//        $persons[$i]['role'] = $person['role'];
//        $persons[$i]['birthDate'] = $person['birthDate'];
//        $persons[$i]['internalNotes'] = $person['internalNotes'];
//        $persons[$i]['password'] = $person['password'];
//        $persons[$i]['loggedIn'] = $person['loggedIn'];
//        saveDataIntoJson($persons);
//      }
//    }
//  }
//  return null;
//}

function checkPasswordInput($password):bool
{
  if (strlen($password) >= 8 && strlen($password) <= 16) {
    return true;
  }
  return false;
}

function checkCurrentPassword($currentPassword, $id):bool
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($id == $persons[$i]['id'] &&  $persons[$i]['password'] == $currentPassword) {
      return true;
    }
  }
  return false;
}

function checkConfirmPassword($password, $confirmPassword):bool
{
 if ($password == $confirmPassword) {
   return true;
 }
 return false;
}

function checkNikInput($nik):bool
{
  if (strlen($nik) != 16) {
    return false;
  }
  return true;
}

function checkNameInput($name): bool
{
  if (strlen($name) > 15) {
    return false;
  }
  return true;
}


