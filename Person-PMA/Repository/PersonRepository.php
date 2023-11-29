<?php

namespace App\Repository;

use App\Entity\Person;

interface PersonRepository
{
    function save(Person $person): null|Person;

    function remove(?int $id = null, ?int $ordinal = null, ?Person $person = null): array|bool;

    function getAll(): array;

    function getPaginatedData(int $page, int $limit): array;

    function isNikExists($nik, ?int $id): bool;

    function countAll(): int;

    function search(string $inputDataPerson): array;

}
