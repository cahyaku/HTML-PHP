<?php
require_once __DIR__ . "/common-action.php";

function search($search): array
{
  $persons = personsData();
  $searchResult = [];
  foreach ($persons as $person => $value) {
    if (preg_match("/$search/i", $value["firstName"])) {
      if (in_array($value["firstName"], $searchResult) == false) {
        $searchResult[] = $value;
      }
    }

//    else if (preg_match("/$search/i", $value["lastName"])) {
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
  foreach ($persons as $person => $value) {
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

function filterByAge($personsAge): null|string
{
  if ($personsAge <= 5) {
    return "toddler";
  } else if ($personsAge <= 60) {
    return "productiveAges";
  } else if ($personsAge >= 61) {
    return "passedAway";
  }
  return null;
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

//function personsData()
//{
//  return $person = loadDataFromJson("persons.json");
//}

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

function toddler(): array
{
  $persons = personsData();
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) <= 5 && $person["alive"] != null) {
      $toddler[] = $person;
    }
  }
  return $toddler;
}

function passedAway(): array
{
  $persons = personsData();
  foreach ($persons as $person) {
    if ($person["alive"] == null) {
      $passedAway[] = $person;
    }
  }
  return $passedAway;
}

function productiveAges(): array
{
  $persons = personsData();
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) >= 6 && checkAges($person["birthDate"]) <= 60 && $person["alive"] != null) {
      $productiveAges[] = $person;
    }
  }
  return $productiveAges;
}

function elderly():array
{
  $persons = personsData();
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) > 60 && $person["alive"] != null) {
      $elderly[] = $person;
    }
  }
  return $elderly;
}

function checkAges($birthDate)
{
  $date = date("d-m-Y", $birthDate);
  list($day, $month, $year) = explode('-', $date);
  $born = mktime(0, 0, 0, (int)$day, (int)$month, $year); //jam,menit,detik,tanggal,bulan,tahun
  $t = time();
  $age = ($born < 0) ? ($t + ($born * -1)) : $t - $born;
  $years = 60 * 60 * 24 * 365;
  $yearOfBirthDate = $age / $years;
  $currentAge = floor($yearOfBirthDate);
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
//
//function filterPersonDataByAge(): array
//{
//  $toddler = toddler();
//  $passedAway = passedAway();
//  $productiveAges = productiveAges();
//  $elderly = elderly();
//  if (count($toddler) != 0) {
//    return $toddler;
//  } else if (count($passedAway) != 0) {
//    return $passedAway;
//  } else if (count($productiveAges) != 0) {
//    return $productiveAges;
//  } else {
//    return $elderly;
//  }
//}