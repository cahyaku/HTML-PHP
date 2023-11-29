<?php

namespace App\View\Person;

use App\Helper\TerminalHelper;

class CreatePersonView extends BasePersonView
{
    function run()
    {
        echo "=== Add Person Data ===" . PHP_EOL;
        $personData = $this->askPersonData();
        $this->confirmPersonData($personData);
        if (TerminalHelper::confirmYesNo("Are you sure want to save this person data (y/n)?")) {
            try {
                $this->personService->createPerson(
                    nik: $personData->getNik(),
                    name: $personData->getName(),
                    birthDate: $personData->getBirthDate(),
                );
                echo "Data " . $personData->getName() . " has been saved!!!" . PHP_EOL;
                TerminalHelper::pressEnterToContinue();
            } catch (\Exception $exception) {
                echo "{$exception->getMessage()}" . PHP_EOL;
                TerminalHelper::pressEnterToContinue();
            }
        } else {
            echo "Cancel to save data " . $personData->getName() . PHP_EOL;
            TerminalHelper::pressEnterToContinue();
        }
    }
}