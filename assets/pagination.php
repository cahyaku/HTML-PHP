<?php

require_once __DIR__ . "/constants.php";

function paginatedData(array $array, int $page, int $limit): array
{
  $totalPage = ceil((float)count($array) / (float)$limit);
  $indexStart = ($page - 1) * $limit;
  $length = $limit;
  if (($indexStart + $limit) > count($array)) {
    $length = count($array) - $indexStart;
  }
  return [
    PAGING_TOTAL_PAGE => $totalPage,
    PAGING_DATA => array_slice($array, $indexStart, $length),
    PAGING_CURRENT_PAGE => $page,
  ];
//  return [
//    "totalPage" => $totalPage,
//    "pagingData" => array_slice($array, $indexStart, $length),
//    "currentPage" => $page,
//  ];
}