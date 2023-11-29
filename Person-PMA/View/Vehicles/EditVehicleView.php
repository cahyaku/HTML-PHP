<?php

namespace App\View\Vehicles;

use App\Helper\TerminalHelper;

class EditVehicleView extends BaseVehiclesView
{
    function run($person)
    {
        echo "=== Edit Vehicle Data ===" . PHP_EOL;
        $vehiclesData = $this->showAndGetVehicles($person->getVehicles());
        if ($vehiclesData != null) {
            $ordinal = TerminalHelper::askForOrdinalNumber($vehiclesData, "Your choice: ");
            $newVehicleData = $this->askVehiclesData($vehiclesData[$ordinal - 1]);
            $this->confirmVehiclesData($newVehicleData);
            if (TerminalHelper::confirmYesNo("Are you sure want to change the data(y/n)?")) {
//                $person->getVehicles()[$ordinal-1] = $newVehicleData;

                $this->vehiclesService->editVehicle($person, $newVehicleData, $ordinal);
                echo "Data " . $newVehicleData->getBrand() . " has been change!!!" . PHP_EOL;
            } else {
                echo "Cancel to change data!!!" . PHP_EOL;
            }
        }
    }
}