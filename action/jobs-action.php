<?php
require_once __DIR__ . "/utils-action.php";
require_once __DIR__ . "/../include/db.php";
require_once __DIR__ . "/constants.php";
global $PDO;

function searchJobs($searchInput): array
{
  global $PDO;
  $query = "SELECT * FROM jobs WHERE job_name LIKE '%$searchInput%'";
  $statement = $PDO->prepare($query);
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getJobsDataFromDatabase(): array
{
  global $PDO;
  $query = "SELECT * FROM jobs";
  $statement = $PDO->prepare($query);
  $statement->execute();
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getJobDataFromDatabase($jobInput):array
{
  global $PDO;
  $query = "SELECT * FROM jobs WHERE job_name = :job_name";
  $statement = $PDO->prepare($query);
  $statement->execute(array(
    "job_name" => $jobInput
  ));
  return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//function paginatedData($array, int $page, int $limit): array
//{
//  $totalPage = ceil((float)count($array) / (float)$limit);
//  $indexStart = ($page - 1) * $limit;
//  $length = $limit;
//  if (($indexStart + $limit) > count($array)) {
//    $length = count($array) - $indexStart;
//  }
//  return [
//    PAGING_TOTAL_PAGE => $totalPage,
//    PAGING_DATA => array_slice($array, $indexStart, $length),
//    PAGING_CURRENT_PAGE => $page,
//  ];
//}

function getPersonJobsByIdFromDatabase($id)
{
  global $PDO;
  $query = "SELECT * FROM jobs WHERE id LIKE '%$id%'";
  $statement = $PDO->prepare($query);
  $statement->execute();
  return $statement->fetch(PDO::FETCH_ASSOC);
}

function paginatedJobsData($search, int $page, int $limit): array
{
  global $PDO;
  $offset = ($page - 1) * $limit;
  
  if ($search != null) {
//    $queryData = "SELECT count(*) FROM jobs WHERE job_name LIKE '%$search%'";
//    $statementData = $PDO->query($queryData);
//    $totalData = $statementData->fetchColumn();
    
    $query = "SELECT * FROM jobs WHERE job_name LIKE '%$search%' LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    $totalData = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $query = "SELECT * FROM jobs WHERE job_name LIKE '%$search%' LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $queryData = 'SELECT count(*) FROM jobs';
    $statementData = $PDO->query($queryData);
    $totalData = $statementData->fetchColumn();
    
    $query = "SELECT * FROM jobs LIMIT $limit OFFSET $offset";
    $statement = $PDO->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  $totalPage = ceil((float)$totalData/ (float)$limit);
  
  return [
    PAGING_TOTAL_PAGE => $totalPage,
    PAGING_DATA => $result,
    PAGING_CURRENT_PAGE => $page,
  ];
}
