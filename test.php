//function generateId(array|null $array): int
//{
//  return $array == null ? 1 : (end($array['id']) + 1);
//
//}
//
//function save($person): void
//{
//  $persons = personsData();
//  if ($person['id'] == null) {
////    $id = generateId($persons);
//    $lastPerson = $persons[count($persons) -1];
//    $id = $lastPerson["id"] + 1;
//    $person['id'] = $id;
//    $persons[] = $person;
//    saveDataIntoJson($persons);
//  } else {
//    for ($i = 0; $i < count($persons); $i++) {
//      if ($persons[$i]['id'] == $person['id']) {
//        $persons[$i]['nik'] = $person['nik'];
//        $persons[$i]['firstName'] = $person['firstName'];
//        $persons[$i]['lastName'] = $person['lastName'];
//        $persons[$i]['birthDate'] = $person['birthDate'];
//        $persons[$i]['sex'] = $person['sex'];
//        $persons[$i]['email'] = $person['email'];
//        $persons[$i]['password'] = $person['password'];
//        $persons[$i]['address'] = $person['address'];
//        $persons[$i]['role'] = $person['role'];
//        $persons[$i]['internalNotes'] = $person['internalNotes'];
//        $persons[$i]['loggedIn'] = $person['loggedIn'];
//        $persons[$i]['alive'] = $person['alive'];
//        saveDataIntoJson($persons);
//      }
//    }
//  }
//}

save pada saat add person action
//  $personData = [
//    "id" => $id,
//    "nik" => htmlspecialchars($_POST['nik']),
//    "firstName" =>htmlspecialchars($_POST['firstName']),
//    "lastName" => htmlspecialchars($_POST['lastName']),
//    "birthDate" => $birthDate,
//    "sex" => $_POST['sex'],
//    "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
//    "password" => $password,
//    "address" => htmlspecialchars($_POST['address']),
//    "role" => $_POST['role'],
//    "internalNotes" => htmlspecialchars($_POST['internalNotes']),
//    "loggedIn" => null,
//    "alive" => $_POST['alive']
//  ];
//  $persons[] = $personData;
//  saveDataIntoJson("persons.json",$persons);
//  redirect("../persons.php", "success");