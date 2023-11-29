<?php

namespace App\View\Person;

use App\Common\Constants;
use App\Helper\TerminalHelper;

class ShowPersonsView extends BasePersonView
{
    function run(): void
    {
        if ($this->personService->countAll() == 0) {
            echo "Empty data!!" . PHP_EOL;
            TerminalHelper::pressEnterToContinue();
        } else {
            $page = 1;
            $limit = 2;
            echo PHP_EOL . "=== All Person Data ===" . PHP_EOL;
            while (true) {
                $persons = $this->personService->getPaginatedData($page, $limit);
                if ($persons[Constants::PAGING_TOTAL_PAGE] < $page) {
                    break;
                }
                echo PHP_EOL . "== Page $page of " . $persons[Constants::PAGING_TOTAL_PAGE] . " (total: " . count($this->personService->getAllPersons()) . ") ==";
                $data = $persons[Constants::PAGING_DATA];

                for ($i = 0; $i < count($data); $i++) {
                    echo PHP_EOL . $i + 1 . ". Name: " . $data[$i]->getName() . PHP_EOL;
                    echo "   NIK: " . $data[$i]->getNik() . PHP_EOL;
                    echo "   Birth date: " . date('j/F/Y', $data[$i]->getBirthDate()) . PHP_EOL;
                }
                echo "\n=============================" . PHP_EOL;
                TerminalHelper::pressEnterToContinue();
                $page++;
            }
        }
    }
}