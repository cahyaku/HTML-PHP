<?php

namespace App\Repository;

use App\Common\Constants;
use App\Entity\Person;
use App\Entity\Vehicles;
use App\Helper\JsonHelper;

class JsonPersonRepository extends BaseRepository implements PersonRepository
{
    use UsePagination;

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new JsonPersonRepository();
        }
        return self::$instance;
    }

    function countAll(): int
    {
        // TODO: Implement countAll() method.
        return count($this->getAll());
    }

    public function search(string $inputDataPerson): array
    {
        $persons = $this->getAll();
        $searchResult = [];
        foreach ($persons as $person => $value) {
            if (preg_match("/$inputDataPerson/i", $value->getName())) {
                if (in_array($value->getName(), $searchResult) == false) {
                    $searchResult[] = $value;
                }
            }
            if (preg_match("/$inputDataPerson/i", $value->getNik())) {
                if (in_array($value->getNik(), $searchResult) == false) {
                    $searchResult[] = $value;
                }
            }
        }
        return $searchResult;
    }

    public function save(Person $person): null|Person
    {
        $persons = $this->getAll();

        if ($person->getId() == null) {
            $id = BaseRepository::generateId($this->getAll());
            $person->setId($id);
            $persons[] = $person;
            JsonHelper::saveDataIntoJson($persons, Constants::JSON_PERSON);
        } else {
            for ($i = 0; $i < count($persons); $i++) {
                if ($persons[$i]->getId() == $person->getId()) {
                    $persons[$i]->setNik($person->getNik());
                    $persons[$i]->setName($person->getName());
                    $persons[$i]->setBirthDate($person->getBirthDate());
                    $persons[$i]->setVehicles($person->getVehicles());
                    JsonHelper::saveDataIntoJson($persons, Constants::JSON_PERSON);
                }
            }
        }
        return null;
    }

    function remove(?int $id = null, ?int $ordinal = null, ?Person $person = null): array|bool
    {
        if ($person != null) {
            $vehicles = $person->getVehicles();
            unset ($vehicles[$ordinal - 1]);
            return array_values($vehicles);

        } else {
            $persons = $this->getAll();
            for ($i = 0; $i < sizeof($persons); $i++) {
                if ($id == $persons[$i]->getId()) {
                    unset ($persons[$i]);
                    $persons = array_values($persons);
                    JsonHelper::saveDataIntoJson($persons, Constants::JSON_PERSON);
                    return true;
                }
            }
        }
        return false;
    }

    function isNikExists($nik, ?int $id): bool
    {
        foreach ($this->getAll() as $person => $value) {
            if ($id == null) {
                if ($value->getNik() == $nik) {
                    return true;
                }
            } else {
                if ($nik == $value->getNik() && $id != $value->getId()) {
                    return true;
                }
            }
        }
        return false;
    }

    function getAll(): array
    {
        $persons = JsonHelper::loadDataFromJson(Constants::JSON_PERSON);
        $result = [];
        foreach ($persons as $key => $value) {
            $person = new Person();
            $person->setId($value['id']);
            $person->setNik($value['nik']);
            $person->setName($value['name']);
            $person->setBirthDate($value['birthDate']);

//            $result[] = $person;
            if ($value['vehicles'] != []) {
                $vehicles = [];
                for ($i = 0; $i < count($value['vehicles']); $i++) {
                    $vehicle = new Vehicles();
                    $vehicle->setBrand($value['vehicles'][$i]['brand']);
                    $vehicle->setModel($value['vehicles'][$i]['model']);
                    $vehicle->setType($value['vehicles'][$i]['type']);
                    $vehicles[] = $vehicle;
                }
                $person->setVehicles($vehicles);
            } else {
                $person->setVehicles($value['vehicles']);
            }
            $result [] = $person;
        }
//        $person = $result;
//        return $person;
        
        return $result;
    }

    function getPaginatedData(int $page, int $limit): array
    {
        $persons = $this->getAll();
        return $this->paginateData($persons, $page, $limit);
    }
}