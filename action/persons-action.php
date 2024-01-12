<?php
require_once __DIR__ . "/common-action.php";

/**
 * Search person data by first name or NIK
 *
 * @param $search
 * @return array
 */
function search($search): array
{
  $persons = getPersonsDataFromJson();
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

/**
 * Search person data by age
 *
 * @param $search
 * @param $persons
 * @return array
 */
function searchByAges($search, $persons): array
{
//  $persons = $filter;
  $searchResult = [];
  foreach ($persons as $person => $value) {
    if (preg_match("/$search/i", $value["firstName"])) {
      if (!in_array($value["firstName"], $searchResult)) {
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

/**
 * Check and get toddler data
 * @return array
 */
function getToddlerData(): array
{
  $persons = getPersonsDataFromJson();
  $toddler = [];
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) <= 5 && $person["alive"] != null) {
      $toddler[] = $person;
    }
  }
  return $toddler;
}

/**
 * Get passed away data from json
 */
function getPassedAwayData(): array
{
  $persons = getPersonsDataFromJson();
  $passedAway = [];
  foreach ($persons as $person) {
    if ($person["alive"] == null) {
      $passedAway[] = $person;
    }
  }
  return $passedAway;
}

/**
 * get productive ages data
 * @return array
 */
function getProductiveAgesData(): array
{
  $persons = getPersonsDataFromJson();
  $productiveAges = [];
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) >= 6 && checkAges($person["birthDate"]) <= 60 && $person["alive"] != null) {
      $productiveAges[] = $person;
    }
  }
  return $productiveAges;
}

/**
 * Get elderly data
 * @return array
 */
function getElderlyData():array
{
  $persons = getPersonsDataFromJson();
  $elderly = [];
  foreach ($persons as $person) {
    if (checkAges($person["birthDate"]) > 60 && $person["alive"] != null) {
      $elderly[] = $person;
    }
  }
  return $elderly;
}

/**
 * Check and get person age by date of birth
 */
function checkAges($birthDate):int
{
  $date = date("d-m-Y", $birthDate);
  list($day, $month, $year) = explode('-', $date);
  $born = mktime(0, 0, 0, (int)$day, (int)$month, $year); //jam,menit,detik,tanggal,bulan,tahun
  $t = time();
  $age = ($born < 0) ? ($t + ($born * -1)) : $t - $born;
  $years = 60 * 60 * 24 * 365;
  $yearOfBirthDate = $age / $years;
  return floor($yearOfBirthDate);
}