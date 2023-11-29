<?php

namespace App\View\Vehicles;

use App\Helper\TerminalHelper;

class MainVehiclesView extends BaseVehiclesView
{
    function showVehiclesMenu($person): void
    {
        while (true) {
            TerminalHelper::clearScreen();
            echo PHP_EOL . "=== Vehicles \"" . $person->getName() . "\" ===" . PHP_EOL;
            echo "1. Show All Vehicles" . PHP_EOL;
            echo "2. Create" . PHP_EOL;
            echo "3. Edit" . PHP_EOL;
            echo "4. Remove" . PHP_EOL;
            echo "5. Back to main menu" . PHP_EOL;
            $input = TerminalHelper::inputString("Your choice: ");
            if ($input == "1") {
                $this->showVehicles($person);
            } else if ($input == "2") {
                $this->addVehicles($person);
            } else if ($input == "3") {
                $this->editVehicle($person);
            } else if ($input == "4") {
                $this->removeVehicles($person);
            } else if ($input == "5") {
                return;
            } else {
                echo "Please input 1, 2, 3, or 4 !!!" . PHP_EOL;
            }
            TerminalHelper::pressEnterToContinue();
        }
    }

    function showVehicles($person): void
    {
        $this->showAndGetVehicles($person->getVehicles());
    }

    function addVehicles($person): void
    {
        $newVehicles = new CreateVehiclesView($this->personService, $this->vehiclesService);
        $newVehicles->run($person);
    }

    function editVehicle($person): void
    {
        $editVehicle = new EditVehicleView($this->personService, $this->vehiclesService);
        $editVehicle->run($person);
    }

    function removeVehicles($person): void
    {
        $removeVehicle = new RemoveVehicleView($this->personService, $this->vehiclesService);
        $removeVehicle->run($person);
    }
}