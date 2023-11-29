<?php
echo $_POST["name"];

$loginData = loadDataFromJson("persons.json");

function checkLogin($loginData):array
{
    for ($i = 0; $i < count($loginData); $i++) {
        if ($loginData[$i]["email"] == $_POST['email'] && $loginData[$i]["password"] == $_POST['password']) {
            return $loginData[$i]["name"];
        }
    }
    return [];
}