<?php

namespace App\View;

use App\Helper\TerminalHelper;
use App\View\Person\BasePersonView;
use App\View\Person\CreatePersonView;
use App\View\Person\EditPersonView;
use App\View\Person\RemovePersonView;
use App\View\Person\SearchPersonView;
use App\View\Person\ShowPersonsView;
use App\View\Vehicles\BaseVehiclesView;

class MainPersonView extends BasePersonView
{
    function showPersonMenu(): void
    {
        while (true) {
            TerminalHelper::clearScreen();
            echo "\nPERSON MANAGEMENT" . PHP_EOL;
            echo "1. Show All Person" . PHP_EOL;
            echo "2. Search" . PHP_EOL;
            echo "3. Add" . PHP_EOL;
            echo "4. Edit" . PHP_EOL;
            echo "5. Remove" . PHP_EOL;
            echo "6. Vehicles" . PHP_EOL;
            echo "7. Exit " . PHP_EOL;
            $input = TerminalHelper::inputString("Your choice: ");
            if ($input == "1") {
                $this->showAllPerson();
            } else if ($input == "2") {
                $this->searchPerson();
            } else if ($input == "3") {
                $this->addPerson();
            } else if ($input == "4") {
                $this->editPerson();
            } else if ($input == "5") {
                $this->removePerson();
            } else if ($input == "6") {
                $this->vehicles();
            } else if ($input == "7") {
                return;
            } else {
                echo "Please input 1, 2, 3, 4, 5, 6 or 7 !!!" . PHP_EOL;
                TerminalHelper::pressEnterToContinue();
            }
        }
    }

    function showAllPerson(): void
    {
        $viewPerson = new ShowPersonsView($this->personService, $this->vehiclesService);
        $viewPerson->run();
    }

    function searchPerson(): void
    {
        $searchPerson = new SearchPersonView($this->personService, $this->vehiclesService);
        $searchPerson->run();
    }

    function addPerson(): void
    {
        $newPerson = new CreatePersonView($this->personService, $this->vehiclesService);
        $newPerson->run();
    }

    function removePerson(): void
    {
        $removePerson = new RemovePersonView($this->personService, $this->vehiclesService);
        $removePerson->run();
    }

    function editPerson(): void
    {
        $editPerson = new EditPersonView($this->personService, $this->vehiclesService);
        $editPerson->run();
    }

    function vehicles(): void
    {
        $vehicles = new BaseVehiclesView($this->personService, $this->vehiclesService);
        $vehicles->selectForOwnership();
    }
}