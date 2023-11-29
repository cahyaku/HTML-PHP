<?php

namespace App\Repository;

abstract class BaseRepository
{
    protected function generateId(array|null $array): int
    {
        return $array == null ? 1 : (end($array)->getId() + 1);
    }
}