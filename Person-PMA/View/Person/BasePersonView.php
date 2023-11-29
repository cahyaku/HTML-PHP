<?php

namespace App\View\Person;

use App\Entity\Person;
use App\Helper\TerminalHelper;
use App\Service\PersonService;
use App\Service\VehiclesService;

class BasePersonView
{
    public PersonService $personService;
    public VehiclesService $vehiclesService;

    /**
     * @param PersonService $personService
     * @param VehiclesService $vehiclesService
     */
    public function __construct(PersonService $personService, VehiclesService $vehiclesService)
    {
        $this->personService = $personService;
        $this->vehiclesService = $vehiclesService;
    }

    protected function askPersonData(?Person $personEdit = null): Person
    {
        if ($personEdit == null) {
            $nik = self::askForNik("NIK:");
            $name = self::askForName("Name:");
            $birthDate = self::askForDate(sentence: "Birth date(DD/MM/YYYY): ", date: null);
            $personData = new Person();
            $personData->setNik($nik);
            $personData->setName($name);
            $personData->setBirthDate($birthDate);
            $personData->setVehicles([]);
            return $personData;
        } else {
            $personData = self::askUpdatePerson($personEdit);
            return $personData;
        }
    }

    function searchPersons(): null|array
    {
        if ($this->personService->countAll() == 0) {
            echo "Empty data!!" . PHP_EOL;
        } else {
            $inputDataPerson = preg_quote(TerminalHelper::inputString("Name/NIK:"));
            if ($inputDataPerson == "") {
                echo "Data not found!!!" . PHP_EOL;
            } else {
                $searchResult = $this->personService->searchPerson($inputDataPerson);
                if ($searchResult == null) {
                    echo "Data not found!!!" . PHP_EOL;
                } else {
                    echo "=== Search Result ===" . PHP_EOL;
                    $this->showPersonBySearchResult($searchResult);
                }
                return $searchResult;
            }
        }
        return null;
    }

    private function showPersonBySearchResult(array $persons): array
    {
        $result = [];
        if ($persons != null) {
            $number = 1;
            foreach ($persons as $person => $value) {
                $result[] = $person;
                echo "$number. " . $value->getName() . " (NIK:" . $value->getNik() . ")" . PHP_EOL;
                $number++;
            }
        }
        return $result;
    }

    protected function getPersonBySearchResult(): Person|null
    {
        $persons = $this->personService->getAllPersons();
        $result = self::searchPersons();
        if ($result == null) {
            TerminalHelper::pressEnterToContinue();
        } else {
            $ordinal = TerminalHelper::askForOrdinalNumber($result, "Your choice:");
            $selectedPerson = $ordinal - 1;
            $id = $result[$selectedPerson]->getId();
            for ($i = 0; $i < count($persons); $i++) {
                if ($id == $persons[$i]->getId()) {
                    return $persons[$i];
                }
            }
        }
        return null;
    }

    static function askForName(?string $sentence = null, ?string $name = null): string
    {
        if ($name != null) {
            while (true) {
                $name = ucwords(TerminalHelper::inputString($sentence));
                if ($name == "") {
                    return $name;
                } else if (strlen($name) > 30) {
                    echo "The maximum length of Name input is 16 characters" . "\n";
                } else {
                    return $name;
                }
            }
        } else {
            while (true) {
                $name = ucwords(TerminalHelper::inputString($sentence));
                if ($name == "") {
                    echo "Please type your name!!! " . PHP_EOL;
                } else if (strlen($name) > 30) {
                    echo "The maximum length of Name input is 16 characters" . "\n";
                } else {
                    return $name;
                }
            }
        }
    }

    static public function askForNik(?string $sentence = null, ?string $nik = null): string
    {
        if ($nik != null) {
            while (true) {
                $nik = TerminalHelper::inputString($sentence);
                if ($nik == "") {
                    return $nik;
                } else if (strlen($nik) != 16) {
                    echo "The maximum length of NIK input is 16 characters" . "\n";
                } else {
                    return $nik;
                }
            }
        } else {
            while (true) {
                $nik = TerminalHelper::inputString($sentence);
                if ($nik == "") {
                    echo "Please type your NIK!!!" . PHP_EOL;
                } else if (strlen($nik) != 16) {
                    echo "The maximum length of NIK input is 16 characters" . "\n";
                } else {
                    return $nik;
                }
            }
        }
    }

    static function askUpdatePerson($personEdit)
    {
        echo "\nPress ENTER if the NIK is the same" . PHP_EOL;
        $nikInput = self::askForNik("NIK:" . " [" . $personEdit->getNik() . "]: ", $personEdit->getNik());
        $nik = $nikInput == "" ? $personEdit->getNik() : $nikInput;

        echo "\nPress ENTER if the Name is the same\n";
        $nameInput = self::askForName("Name:" . " [" . $personEdit->getName() . "]: ", $personEdit->getName());
        $name = $nameInput == "" ? $personEdit->getName() : $nameInput;

        echo "\nPress ENTER if the Birth date is the same\n";
        $birthDateInput = self::askForDate(sentence: "Birth date" . " [" . date('d/m/Y',
                $personEdit->getBirthDate()) . "]: ", date: $personEdit->getBirthDate());
        $birthDate = $birthDateInput == "" ? $personEdit->getBirthDate() : $birthDateInput;

        $personsData = new Person();
        $personsData->setId($personEdit->getId());
        $personsData->setNik($nik);
        $personsData->setName($name);
        $personsData->setBirthDate($birthDate);
        $personsData->setVehicles($personEdit->getVehicles());
        return $personsData;
    }

    static function askForDate(?string $sentence = null, ?string $errorMassage = null, ?string $format = 'd/m/Y', ?int $date = null): null|int
    {
        while (true) {
            if ($date != null) {
                $birthDate = TerminalHelper::inputString($sentence ?: "Date (DD/MM/YYYY):");
                if ($birthDate == "") {
                    return $date;
                } else {
                    $dateFormat = date_create_from_format($format, $birthDate);
                    if ($dateFormat == false) {
                        return null;
                    } else {
                        $timeStamp = date_format($dateFormat, 'U');
                        return ($timeStamp);
                    }
                }

            } else {
                $birthDate = TerminalHelper::inputString($sentence ?: "Date (DD/MM/YYYY):");
                if ($birthDate == "") {
                    echo $errorMassage ?: "Please type your birth date" . PHP_EOL;
                } else {
                    $dateFormat = date_create_from_format($format, $birthDate);
                    if ($dateFormat == false) {
                        return null;
                    } else {
                        $timeStamp = date_format($dateFormat, 'U');
                        return ($timeStamp);
                    }
                }
            }
        }
    }

    protected function confirmPersonData($person): void
    {
        echo PHP_EOL . "=== CONFIRMATION ===" . PHP_EOL;
        echo "NIK: " . $person->getnik() . PHP_EOL;
        echo "Name: " . $person->getName() . PHP_EOL;
        echo "Birth date: " . date('d/m/Y', $person->getBirthDate()) . PHP_EOL;
    }
}