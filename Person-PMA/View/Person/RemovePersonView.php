<?php

namespace App\View\Person;

use App\Helper\TerminalHelper;

class RemovePersonView extends BasePersonView
{
    function run(): void
    {
        if ($this->personService->countAll() == 0) {
            echo "Empty data!!" . PHP_EOL;
            TerminalHelper::pressEnterToContinue();
        } else {
            echo "=== Remove Person Data ===" . PHP_EOL;
//            $person = new BasePersonView($this->personService);
            $person = new BasePersonView($this->personService, $this->vehiclesService);
            $personToDelete = $person->getPersonBySearchResult();
            if ($personToDelete != null) {
                $this->confirmPersonData($personToDelete);

                if (TerminalHelper::confirmYesNo("Are you sure want to remove this person data(y/n)?")) {
                    $this->personService->removePerson($personToDelete->getId());
                    echo "Data " . $personToDelete->getName() . " has been deleted!!!" . PHP_EOL;
                    TerminalHelper::pressEnterToContinue();
                } else {
                    echo "Cancel to remove person data " . $personToDelete->getName() . PHP_EOL;
                    TerminalHelper::pressEnterToContinue();
                }
            }
        }
    }
}