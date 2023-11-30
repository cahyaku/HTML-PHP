<?php
// echo $_POST["cahya"];

//$loginData = [
//  [
//    "email" => "cahya@gmail.com",
//    "password" => "cahya123"
//  ],
//  [
//    "email" => "kumala@gmail.com",
//    "password" => "kumala321"
//  ],
//];

// $_POST[$loginData];
// if ($loginData) {
//   header('Location: ../login.php?error=true');
//   die();
// }

//function loadDataFromJson(string $fileName): array
//{
//    if (file_exists($fileName)) {
//        $data = file_get_contents($fileName);
//        $result = json_decode($data, true);
//        return $result;
//    }
//    return [];
//}

function loadDataFromJson(string $fileName): array
{
    $path = __DIR__ . "/../" . $fileName;
    if (file_exists($path)) {
        $data = file_get_contents($path);
        $results = json_decode($data, true);
        if ($results == null) {
            return [];
        }
        return $results;
    }
    return [];
}

// Data persons dari JSON
$loginData = loadDataFromJson("persons.json");

function validateData($data): bool
{
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]["email"] == $_POST['email'] && $data[$i]["password"] == $_POST['password']) {
            return true;
        }
    }
    return false;
}

if (validateData($loginData)) {
    header('Location: ../dashboard.php', 'id=$id');
    die();
} else {
    header('Location: ../login.php?error=1');
    die();
}

//function validateData($data): bool
//{
//    for ($i = 0; $i < count($data); $i++) {
//        if ($data[$i]["email"] == $_POST['email'] && $data[$i]["password"] == $_POST['password']) {
//            return true;
//        } else {
//            return true;
//        }
//    }
//    return false;
//}

//function checkData($loginData)
//{
//    for ($i = 0; $i < count($loginData); $i++) {
//        if ($loginData[$i]["email"] == $_POST['email'] && $loginData[$i]["password"] == $_POST['password']) {
//            header('Location: ../dashboard.php');
//            die();
//        }
//    }
//    header('Location: ../login.php?error=1');
//    die();
//}


