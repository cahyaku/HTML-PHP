<?php

namespace App;

use App\Repository\JsonPersonRepository;
use App\Service\PersonService;
use App\Service\VehiclesService;
use App\View\MainPersonView;

include "Autoloader.php";

$personRepository = JsonPersonRepository::getInstance();
$personService = PersonService::getInstance($personRepository);
$vehicleService = VehiclesService::getInstance($personRepository);
$personView = new MainPersonView($personService, $vehicleService);
$personView->showPersonMenu();