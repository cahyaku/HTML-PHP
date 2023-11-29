<?php

namespace App\Service;

use App\Entity\Person;
use App\Entity\Vehicles;
use App\Repository\PersonRepository;

class VehiclesService
{
    private static $instance = null;

    private PersonRepository $personRepository;

    private function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public static function getInstance(PersonRepository $personRepository): VehiclesService
    {
        if (self::$instance == null) {
            self::$instance = new VehiclesService($personRepository);
        }
        return self::$instance;
    }

    function createVehicles(Person $person, string $brand, string $model, $type): null|Person
    {
        $newVehiclesData = new Vehicles();
        $newVehiclesData->setBrand($brand);
        $newVehiclesData->setModel($model);
        $newVehiclesData->setType($type);
        $vehicles = $person->getVehicles();
        $vehicles[] = $newVehiclesData;
        $person->setVehicles($vehicles);
        return $this->personRepository->save($person);
    }

    function editVehicle(Person $person, $vehicleEdit, $ordinal): null|Person
    {

        $person->getVehicles()[$ordinal - 1] = $vehicleEdit;
        return $this->personRepository->save($person);
    }

    function removeVehicle($person, $ordinal): bool
    {
        $vehicles = $this->personRepository->remove(ordinal: $ordinal, person: $person);
        $person->setVehicles($vehicles);
        if ($this->personRepository->save($person)) {
            return true;
        }
        return false;
    }
}
