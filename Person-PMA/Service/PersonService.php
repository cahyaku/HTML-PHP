<?php

namespace App\Service;

use App\Entity\Person;
use App\Repository\PersonRepository;

class PersonService
{
    private static $instance = null;

    private PersonRepository $personRepository;

    private function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public static function getInstance($personRepository)
    {
        if (self::$instance == null) {
            self::$instance = new PersonService($personRepository);
        }
        return self::$instance;
    }

    function getAllPersons(): array
    {
        return $this->personRepository->getAll();
    }

    function countAll(): int
    {
        return $this->personRepository->countAll();
    }

    function getPaginatedData(int $page, int $limit): array
    {
        return $this->personRepository->getPaginatedData($page, $limit);
    }

    function searchPerson($inputDataPerson): array
    {
        return $this->personRepository->search($inputDataPerson);
    }

    /**
     * @throws \Exception
     */
    function createPerson($nik, string $name, $birthDate): null|Person
    {
        $persons = $this->personRepository->getAll();
        $checkNik = $this->personRepository->isNikExists($nik, $id = null);
        if ($checkNik) {
            throw new \Exception("Sorry, data could not be save because NIK: " . $nik . " already exists!!!");
        }
        $personsData = new Person();
        $personsData->setId(null);
        $personsData->setNik($nik);
        $personsData->setName($name);
        $personsData->setBirthDate($birthDate);
        $personsData->setVehicles([]);
        return $this->personRepository->save($personsData);
    }

    function removePerson($id): bool
    {
        return $this->personRepository->remove($id);
    }

    /**
     * @throws Exception
     */
    function editPerson($personEdit): null|Person
    {
        $checkNik = $this->personRepository->isNikExists($personEdit->getNik(), $personEdit->getId());
        if ($checkNik) {
            throw new \Exception("Sorry data can't be changed because NIK: " . $personEdit->getNik() . " already exists!!!");
        }
        $personData = new Person();
        $personData->setId($personEdit->getId());
        $personData->setNik($personEdit->getNik());
        $personData->setName($personEdit->getName());
        $personData->setBirthDate($personEdit->getBirthDate());
        $personData->setVehicles($personEdit->getVehicles());
        return $this->personRepository->save($personData);
    }
}