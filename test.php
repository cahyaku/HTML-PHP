<?php
//session_start();
//require_once __DIR__ . "/action/utils-action.php";
//redirectWhenNotLoggedIn($_SESSION['email']);
//require_once __DIR__ . "/action/persons-action.php";
//require_once __DIR__ . "/include/db.php";
//global $PDO;
//?>
<!---->
<?php
//require_once __DIR__ . "/include/header.php";
//showHeader("Persons-PMA", "persons.css", personsNav: "persons-nav-link");
//?>
<!--<main>-->
<!--  <section class="section-persons d-flex">-->
<!--    --><?php
//    require_once __DIR__ . "/include/sidebar.php";
//    showSidebar(personsNav: "persons-nav-link");
//    ?>
<!--    <!-- MAIN CONTENT -->-->
<!--    <div class="main-content-persons">-->
<!--      <div class="persons-box d-flex justify-content-between">-->
<!--        <div class="person-header">-->
<!--          <h3 class="box-title">Persons</h3>-->
<!--        </div>-->
<!---->
<!--        <div class="add-button">-->
<!--          <button type="button" class="btn btn-outline-primary btn-add">-->
<!--            --><?php
//            if (checkRole($_SESSION['email']) != null) {
//              ?>
<!--              <a class="add" href="add-person.php">-->
<!--                +Add-->
<!--              </a>-->
<!--            --><?php //} else { ?>
<!--              <a class="add" href="persons.php?error=1">-->
<!--                +Add-->
<!--              </a>-->
<!--            --><?php //} ?>
<!--          </button>-->
<!--        </div>-->
<!--      </div>-->
<!--      --><?php //if ($_GET["error"] == 1) : ?>
<!--        <div class="alert alert-danger" role="alert">-->
<!--          Only admin roles can add new person data!!!-->
<!--        </div>-->
<!--      --><?php //endif; ?>
<!--      <div class="search-box">-->
<!--        <form class="form d-flex" name="search-form" role="search" method="get" action="#table">-->
<!--          <div class="searchByAge">-->
<!--            <select name="searchByAge" class="form-select has-shadow select-background"-->
<!--                    aria-label="Default select example">-->
<!--              <option name="searchByAge" class="select-item selected" value="--><?php //if (isset($_GET['searchByAge'])) {
//                echo $_GET['searchByAge'];
//              } else {
//                echo "allPersons";
//              } ?><!--" selected disabled>-->
<!--                --><?php //if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges") {
//                  echo "Productive Ages";
//                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway") {
//                  echo "Passed Away";
//                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler") {
//                  echo "Toddler";
//                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "elderly") {
//                  echo "Elderly";
//                } else {
//                  echo "All Persons";
//                } ?>
<!--              </option>-->
<!--              <option value="productiveAges">Productive Ages</option>-->
<!--              <option value="passedAway">Passed Away</option>-->
<!--              <option value="toddler">Toddler</option>-->
<!--              <option value="elderly">Elderly</option>-->
<!--              <option value="allPersons" class="select-items">All Persons</option>-->
<!--            </select>-->
<!--          </div>-->
<!---->
<!--          <label for="search-input"></label>-->
<!--          <input-->
<!--              id="search-input"-->
<!--              name="search"-->
<!--              class="form-control me-2 has-shadow search-person"-->
<!--              type="search"-->
<!--              placeholder="Search..."-->
<!--              aria-label="Search"-->
<!--              value="--><?php //if (isset($_GET['search'])) echo $_GET['search']; ?><!--"-->
<!--          />-->
<!--          -->
<!--          --><?php //if (isset($_GET['search']) || isset($_GET['searchByAge'])) { ?>
<!--            <a href="persons.php">-->
<!--              <button-->
<!--                  type="button"-->
<!--                  class="btn btn-outline-primary has-shadow reset-btn"-->
<!--              >-->
<!--                Reset-->
<!--              </button>-->
<!--            </a>-->
<!--          --><?php //} ?>
<!---->
<!--          <button-->
<!--              type="submit"-->
<!--              class="btn btn-outline-primary has-shadow"-->
<!--          >-->
<!--            Search-->
<!--          </button>-->
<!--        </form>-->
<!--      </div>-->
<!---->
<!--      <div class="table-responsive">-->
<!--        <table class="table-primary table-width" id="table">-->
<!--          --><?php
//          if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler" && $_GET['search'] != null):
//            $toddler = getToddlerData();
//            $persons = searchPersons($_GET['search'], $toddler);
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler"):
//            $persons = getToddlerData();
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges" && $_GET['search'] != null):
//            $productiveAges = getProductiveAgesData();
//            $persons = searchPersons($_GET['search'], $productiveAges);
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges"):
//            $persons = getProductiveAgesData();
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway" && $_GET['search'] != null):
//            $passedAway = getPassedAwayData();
//            $persons = searchPersons($_GET['search'], $passedAway);
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway"):
//            $persons = getPassedAwayData();
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "elderly" && $_GET['search'] != null):
//            $elderly = getElderlyData();
//            $persons = searchPersons($_GET['search'], $elderly);
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "elderly"):
//            $persons = getElderlyData();
//          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "allPersons"):
//            $persons = getPersonsDataFromDatabase();
//          elseif ($_GET["search"]):
//            $searchInput = $_GET["search"];
//            $persons = searchPersons($searchInput);
//          else:
//            $persons = getPersonsDataFromDatabase();
//          endif;
//          ?>
<!--          <thead>-->
<!--          <tr class="test-color">-->
<!--            <th scope="col">No</th>-->
<!--            <th scope="col">Email</th>-->
<!--            <th scope="col">Name</th>-->
<!--            <th scope="col">Role</th>-->
<!--            <th scope="col">Age</th>-->
<!--            <th scope="col">Status</th>-->
<!--            <th scope="col"></th>-->
<!--          </tr>-->
<!--          </thead>-->
<!--          <tbody>-->
<!--          --><?php
//          if (count($persons) != 0) {
//            if ($_GET['page'] < 1) {
//              $page = 1;
//            } else if (isset($_GET['page']) && !is_numeric($_GET['page'])) {
//              $page = 1;
//            } else {
//              $page = $_GET['page'];
//            }
//            $limit = 5;
//            $previous = $page - 1;
//            $next = $page + 1;
//            $data = paginatedData($persons, $page, $limit);
//            $personsData = $data[PAGING_DATA];
//            $number = ($page - 1) * $limit + 1;
//            for ($i = 0; $i < count($personsData); $i++) :
//              ?>
<!--              <tr>-->
<!--                <th scope="row">--><?php //echo $number++ ?><!--</th>-->
<!--                <td>--><?php //echo $personsData[$i]["email"] ?><!--</td>-->
<!--                <td>-->
<!--                  --><?php //echo ucwords($personsData[$i]["first_name"]) . " " . ucwords($personsData[$i]["last_name"]) ?><!--</td>-->
<!--                <td>--><?php //echo translateValue($personsData[$i]["role"],"A", "ADMIN","MEMBER"); ?><!--</td>-->
<!--                <td>--><?php //echo checkAges($personsData[$i]["birth_date"]) ?><!--</td>-->
<!--                <td>--><?php //echo translateValue($personsData[$i]["status"],1 , "Alive","Passed Away"); ?><!--</td>-->
<!--                <td>-->
<!--                  <div class="table-button">-->
<!--                    <div class="text-end">-->
<!--                      --><?php //if (checkRole($_SESSION['email']) != null && $_SESSION['email'] != $personsData[$i]["email"]) { ?>
<!--                        <a class="edit btn-table" href="edit-person.php?id=--><?php //echo $personsData[$i]["id"] ?><!--">-->
<!--                          <button type="button" class="btn btn-outline-primary" name="btn-edit">-->
<!--                            Edit-->
<!--                          </button>-->
<!--                        </a>-->
<!--                      --><?php //} else if (checkRole($_SESSION['email']) != null && $_SESSION['email'] == $personsData[$i]["email"]) { ?>
<!--                        <a class="edit btn-table" href="edit-profile.php">-->
<!--                          <button type="button" class="btn btn-outline-primary" name="btn-edit">-->
<!--                            Edit-->
<!--                          </button>-->
<!--                        </a>-->
<!--                      --><?php //} else { ?>
<!--                        <a class="edit btn-table" href="persons.php?error=2">-->
<!--                          <button type="button" class="btn btn-outline-primary" name="btn-edit">-->
<!--                            Edit-->
<!--                          </button>-->
<!--                        </a>-->
<!--                      --><?php //} ?>
<!--                      <a class="view btn-table" href="view-person.php?id=--><?php //echo $personsData[$i]["id"] ?><!--">-->
<!--                        <button type="button" class="btn btn-outline-primary" name="btn-view">-->
<!--                          View-->
<!--                        </button>-->
<!--                      </a>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </td>-->
<!--              </tr>-->
<!--            --><?php //endfor;
//          } ?>
<!--          </tbody>-->
<!--          --><?php //?>
<!--        </table>-->
<!--        -->
<!--        --><?php
//        if (count($persons) == 0) {
//          ?>
<!--          <div class="alert alert-danger" role="alert">-->
<!--            Person data was not found!!!-->
<!--          </div>-->
<!--        --><?php //} ?>
<!---->
<!--        <div class="page-position ">-->
<!--          -->
<!--          --><?php //if ($_GET["error"] == 2) : ?>
<!--            <div class="alert alert-danger" role="alert">-->
<!--              Only admin roles can edit person data!!!-->
<!--            </div>-->
<!--          --><?php //elseif (isset($_GET['success'])): ?>
<!--            <div class="alert alert-success form-padding alert-padding" role="alert">-->
<!--              <!--              Data person has been saved !!!-->-->
<!--              --><?php //echo $_SESSION['info']; ?>
<!--            </div>-->
<!--          --><?php //elseif (isset($_GET['changed'])): ?>
<!--            <div class="alert alert-success form-padding alert-padding" role="alert">-->
<!--              Person data has been changed !!!-->
<!--            </div>-->
<!--          --><?php //elseif (isset($_GET['deleted'])): ?>
<!--            <div class="alert alert-success form-padding alert-padding" role="alert">-->
<!--              --><?php //echo $_SESSION["delete"] ?>
<!--              <!--              Person data has been deleted !!!-->-->
<!--            </div>-->
<!--          --><?php //endif; ?>
<!--          <nav aria-label="Page navigation example">-->
<!--            <ul class="pagination justify-content-center">-->
<!--              --><?php
//              if (isset($_GET['search']) != null && isset($_GET['searchByAge']) != null) {
//                $filterByAge = "?search=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else {
//                $filterByAge = "?";
//              } ?>
<!--              --><?php
//
//              if ($data[PAGING_TOTAL_PAGE] >= $_GET['page'] && $page > 1 && is_numeric($_GET['page']) != null)
////              if ($page > 1)
//              { ?>
<!--                <li class="page-item">-->
<!--                  <a class="page-link" aria-label="Previous"-->
<!--                     href="--><?php //echo $filterByAge ?><!--page=--><?php //echo $previous ?><!--">-->
<!--                    <span aria-hidden="true">&laquo;</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--              --><?php //} ?>
<!--              -->
<!--              --><?php
//              for ($x = 1; $x <= $data[PAGING_TOTAL_PAGE]; $x++) {
//                ?>
<!--                <li class="page-item"><a class="page-link"-->
<!--                                         href="--><?php //echo $filterByAge ?><!--page=--><?php //echo $x ?><!--">--><?php //echo $x; ?><!--</a>-->
<!--                </li>-->
<!--              --><?php //} ?>
<!--              -->
<!--              --><?php
//              if ($page < $data[PAGING_TOTAL_PAGE]) {
//                ?>
<!--                <li class="page-item">-->
<!--                  <a class="page-link" aria-label="Next" href="--><?php //echo $filterByAge ?><!--page=--><?php //echo $next ?><!--"-->
<!--                  >-->
<!--                    <span aria-hidden="true">&raquo;</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--              --><?php //} ?>
<!--              --><?php //?>
<!--            </ul>-->
<!--          </nav>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </section>-->
<!--</main>-->
<?php
//require_once __DIR__ . "/include/footer.php";
//?>
<!---->
<!---->
<!---->
<!--//function generateId(array|null $array): int-->
<!--//{-->
<!--//  return $array == null ? 1 : (end($array['id']) + 1);-->
<!--//-->
<!--//}-->
<!--//-->
<!--//function save($person): void-->
<!--//{-->
<!--//  $persons = personsData();-->
<!--//  if ($person['id'] == null) {-->
<!--////    $id = generateId($persons);-->
<!--//    $lastPerson = $persons[count($persons) -1];-->
<!--//    $id = $lastPerson["id"] + 1;-->
<!--//    $person['id'] = $id;-->
<!--//    $persons[] = $person;-->
<!--//    saveDataIntoJson($persons);-->
<!--//  } else {-->
<!--//    for ($i = 0; $i < count($persons); $i++) {-->
<!--//      if ($persons[$i]['id'] == $person['id']) {-->
<!--//        $persons[$i]['nik'] = $person['nik'];-->
<!--//        $persons[$i]['firstName'] = $person['firstName'];-->
<!--//        $persons[$i]['lastName'] = $person['lastName'];-->
<!--//        $persons[$i]['birthDate'] = $person['birthDate'];-->
<!--//        $persons[$i]['sex'] = $person['sex'];-->
<!--//        $persons[$i]['email'] = $person['email'];-->
<!--//        $persons[$i]['password'] = $person['password'];-->
<!--//        $persons[$i]['address'] = $person['address'];-->
<!--//        $persons[$i]['role'] = $person['role'];-->
<!--//        $persons[$i]['internalNotes'] = $person['internalNotes'];-->
<!--//        $persons[$i]['loggedIn'] = $person['loggedIn'];-->
<!--//        $persons[$i]['alive'] = $person['alive'];-->
<!--//        saveDataIntoJson($persons);-->
<!--//      }-->
<!--//    }-->
<!--//  }-->
<!--//}-->
<!---->
<!--save pada saat add person action-->
<!--//  $personData = [-->
<!--//    "id" => $id,-->
<!--//    "nik" => htmlspecialchars($_POST['nik']),-->
<!--//    "firstName" =>htmlspecialchars($_POST['firstName']),-->
<!--//    "lastName" => htmlspecialchars($_POST['lastName']),-->
<!--//    "birthDate" => $birthDate,-->
<!--//    "sex" => $_POST['sex'],-->
<!--//    "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),-->
<!--//    "password" => $password,-->
<!--//    "address" => htmlspecialchars($_POST['address']),-->
<!--//    "role" => $_POST['role'],-->
<!--//    "internalNotes" => htmlspecialchars($_POST['internalNotes']),-->
<!--//    "loggedIn" => null,-->
<!--//    "alive" => $_POST['alive']-->
<!--//  ];-->
<!--//  $persons[] = $personData;-->
<!--//  saveDataIntoJson("persons.json",$persons);-->
<!--//  redirect("../persons.php", "success");-->

<!-- Function search person-->
//function search($search): array
//{
//  $persons = getPersonsDataFromJson();
//  $searchResult = [];
//  foreach ($persons as $person => $value) {
//    if (preg_match("/$search/i", $value["firstName"])) {
//      if (in_array($value["firstName"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
//    if (preg_match("/$search/i", $value["nik"])) {
//      if (in_array($value["nik"], $searchResult) == false) {
//        $searchResult[] = $value;
//      }
//    }
//  }
//  return $searchResult;
//}

<!--Function untuk menampilkan data berdasarkan halaman-->
<!--function paginatedData($array,int $page, int $limit): array-->
<!--{-->
<!--global $PDO;-->
<!--$db = "SELECT count(*) FROM persons";-->
<!--$s = $PDO->query($db);-->
<!--$total_results = $s->fetchColumn();-->
<!--$totalPage = ceil($total_results / $limit);-->
<!---->
<!--$offset = ($page - 1) * $limit;-->
<!--$query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";-->
<!--$statement = $PDO->prepare($query);-->
<!--$statement->execute();-->
<!--$dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);-->
<!--return [-->
<!--PAGING_TOTAL_PAGE => $totalPage,-->
<!--PAGING_DATA => $dbArray,-->
<!--PAGING_CURRENT_PAGE => $page,-->
<!--];-->
<!--}-->

//  if (isset($array)) {
//    for($i = 0; $i < count($array); $i++) {
//      $birthDate = $array[$i]["status"];
//      $query = "SELECT * FROM persons WHERE birth_date LIKE '%$birthDate%' LIMIT $limit OFFSET $offset";
//      $statement = $PDO->prepare($query);
//      $statement->execute();
//      $array = $statement->fetchAll(PDO::FETCH_ASSOC);
//    }
//    return [
//      PAGING_TOTAL_PAGE => $totalPage,
//      PAGING_DATA => $array,
//      PAGING_CURRENT_PAGE => $page,
//    ];
//  } else {
//    $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
//    $statement = $PDO->prepare($query);
//    $statement->execute();
//    $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
//    return [
//      PAGING_TOTAL_PAGE => $totalPage,
//      PAGING_DATA => $dbArray,
//      PAGING_CURRENT_PAGE => $page,
//    ];
//  }

//function getProductiveAgesData(): array
//{
//  $persons = getPersonsDataFromJson();
//  $productiveAges = [];
//  foreach ($persons as $person) {
//    if (checkAges($person["birthDate"]) >= 6 && checkAges($person["birthDate"]) <= 60 && $person["alive"] != null) {
//      $productiveAges[] = $person;
//    }
//  }
//  return $productiveAges;
//}

<!--$max = time() - (15 * (60 * 60 * 24 * 365));-->
<!--$min = time() - (64 * (60 * 60 * 24 * 365));-->
<!--$queryFilter = "SELECT * FROM Persons WHERE email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%'-->
<!--AND birth_date >= $min AND birth_date <= $max AND alive = :alive";-->
<!--$statementFilter = $PDO->prepare($queryFilter);-->
<!--$statementFilter->execute(array(-->
<!--'alive' => 1-->
<!--));-->
<!--$filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);-->
<!---->
<!--$query = "SELECT * FROM Persons WHERE email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%'-->
<!--AND birth_date >= $min AND birth_date <= $max AND alive = :alive LIMIT $limit OFFSET $offset";-->
<!--$statement = $PDO->prepare($query);-->
<!--$statement->execute(array(-->
<!--'alive' => 1-->
<!--));-->
<!--$pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);-->
<!--return [-->
<!--'filterData' => $filterData,-->
<!--'pagingData' => $pageFilter-->
<!--];-->

<!--$max = time() - (15 * (60 * 60 * 24 * 365));-->
<!--$min = time() - (64 * (60 * 60 * 24 * 365));-->
<!--$nik = $person["nik"];-->
<!--$query = "SELECT * FROM persons WHERE nik LIKE '%$nik%' AND birth_date >= $min AND birth_date <= $max AND alive = :1";-->
<!--$statement = $PDO->prepare($query);-->
<!--$statement->execute();-->
<!--return $statement->fetchAll(PDO::FETCH_ASSOC);-->


//function paginatedData($array, int $page, int $limit): array
//{
//  global $PDO;
//  $db = "SELECT count(*) FROM persons";
//  $s = $PDO->query($db);
//  $total_results = $s->fetchColumn();
//  $totalPage = ceil($total_results / $limit);
//  $offset = ($page - 1) * $limit;
//  $query = "SELECT * FROM persons LIMIT $limit OFFSET $offset";
//  $statement = $PDO->prepare($query);
//  $statement->execute();
//  $dbArray = $statement->fetchAll(PDO::FETCH_ASSOC);
//  return [
//    PAGING_TOTAL_PAGE => $totalPage,
//    PAGING_DATA => $dbArray,
//    PAGING_CURRENT_PAGE => $page,
//  ];
//}


<!--$max = time() - (6 * (60 * 60 * 24 * 365));-->
<!--$min = time() - (60 * (60 * 60 * 24 * 365));-->
<!--$totalPage = ceil((float)count($array) / (float)$limit);-->
<!--$offset = ($page - 1) * $limit;-->
<!--$query = "SELECT * FROM persons WHERE birth_date >= $min AND birth_date <= $max AND alive = :1 LIMIT $limit OFFSET $offset";-->
<!--$statement = $PDO->prepare($query);-->
<!--$statement->execute();-->
<!--$persons = $statement->fetchAll(PDO::FETCH_ASSOC);-->
<!--var_dump($persons);-->
<!--return [-->
<!--PAGING_TOTAL_PAGE => $totalPage,-->
<!--PAGING_DATA => $persons,-->
<!--PAGING_CURRENT_PAGE => $page,-->
<!--];-->


<!--              <table class="table">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                  <th scope="col">#</th>-->
<!--                  <th scope="col">First</th>-->
<!--                  <th scope="col">Last</th>-->
<!--                  <th scope="col">Handle</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr>-->
<!--                  <th scope="row">1</th>-->
<!--                  <td>Mark</td>-->
<!--                  <td>Otto</td>-->
<!--                  <td>@mdo</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                  <th scope="row">2</th>-->
<!--                  <td>Jacob</td>-->
<!--                  <td>Thornton</td>-->
<!--                  <td>@fat</td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                  <th scope="row">3</th>-->
<!--                  <td colspan="2">Larry the Bird</td>-->
<!--                  <td>@twitter</td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--              </table>-->

<!--            <ion-icon name="clipboard"></ion-icon>-->

