<?php

namespace App\View\Person;

use App\Helper\TerminalHelper;

class SearchPersonView extends BasePersonView
{
    function run()
    {
//        $person = new BasePersonView($this->personService);
        $person = new BasePersonView($this->personService, $this->vehiclesService);
        $person->searchPersons();
        TerminalHelper::pressEnterToContinue();
    }
}