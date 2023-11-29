<?php

namespace App\View\Vehicles;

use App\Helper\TerminalHelper;

class RemoveVehicleView extends BaseVehiclesView
{
    function run($person)
    {
        echo "=== Remove Vehicles Data ===" . PHP_EOL;
        $vehiclesData = $this->showAndGetVehicles($person->getVehicles());
        if ($vehiclesData != null) {
            $ordinal = TerminalHelper::askForOrdinalNumber($vehiclesData, "Your choice: ");
            $VehicleDataToRemove = $vehiclesData[$ordinal - 1];
            $this->confirmVehiclesData($VehicleDataToRemove);
            if (TerminalHelper::confirmYesNo("Are you sure want to remove this data(y/n)?")) {
                $this->vehiclesService->removeVehicle($person, $ordinal);
                echo "Data " . $VehicleDataToRemove->getBrand() . " has been delete!!!" . PHP_EOL;
            } else {
                echo "Cancel to remove data!!!" . PHP_EOL;
            }
        }
    }
}