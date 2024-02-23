<?php
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../include/db.php";
//global $PDO;
function getPersonsDataFromJson(): array
{
  return loadDataFromJson("persons.json");
}

function getPersonsDataFromDatabase():array
{
  global $PDO;
  $query = 'SELECT * FROM persons';
  $statement = $PDO->prepare( $query );
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Function get person data by id (database)
 * @param $id
 * @return mixed
 */
function getPersonByIdFromDatabase($id)
{
  global $PDO;
  $query = 'SELECT * FROM persons WHERE id = :id';
  $statement = $PDO->prepare($query);
  $statement ->execute(array("id" =>$id));
  return $statement->fetch(PDO::FETCH_ASSOC);
}

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

/**
 * Redirect people to the login page when people fail to logged in
 *
 * @param $email
 * @return void
 */
function redirectWhenNotLoggedIn($email): void
{
  if (!isset($email)) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
  }
}

/**
 * Get person data by id
 *  Data from JSON
 * @param $id
 * @return array
 */
//function getPersonDataById($id): array
//{
//  $persons = getPersonsDataFromJson();
//  for ($i = 0; $i < count($persons); $i++) {
//    if ($id == $persons[$i]['id']) {
//      return $persons[$i];
//    }
//  }
//  return $persons[$i];
//}

/**
 * Get person data by email
 * @param $email
 * @return mixed
 */
function getPersonDataByEmail($email)
{
//  $persons = getPersonsDataFromJson();
  $persons = getPersonsDataFromDatabase();
  for ($i = 0; $i < count($persons); $i++) {
    if ($email == $persons[$i]['email']) {
      return $persons[$i];
    }
  }
  return null;
}

function getPersonsDataByEmailFromDatabase($email){
  global $PDO;
  $query = 'SELECT * FROM persons WHERE email = :email';
  $statement = $PDO->prepare($query);
  $statement ->execute(array("email" =>$email));
  return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Translate date from int to string, format (Y-m-d)
 *
 * @param $date
 * @return string
 */
function translateDateFromIntToString($date): string
{
  return date("Y-m-d", $date);
}

/**
 * Translate date from string to int
 * @param $date
 * @return int
 */
function translateDateFromStringToInt($date): int
{
  return strtotime($date);
}

/**
 * Translate date to string, format(d F Y )
 * @param $timestamp
 * @return string|null
 */
function dateFormatToString($timestamp): string|null
{
  if ($timestamp != null) {
    return date("d F Y", $timestamp);
  }
  return null;
}

/**
 * Check birthdate input, if birthdate input > time() return false.
 * @param $birthDateInput
 * @return bool
 */
function checkBirthDateInput($birthDateInput): bool
{
  $birthDate = translateDateFromStringToInt($birthDateInput);
  $date = time();
  if ($birthDate > $date) {
    return false;
  }
  return true;
}

/**
 * Check person role
 */
function checkRole($email): array|null
{
  $persons = getPersonsDataFromJson();
  foreach ($persons as $person):
    if ($email == $person['email'] && $person['role'] == "ADMIN") {
      return $person;
    }
  endforeach;
  return null;
}

/**
 * Check is NIK exists
 * @param $nik
 * @param int|null $id
 * @return bool
 */
function isNikExists($nik, ?int $id): bool
{
//  $persons = getPersonsDataFromJson();
  $persons = getPersonsDataFromDatabase();
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

/**
 * Check is email exists
 * @param $email
 * @param string|null $id
 * @return bool
 */
function isEmailExists($email, ?string $id): bool
{
  $persons = getPersonsDataFromJson();
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

function encryptPassword($password): string
{
  return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Validate new password.
 * New password  must have at least 1 capital letter, 1 non-capital letter, 1 number.
 * with a minimum length of 8 characters and a maximum of 16 characters.
 *
 * @param $password
 * @return string
 */
function checkNewPasswordInput($password): string
{
  if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $password)) {
    return true;
  }
  return "";
}

/**
 * Password encryption when the user edits the password data,
 * if the user does not edit the password, then the current password will be returned
 */
function checkPassword($password, $currentPassword): string
{
  if ($password == "") {
    return $currentPassword;
  } else {
    return encryptPassword($password);
  }
}

/**
 * Check current password input mush match
 */
function checkCurrentPassword($currentPassword, $id): bool
{
//  $persons = getPersonsDataFromJson();
  $persons = getPersonsDataFromDatabase();
  for ($i = 0; $i < count($persons); $i++) {
    if ($id == $persons[$i]['id']) {
      $verify = password_verify($currentPassword, $persons[$i]['password']);
      if ($verify) {
        return true;
      }
    }
  }
  return false;
}

/**
 * Check confirm password (the new password and confirmation password must match)
 * @param $password
 * @param $confirmPassword
 * @return bool
 */
function checkConfirmPassword($password, $confirmPassword): bool
{
  if ($password == $confirmPassword) {
    return true;
  }
  return false;
}

/**
 * Check NIK input (length of NIK must 16 characters)
 * @param $nik
 * @return bool
 */
function checkNikInput($nik): bool
{
  if (strlen($nik) != 16) {
    return false;
  }
  return true;
}

/**
 * Check name input (maximum length of name input is 15)
 * @param $name
 * @return bool
 */
function checkNameInput($name): bool
{
  if (strlen($name) > 15) {
    return false;
  }
  return true;
}

/**
 * Check error input from $_POST when edit person data
 */
function validateErrorInput(string $nik,
                            string $email,
                            string $firstName,
                            string $lastName,
                            string $birthDate,
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
  
  if (!checkBirthDateInput($birthDate)) {
    $validate['birthDate'] = "1";
  }
  return $validate;
}

/**
 * Validate current password, new password, and confirm password when edit password data
 */
function validatePassword($currentPassword, $password, $confirmPassword, $id): array
{
  $validatePassword = [];
  if ($_POST['currentPassword'] != null) {
    if (!checkCurrentPassword($currentPassword, $id)) {
      $validatePassword['currentPassword'] = "1";
    } else {
      $errorPass = checkNewPasswordInput($password);
      if ($errorPass == "") {
        $validatePassword['password'] = "1";
      }
    }
  }
  if ($_POST['currentPassword'] == null && $password != null || $_POST['currentPassword'] == null && $password == null && $confirmPassword != null) {
    $validatePassword['confirmPassword'] = "1";
  } else {
    if (!checkConfirmPassword($password, $confirmPassword)) {
      $validatePassword['confirmPassword'] = "2";
    }
  }
  return $validatePassword;
}

/**
 * Check if exists error value when edit person data
 */
function checkErrorValue($currentInput, $personData): void
{
  if (isset($_SESSION['errorFirstName']) || isset($_SESSION['errorLastName']) || isset($_SESSION['errorNik'])
    || isset($_SESSION['errorEmail']) || isset($_SESSION['errorPassword']) || isset($_SESSION['errorConfirmPassword'])
    || isset($_SESSION['errorCurrentPassword'])) {
    echo $currentInput;
  } else {
    echo $personData;
  }
}

/**
 * Check if exists error input when create new data
 * @param $inputData
 * @return void
 */
function checkErrorInput($inputData): void
{
  if (isset($_SESSION['errorFirstName']) || isset($_SESSION['errorLastName']) || isset($_SESSION['errorNik'])
    || isset($_SESSION['errorEmail']) || isset($_SESSION['errorPassword']) || isset($_SESSION['errorConfirmPassword'])) {
    echo $inputData;
  }
}

/**
 * Transform person form into session
 */
function transformPersonFormIntoSession(): void
{
  $_SESSION['inputEmail'] = $_POST['email'];
  $_SESSION['inputNik'] = $_POST['nik'];
  $_SESSION['inputPassword'] = $_POST['password'];
  $_SESSION['inputFirstName'] = $_POST['firstName'];
  $_SESSION['inputLastName'] = $_POST['lastName'];
  $_SESSION['inputAddress'] = $_POST['address'];
  $_SESSION['inputSex'] = $_POST['sex'];
  $_SESSION['inputBirthDate'] = $_POST['birthDate'];
  $_SESSION['inputInternalNotes'] = $_POST['internalNotes'];
  $_SESSION['inputCurrentPassword'] = $_POST['currentPassword'];
  $_SESSION['inputConfirmPassword'] = $_POST['confirmPassword'];
}

// untuk mengubah value saat proses input data
function translateGender($gender):string|null
{
  if ($gender == "FEMALE") {
    return "F";
  }
  if ($gender == "MALE"){
    return "M";
  }
  return null;
}

function translateRole($role):string|null
{
  if ($role == "ADMIN") {
    return "A";
  }
  if ($role == "MEMBER"){
    return "M";
  }
  return null;
}

function translateStatus($status):int|null
{
  if ($status == "ALIVE") {
    return 1;
  } else {
    return 0;
  }
}

function translateValue($value, $data, $newValue1, $newValue2)
{
  if ($value == $data) {
    return $newValue1;
  } else {
    return $newValue2;
  }
}

