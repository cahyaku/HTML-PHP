<?php
require_once __DIR__ . "/json.php";

function search($search): array
{
//  $search = $_GET['search'];
  $persons = personData();
  $searchResult = [];
  foreach ($persons as $person => $value) {
    if (preg_match("/$search/i", $value["firstName"])) {
      if (in_array($value["firstName"], $searchResult) == false) {
        $searchResult[] = $value;
      }
    }
    
//    if (preg_match("/$search/i", $value["lastName"])) {
//      if (in_array($value["lastName"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
    
    if (preg_match("/$search/i", $value["nik"])) {
      if (in_array($value["nik"], $searchResult) == false) {
        $searchResult[] = $value;
      }
    }
  }
  return $searchResult;
}

function searchByAges($search, $persons): array
{
//  $persons = $filter;
  $searchResult = [];
  foreach ($persons as $person => $value ) {
    if (preg_match("/$search/i", $value["firstName"])) {
      if (in_array($value["firstName"], $searchResult) == false) {
        $searchResult[] = $value;
      }
    }
    if (preg_match("/$search/i", $value["nik"])) {
      if (in_array($value["nik"], $searchResult) == false) {
        $searchResult[] = $value;
      }
    }
  }
  return $searchResult;
}

//function searchByProductive($search): array
//{
//  $persons = toddler();
//  $searchResult = [];
//  foreach ($persons as $person => $value ) {
//    if (preg_match("/$search/i", $value["firstName"])) {
//      if (in_array($value["firstName"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
//    if (preg_match("/$search/i", $value["nik"])) {
//      if (in_array($value["nik"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
//  }
//  return $searchResult;
//}


function personData()
{
  return $person = loadDataFromJson("persons.json");
}

//function checkAges($date)
//{
////  $persons = personData();
////  $date = $persons['birthDate'];
//  $birthDate = new \DateTime($date);
//  $today = new \DateTime("today");
//  if ($birthDate > $today) {
//    $y = "0";
//    $m = "0";
//    $d = "0";
////    return "0 year 0 month 0 day";
//  }
//  $y = $today->diff($birthDate)->y;
//  $m = $today->diff($birthDate)->m;
//  $d = $today->diff($birthDate)->d;
//  return $y;
//}

//function checkAge(int $date): int
//{
//  $total = time() - $date;
//  return floor($total / (60 * 60 * 24 * 365));
//}

function toddler()
{
  $persons = personData();
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) <= 5 ) {
      $toddler[] = $person;
    }
  }
  return $toddler;
}

function passedAway()
{
  $persons = personData();
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) > 60 ) {
      $toddler[] = $person;
    }
  }
  return $toddler;
}

function productiveAges()
{
  $persons = personData();
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) >= 6 && checkAges($person["birthDate"]) <= 60) {
      $productiveAges[] = $person;
    }
  }
  return $productiveAges;
}

function checkAges($birthDate)
{
  $date = date("d-m-Y", $birthDate);
  list($day,$month,$year) = explode('-',$date);
  $born = mktime(0, 0, 0, (int)$day, (int)$month, $year); //jam,menit,detik,tanggal,bulan,tahun
  $t = time();
  $age = ($born < 0) ? ( $t + ($born * -1) ) : $t - $born;
  $years = 60 * 60 * 24 * 365;
  $yearOfBirthDate = $age / $years;
  $currentAge = floor($yearOfBirthDate) ;
  return $currentAge;
}

//function orderByAges()
//{
//  $persons = personData();
//  foreach ($persons as $person) {
//    if (checkAges($person["birthDate"]) < 5) {
//      $toddler[] = $person;
//    }
//  }
//  return $toddler;
//}

//function orderByAge()
//{
//  $persons = personData();
//  foreach ($persons as $person) {
//    if (checkAges($person["birthDate"]) < 5 ) {
//      $toddler[] = $person;
//    }
//  }
//  return $toddler;
//}

//$age = checkAges();
//function filterPersonsByAges($age)
//{
//  $persons = personData();
//  for ($i = 0; $i<= count($persons); $i++) {
//    if ($age <= 5) {
//      return $persons[$i];
//    } else if ($age >= 6 && $age <= 60) {
//      return $persons[$i];
//    } else {
//      return $persons[$i];
//    }
//  }
//  return null;
//}
//function searchPerson()
//{
//  $persons = loadDataFromJson("persons.json");
//  $search = $_GET['search'];
//  $results = [];
//  $resultsByNik = [];
//  if (isset($search)) {
//    foreach ($persons as $value) {
//      if (preg_match("/$search[0]/i", $value["firstName"]) == 1) {
//        $results [] = $value;
//      }
//    }
//
//    foreach ($persons as $value) {
//      if (preg_match("/$search[0]/i", $value["nik"]) == 1) {
//        $resultsByNik[] = $value;
//      }
//    }
//
//    foreach ($resultsByNik as $result) {
//      if (in_array($result, $results) == 0) {
//        $results[] = $result;
//      }
//    }
//
//    if (count($results) != null) {
//      return $results;
//    }
//  }
//  return null;
//}

// set the last login date
//add_action('wp_login','iiwp_set_last_login', 0, 2);


function iiwp_set_last_login($login) {
  
  $user = personData();
  $user = "get_user_by"('login',$login);
  $time = "current_time"( 'timestamp' );
  $last_login = "get_user_meta"( $user->ID, '_last_login', 'true' );

  if(!$last_login){
    "update_usermeta"( $user->ID, '_last_login', $time );
  }else{
    "update_usermeta"( $user->ID, '_last_login_prev', $last_login );
    "update_usermeta"( $user->ID, '_last_login', $time );
  }

}
//
//// get last login date
//function iiwp_get_last_login($user_id,$prev=null){
//
//  $last_login = get_user_meta($user_id);
//  $time = current_time( 'timestamp' );
//
//  if(isset($last_login['_last_login_prev'][0]) && $prev){
//    $last_login = get_user_meta($user_id, '_last_login_prev', 'true' );
//  }else if(isset($last_login['_last_login'][0])){
//    $last_login = get_user_meta($user_id, '_last_login', 'true' );
//  }else{
//    update_usermeta( $user_id, '_last_login', $time );
//    $last_login = $last_login['_last_login'][0];
//  }
//
//  return $last_login;
//}


