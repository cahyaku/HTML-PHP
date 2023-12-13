<?php

require_once __DIR__ . "/Action/login-action.php";


session_start();
session_unset();
session_destroy();

header('Location:login.php');

exit();