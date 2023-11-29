<?php

namespace App\View\Vehicles;

use App\Common\Constants;
use App\Entity\Vehicles;
use App\Helper\TerminalHelper;
use App\View\Person\BasePersonView;

class BaseVehiclesView extends BasePersonView
{
    public function askVehiclesData(?Vehicles $vehicles = null): Vehicles
    {
        if ($vehicles == null) {
            $brand = $this->askInputVehiclesData("Brand: ", "brand", "brand");
            $model = $this->askInputVehiclesData("Model: ", "model", "model");
            $type = $this->askForVehicleType(vehicles: null);
            $vehiclesData = new Vehicles();
            $vehiclesData->setBrand($brand);
            $vehiclesData->setModel($model);
            $vehiclesData->setType($type);
            return $vehiclesData;
        } else {
            $vehiclesData = $this->askUpdateData($vehicles);
            return $vehiclesData;
        }
    }

    private function askUpdateData($vehicles)
    {
        echo "\nPress ENTER if the Brand is the same" . PHP_EOL;
        $brandInput = TerminalHelper::inputString("Brand [" . $vehicles->getBrand() . "]: ");
        $brand = $brandInput == "" ? $vehicles->getBrand() : $brandInput;

        echo "\nPress ENTER if the Model is the same" . PHP_EOL;
        $modelInput = TerminalHelper::inputString("Model [" . $vehicles->getModel() . "]: ");
        $model = $modelInput == "" ? $vehicles->getModel() : $modelInput;

        echo "\nPress ENTER if the Type is the same" . PHP_EOL;
        $typeInput = strtoupper(TerminalHelper::inputString("Type [" . $this->translateVehicleType($vehicles->getType()) . "]: "));
        $type = $typeInput == "" ? $vehicles->getType() : $this->translateVehicleTypeIntoInt($typeInput);

        $vehicleData = new Vehicles();
        $vehicleData->setBrand($brand);
        $vehicleData->setModel($model);
        $vehicleData->setType($type);
        return $vehicleData;
    }

    public function selectForOwnership()
    {
        if ($this->personService->countAll() == 0) {
            echo "Empty data!!!" . PHP_EOL;
            TerminalHelper::pressEnterToContinue();
        } else {
            $person = new BasePersonView($this->personService, $this->vehiclesService);

            $selectedPerson = $person->getPersonBySearchResult();
            if ($selectedPerson != null) {
                $person = new MainVehiclesView($this->personService, $this->vehiclesService);

                $person->showVehiclesMenu($selectedPerson);
            }
        }
    }

    function confirmVehiclesData($vehicles): void
    {
        echo PHP_EOL . "=== Vehicles ===" . PHP_EOL;
        echo "Brand: " . ucwords($vehicles->getBrand()) . PHP_EOL;
        echo "Model: " . ucwords($vehicles->getModel()) . PHP_EOL;
        echo "Type: " . $this->translateVehicleType($vehicles->getType()) . PHP_EOL;
    }

    function translateVehicleType(int $status): string
    {
        switch ($status) {
            case 1:
                return "Motorcycle";
            case 2:
                return "Car";
            default:
                return "";
        }
    }

    function translateVehicleTypeIntoInt(string $status): int
    {
        switch ($status) {
            case "MOTORCYCLE":
                return Constants::MOTORCYCLE;
            case "CAR":
                return Constants::CAR;
            default:
                return -1;
        }
    }

    function askForVehicleType(?array $vehicles = null)
    {
        if ($vehicles == null) {
            while (true) {
                $statusInput = strtoupper(TerminalHelper::inputString("Type(motorcycle/car): "));
                if ($statusInput == "") {
                    echo "Please input your vehicle type!!!" . PHP_EOL;
                } else {
                    return $this->translateVehicleTypeIntoInt($statusInput);
                }
            }
        } else {
            while (true) {
                $statusInput = strtoupper(TerminalHelper::inputString("Type: " .
                    " [" . $this->translateVehicleType($vehicles[Constants::TYPE]) . "]: "));
                if ($statusInput == "") {
                    return $vehicles[Constants::TYPE];
                } else if ($this->translateVehicleTypeIntoInt($statusInput) == -1) {
                    echo "Please input your vehicle type!!!" . PHP_EOL;
                } else {
                    return $this->translateVehicleTypeIntoInt($statusInput);
                }
            }
        }
    }

    function showAndGetVehicles(array $vehicles): array
    {
        $result = [];
        echo "=== Vehicles Data ===" . PHP_EOL;
        $number = 1;
        for ($i = 0; $i < count($vehicles); $i++) {
            $result[] = $vehicles[$i];
            echo $number . ". Brand: " . ucwords($vehicles[$i]->getBrand()) . PHP_EOL;
            echo "   Model: " . ucwords($vehicles[$i]->getModel()) . PHP_EOL;
            echo "   Type: " . $this->translateVehicleType($vehicles[$i]->getType()) . PHP_EOL;
            echo "===============================" . PHP_EOL;
            $number++;
        }
        return $result;
    }

    private function askInputVehiclesData(?string $sentenceAskForInput = null,
                                          ?string $sentence1 = null,
                                          ?string $sentence2 = null,
                                          ?string $data = null): string
    {
        if ($data != null) {
            while (true) {
                $data = ucwords(TerminalHelper::inputString($sentenceAskForInput));
                if ($data == "") {
                    return $data;
                } else if (strlen($data) > 30) {
                    echo "The maximum length of $sentence2 input is 16 characters" . "\n";
                } else {
                    return $data;
                }
            }
        } else {
            while (true) {
                $data = ucwords(TerminalHelper::inputString($sentenceAskForInput));
                if ($data == "") {
                    echo "Please input vehicle $sentence1 !!!" . PHP_EOL;
                } else if (strlen($data) > 30) {
                    echo "The maximum length of $sentence2 input is 30 characters" . "\n";
                } else {
                    return $data;
                }
            }
        }
    }
}