<?php

require_once __DIR__ . "/json.php";

function personsData(): array
{
  return $person = loadDataFromJson("persons.json");
}

//function redirect($url, $getParams):void
//{
//  header('Location: ' . $url . '?' . $getParams);
//  die();
//}

function redirect($url, $getParams): void
{
  if ($getParams == null) {
    header('Location: ' . $url);
    die();
  } else {
    header('Location: ' . $url . '?' . $getParams);
    die();
  }
}

function successLogin($email): void
{
  if (!isset($email)) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
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

function getPersonDataByEmail($email): mixed
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
    if ($email == $persons[$i]['email']) {
      return $persons[$i];
    }
  }
  return null;
}

function translateDateFromIntToString($date): string
{
  return $date = date("Y-m-d", $date);
}

function translateDateFromStringToInt($date): int
{
  return $date = strtotime($date);
}

function dateFormatToString($timestamp): string|null
{
  if ($timestamp != null) {
    return $customFormat = date("d F Y", $timestamp);
  }
  return null;
}

function checkBirthDateInput($birthDateInput): bool
{
  $birthDate = translateDateFromStringToInt($birthDateInput);
  $date = time();
  if ($birthDate > $date) {
    return false;
  }
  return true;
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

//function generateId(array|null $array): int
//{
//  return $array == null ? 1 : (end($array['id']) + 1);
//}
//
//function save($person): void
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
//}

function passwordHash($password):string
{
  $plaintext_password = $password;
  return password_hash($plaintext_password, PASSWORD_DEFAULT);
}

//function passwordVerify($plaintextPassword, $hash):bool
//{
//  return $verify = password_verify($plaintextPassword, $hash);
//}//


function checkNewPasswordInput($password): string
{
//  if ($currentPassword == "" && $password == "") {
//    return true;
//  } else
////  else if ($password == "") {
//    return "Invalid password";
//  }
//  if (strlen($password) >= 8 && strlen($password) <= 16) {
//    return true;
//  }
  
  if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $password)) {
    return true;
  }
  return "";
}

//function askForNewPassword(): null|string
//{
//  while (true) {
//    $newPassword = askForHiddenString("Password: ");
//    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $newPassword)) {
//      echo "Password harus memiliki setidaknya 1 huruf kapital, 1 huruf non-kapital, 1 angka," .
//        " dengan panjang minimal 8 karakter dan maksimal 16 karakter." . PHP_EOL;
//    } else {
//      echo PHP_EOL;
//      $confirmPassword = askForHiddenString("Konfirmasi password: ");
//      if ($newPassword != $confirmPassword) {
//        echo "Maaf, konfirmasi password baru salah" . PHP_EOL;
//      } else {
//        return $newPassword;
//      }
//    }
//  }
//
//  // shit happens
//  return null;
//}

//function askForHiddenString(string|null $sentence = null): null|string
//{
//
//    system("stty -echo");
//    $password = trim(fgets(STDIN));
//    system("stty echo");
//  return $password;
//}

function checkedPassword($password, $currentPassword)
{
//  $plaintext_password = $password;
//  if ($password == "") {
//    $hash = password_hash($currentPassword,
//      PASSWORD_DEFAULT);
//    return $hash;
//  } else {
//    $hash = password_hash($password,
//      PASSWORD_DEFAULT);
//    return $hash;
//  }

  if ($password == "") {
    return $currentPassword;
  } else {
    return passwordHash($password);
//    return $password;
  }
}

//function checkPasswordInput($currentPassword, $password, $confirmPassword): bool
//{
//  if ($currentPassword != "" && $password == "" || $password != "" && $currentPassword == "") {
//    return false;
//  } else if ($password != "" && $confirmPassword == "") {
//    return false;
//  }
//  return true;
//}

function checkCurrentPassword($currentPassword, $id): bool
{
  $persons = personsData();
  for ($i = 0; $i < count($persons); $i++) {
//    if ($id == $persons[$i]['id'] && $persons[$i]['password'] == $currentPassword) {
//      return true;
//    }
    if ($id == $persons[$i]['id']) {
      $verify = password_verify($currentPassword, $persons[$i]['password']);
      if ($verify) {
        return true;
      }
    }
  }
  return false;
}

function checkConfirmPassword($password, $confirmPassword): bool
{
  if ($password == $confirmPassword) {
    return true;
  }
  return false;
}

function checkNikInput($nik): bool
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

/**
 * validation for input person data
 * @param string $nik
 * @param string $email
 * @param string $firstName
 * @param string $lastName
 * @param $id
 * @return array
 */
function validateErrorInput(string $nik,
                       string $email,
                       string $firstName,
                       string $lastName,
                              $id,
                             
): array
{
  $validate = [];
  if (!checkNikInput($nik)) {
    $validate['nik'] = "1";
  }
  
  if (isNikExists($nik, $id) == true) {
    $validate['nik'] = "2";
  }
  
  if (isEmailExists($email, $id) == true) {
    $validate['email'] = "1";
  }
  
  if (!checkNameInput($firstName)) {
    $validate['firstName'] = "1";
  }
  
  if (!checkNameInput($lastName)) {
    $validate['lastName'] = "2";
  }
  return $validate;
}

/**
 * validation for password input
 *
 * @param $currentPassword
 * @param $password
 * @param $confirmPassword
 * @param $id
 * @return array
 */
function validatePassword($currentPassword, $password, $confirmPassword , $id) :array
{
  $validatePassword = [];
  if ($_POST['currentPassword'] != null) {
    if (checkCurrentPassword($currentPassword, $id) == false) {
      $validatePassword['currentPassword'] = "1";
    } else {
      $errorPass = checkNewPasswordInput($password);
      if ($errorPass == "") {
        $validatePassword['password'] = "1";
      }
    }
  } else {
    $validatePassword = [];
  }
  
  if ($_POST['currentPassword'] == null && $password != null || $_POST['currentPassword'] == null && $password == null && $confirmPassword != null) {
    $validatePassword['confirmPassword'] = "1";
  }
  else {
    if (!checkConfirmPassword($password, $confirmPassword)) {
      $validatePassword['confirmPassword'] = "2";
    }
  }
  return $validatePassword;
}

//function validateDataAndSaved():void
//{
//  $errorData = validateErrorInput($_POST['nik'],
//    $_POST['email'],
//    $_POST['firstName'],
//    $_POST['lastName'],
//    $_SESSION['id'],
//  );
//
//  $errorPassword = validatePassword($_POST['currentPassword'],
//    $_POST['password'],
//    $_POST['confirmPassword'],
//    $_SESSION['id']
//  );
//
//  if (count($errorData) != 0 || count($errorPassword) != 0) {
////  SESSION ERROR INPUT
//    $_SESSION['errorNik'] = $errorData["nik"];
//    $_SESSION['errorEmail'] = $errorData['email'];
//    $_SESSION['errorPassword'] = $errorPassword['password'];
//    $_SESSION['errorFirstName'] = $errorData['firstName'];
//    $_SESSION['errorLastName'] = $errorData['lastName'];
//    $_SESSION['errorCurrentPassword'] = $errorPassword['currentPassword'];
//    $_SESSION['errorConfirmPassword'] = $errorPassword['confirmPassword'];
//
////  SESSION INPUT DATA
//    $_SESSION['inputEmail'] = $_POST['email'];
//    $_SESSION['inputNik'] = $_POST['nik'];
//    $_SESSION['inputPassword'] = $_POST['password'];
//    $_SESSION['inputFirstName'] = $_POST['firstName'];
//    $_SESSION['inputLastName'] = $_POST['lastName'];
//    $_SESSION['inputAddress'] = $_POST['address'];
//    $_SESSION['inputSex'] = $_POST['sex'];
//    $_SESSION['inputRole'] = $_POST['role'];
//    $_SESSION['inputBirthDate'] = $_POST['birthDate'];
//    $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
//    $_SESSION['inputCurrentPassword'] = $_POST['currentPassword'];
//    $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
//    $_SESSION['errorData'] = $errorData;
//    $_SESSION['errorPasswordData'] = $errorPassword;
//
//    header("Location: ../edit-person.php?id=" . $_SESSION['id']);
//    exit();
//  } else {
//    $persons = personsData();
//    $birthDate = translateDateFromStringToInt($_POST['birthDate']);
//    for ($i = 0; $i < count($persons); $i++) {
//      $password = checkedPassword($_POST['password'], $persons[$i]['password']);
////    $password = passwordHash($checkedPassword);
//      if ($persons[$i]['id'] == $_SESSION['id']) {
//        $persons[$i]["nik"] = $_POST['nik'];
//        $persons[$i]["firstName"] = $_POST['firstName'];
//        $persons[$i]["lastName"] = $_POST['lastName'];
//        $persons[$i]["birthDate"] = $birthDate;
//        $persons[$i]["sex"] = $_POST['sex'];
//        $persons[$i]["email"] = $_POST['email'];
//        $persons[$i]["password"] = $password;
//        $persons[$i]["address"] = $_POST['address'];
//        $persons[$i]["role"] = $_POST['role'];
//        $persons[$i]["internalNotes"] = $_POST['internalNotes'];
//        $persons[$i]["alive"] = $_POST['alive'];
//        saveDataIntoJson($persons);
//        redirect("../persons.php", "changed");
//      }
//    }
//  }
//}