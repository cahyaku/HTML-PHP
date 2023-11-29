<?php

namespace App\View\Person;

use App\Helper\TerminalHelper;

class EditPersonView extends BasePersonView
{
    function run()
    {
        if ($this->personService->countAll() == 0) {
            echo "Empty data!!" . PHP_EOL;
            TerminalHelper::pressEnterToContinue();
        } else {
            echo "=== Edit Person Data ===" . PHP_EOL;
            $person = new BasePersonView($this->personService, $this->vehiclesService);
            $personToEdit = $person->getPersonBySearchResult();
            if ($personToEdit != null) {
                $personData = $this->askPersonData($personToEdit);

                $this->confirmPersonData($personData);
                if (TerminalHelper::confirmYesNo("Are you sure want to change the data (y/n)?")) {
                    try {
                        $this->personService->editPerson($personData);
                        echo "Data " . $personData->getName() . " has been changed!!!" . PHP_EOL;
                        TerminalHelper::pressEnterToContinue();
                    } catch
                    (\Exception $exception) {
                        echo "{$exception->getMessage()}" . PHP_EOL;
                        TerminalHelper::pressEnterToContinue();
                    }
                } else {
                    echo "Cancel to change data " . $personData->getName() . PHP_EOL;
                    TerminalHelper::pressEnterToContinue();
                }
            }
        }
    }
}