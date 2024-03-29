<?php
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/hobby-action.php";

function getPersonsDataFromJson(): array
{
  return loadDataFromJson("persons.json");
}

/**
 * Function get person data by id (database)
 */
function getPersonByIdFromDatabase($id): array
{
  global $PDO;
  $query = 'SELECT * FROM persons WHERE id = :id';
  $statement = $PDO->prepare($query);
  $statement->execute(array("id" => $id));
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
 * Get person data by email
 * @param $email
 * @return mixed
 */
function getPersonDataByEmailFromDatabase($email): array
{
  global $PDO;
  $query = 'SELECT * FROM persons WHERE email = :email';
  $statement = $PDO->prepare($query);
  $statement->execute(array("email" => $email));
  return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get person data by email
 * @param $email
 * @return mixed
 */
function getPersonsDataByEmailFromDatabase($email): array
{
  global $PDO;
  $query = 'SELECT * FROM persons WHERE email = :email';
  $statement = $PDO->prepare($query);
  $statement->execute(array("email" => $email));
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Translate date from int to string, format (Y-m-d)
 *
 * @param $date
 * @return string
 */
function translateDateFromIntToString($date): string
{
  $date = strtotime($date);
//  $date = date($date);
  return date("Y-m-d", $date);
}

/**
 * Translate date from string to int
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
    $date = strtotime($timestamp);
    return date("d F Y", $date);
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
 * Is input data exists
 *
 * @param $db (database name)
 * @param $inputData
 * @param int|null $id
 * @param $filter
 * @return bool
 */
function isInputDataExists($db, $inputData,?int $id, $filter):bool
{
  global $PDO;
  $query = "SELECT * FROM $db WHERE $filter = :param";
  $queryParams = array(
    "param" => $inputData
  );
  if ($id != null){
    $query = $query . " AND id != :id";
    $queryParams["id"] = $id;
  }
  $statement = $PDO->prepare($query);
  $statement->execute($queryParams);
  $data = $statement->fetchAll(PDO::FETCH_ASSOC);
  if ($data != []){
    return true;
  }else{
    return false;
  }
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
  $person = getPersonByIdFromDatabase($id);
  if (password_verify($currentPassword, $person['password'])) {
    return true;
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
                                   ?int $id,

): array
{
  $validate = [];
  if (!checkNikInput($nik)) {
    $validate['nik'] = "1";
  }
  if (isInputDataExists("persons", $nik, $id,"nik")) {
    $validate['nik'] = "2";
  }
  if (isInputDataExists("persons", $email, $id,"email")) {
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

/**
 * translate data gender F into FEMALE and M into MALE
 */
function translateGender($gender): string|null
{
  if ($gender == "FEMALE") {
    return "F";
  }
  if ($gender == "MALE") {
    return "M";
  }
  return null;
}

/**
 * Translate role data A into ADMIN and M into MEMBER
 */
function translateRole($role): string|null
{
  if ($role == "ADMIN") {
    return "A";
  }
  if ($role == "MEMBER") {
    return "M";
  }
  return null;
}

function translateStatus($status): int|null
{
  if ($status == "ALIVE") {
    return 1;
  } else {
    return 0;
  }
}

/**
 * Translate value
 */
function translateValue($value, $data, $newValue1, $newValue2)
{
  if ($value == $data) {
    return $newValue1;
  } else {
    return $newValue2;
  }
}

/**
 * Check job input when edit person data
 */
function checkJobInputWhenEditPersonData($lastJobsId, $jobs, $status)
{
  if ($jobs == "" && $status != 0) {
    return $lastJobsId;
  } elseif ($status == 0) {
    return 1;
  } else {
    return $jobs;
  }
}

/**
 * is hobby exists
 */
function isHobbyExists($hobby, $id, ?int$hobbyId): bool
{
  
  global $PDO;
  $query = 'SELECT * FROM hobby WHERE name = :name AND person_id = :person_id';
  $queryParams = array(
    'name' => $hobby,
    'person_id' => $id
  );
  
  if ($hobbyId != null){
    $query = $query . " AND id != :id";
    $queryParams['id'] = $hobbyId;
  }
  $statement = $PDO->prepare($query);
  $statement->execute($queryParams);
  $data = $statement->fetchAll(PDO::FETCH_ASSOC);
  if ($data != []){
    return true;
  }else{
    return false;
  }
}

/**
 * Get person data by nik
 */
function getPersonDataByNik($nik): array
{
  global $PDO;
  $query = 'SELECT * FROM persons WHERE nik = :nik';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
      "nik" => $nik)
  );
  return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get person job by id
 */
function getJobsDataById($jobsId): array
{
  global $PDO;
  $query = 'SELECT * FROM person_job WHERE job_id = :job_id';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "job_id" => $jobsId
  ));
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Save job data into jobs database, and save update count
 */
function saveJobsData($jobsId, $count): void
{
  global $PDO;
  $query = 'UPDATE jobs SET count = :count WHERE id = :id';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "id" => $jobsId,
    "count" => $count,
  ));
}

/**
 * Get person last jobs in person_jobs database  by person_id
 */
function checkLastPersonJobs($id)
{
  global $PDO;
  $query = 'SELECT * FROM person_job WHERE person_id = :person_id';
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "person_id" => $id
  ));
  return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Update count in jobs database when change job data
 */
function updateCountOfJobsWhenEditPersonData($personId): void
{
  global $PDO;
  $personLastJobs = checkLastPersonJobs($personId);
  $lastJobs = getJobsDataById($personLastJobs['job_id']);
  $countLastJobs = count($lastJobs) - 1;
  $queryLastJobs = 'UPDATE jobs SET count = :count WHERE id = :id';
  $statement = $PDO->prepare($queryLastJobs);
  $statement->execute(array(
    "id" => $personLastJobs['job_id'],
    "count" => $countLastJobs,
  ));
}