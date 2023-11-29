<?php

namespace App\View\Vehicles;

use App\Helper\TerminalHelper;

class CreateVehiclesView extends BaseVehiclesView
{
    function run($person)
    {
        echo "=== Add Vehicles Data ===" . PHP_EOL;
        $vehiclesData = $this->askVehiclesData();
        $this->confirmVehiclesData($vehiclesData);
        if (TerminalHelper::confirmYesNo("Are you sure want to save this vehicles data (y/n)?")) {
            $this->vehiclesService->createVehicles(
                person: $person, brand: $vehiclesData->getBrand(), model: $vehiclesData->getModel(), type: $vehiclesData->getType()
            );
            echo "Data telah disimpan!!!" . PHP_EOL;
        } else {
            echo "Cancel to save data!!!" . PHP_EOL;
        }
    }
}
