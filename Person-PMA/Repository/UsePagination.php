<?php

namespace App\Repository;

use App\Common\Constants;

trait UsePagination
{
    protected function paginateData(array $array, int $page, int $limit): array
    {
        $totalPage = ceil((float)count($array) / (float)$limit);
        $indexStart = ($page - 1) * $limit;
        $length = $limit;
        if (($indexStart + $limit) > count($array)) {
            $length = count($array) - $indexStart;
        }
        return [
            Constants::PAGING_TOTAL_PAGE => $totalPage,
            Constants::PAGING_DATA => array_slice($array, $indexStart, $length),
            Constants::PAGING_CURRENT_PAGE => $page,
        ];
    }
}