
<!--          <tr>-->
                <!--            <th scope="row">1</th>-->
                <!--            <td>cahya@gmail.com</td>-->
                <!--            <td>Cahya</td>-->
                <!--            <td>ADMIN</td>-->
                <!--            <td>-->
                <!--              <div class="table-button">-->
                <!--                <div class="text-end">-->
                <!--                  <a class="edit btn-table" href="edit-person.php">-->
                <!--                    <button type="button" class="btn btn-outline-primary">-->
                <!--                      Edit-->
                <!--                    </button>-->
                <!--                  </a>-->
                <!---->
                <!--                  <a class="view btn-table" href="view-person.php">-->
                <!--                    <button type="button" class="btn btn-outline-primary">-->
                <!--                      View-->
                <!--                    </button>-->
                <!--                  </a>-->
                <!--                </div>-->
                <!--              </div>-->
                <!--            </td>-->
                <!--          </tr>-->
                <!--          <tr>-->
                <!--                      <th scope="row">2</th>-->
                <!--                      <td>Kumala@a.com</td>-->
                <!--                      <td>Kumala</td>-->
                <!--                      <td>MEMBER</td>-->
                <!--                      <td>-->
                <!--                        <div class="table-button">-->
                <!--                          <div class="text-end">-->
                <!--                            <a class="edit btn-table" href="edit-person.php">-->
                <!--                              <button type="button" class="btn btn-outline-primary">-->
                <!--                                Edit-->
                <!--                              </button>-->
                <!--                            </a>-->
                <!--                            <a class="view btn-table" href="view-person.php">-->
                <!--                              <button type="button" class="btn btn-outline-primary">-->
                <!--                                View-->
                <!--                              </button>-->
                <!--                            </a>-->
                <!--                          </div>-->
                <!--                        </div>-->
                <!--                      </td>-->
                <!--                    </tr>-->
                <!--                    <tr>-->
                <!--                      <th scope="row">3</th>-->
                <!--                      <td>Ayong@gmail.com</td>-->
                <!--                      <td>Ayong</td>-->
                <!--                      <td>ADMIN</td>-->
                <!--                      <td>-->
                <!--                        <div class="table-button">-->
                <!--                          <div class="text-end">-->
                <!--                            <a class="edit btn-table" href="edit-person.php">-->
                <!--                              <button type="button" class="btn btn-outline-primary">-->
                <!--                                Edit-->
                <!--                              </button>-->
                <!--                            </a>-->
                <!--          -->
                <!--                            <a class="view btn-table" href="view-person.php">-->
                <!--                              <button type="button" class="btn btn-outline-primary">-->
                <!--                                View-->
                <!--                              </button>-->
                <!--                            </a>-->
                <!--                          </div>-->
                <!--                        </div>-->
                <!--                      </td>-->
                <!--                    </tr>-->
                <!--                    <tr>-->
                <!--                      <th scope="row">4</th>-->
                <!--                      <td>Nilam@gmail.com</td>-->
                <!--                      <td>Nilam</td>-->
                <!--                      <td>MEMBER</td>-->
                <!--                      <td>-->
                <!--                        <div class="table-button">-->
                <!--                          <div class="text-end">-->
                <!--                            <button type="button" class="btn btn-outline-primary">-->
                <!--                              Edit-->
                <!--                            </button>-->
                <!--                            <button type="button" class="btn btn-outline-primary">-->
                <!--                              View-->
                <!--                            </button>-->
                <!--                          </div>-->
                <!--                        </div>-->
                <!--                      </td>-->
                <!--                    </tr>-->
                <!--                    <tr>-->
                <!--                      <th scope="row">5</th>-->
                <!--                      <td>Shifa@gmail.com</td>-->
                <!--                      <td>Shifa</td>-->
                <!--                      <td>ADMIN</td>-->
                <!--                      <td>-->
                <!--                        <div class="table-button">-->
                <!--                          <div class="text-end">-->
                <!--                            <a class="edit btn-table" href="edit-person.php">-->
                <!--                              <button type="button" class="btn btn-outline-primary">-->
                <!--                                Edit-->
                <!--                              </button>-->
                <!--                            </a>-->
                <!--          -->
                <!--                            <a class="view btn-table" href="view-person.php">-->
                <!--                              <button type="button" class="btn btn-outline-primary">-->
                <!--                                View-->
                <!--                              </button>-->
                <!--                            </a>-->
                <!--                          </div>-->
                <!--                        </div>-->
                <!--                      </td>-->
                <!--                    </tr>-->


<!-- PAGINATION FOR PERSON TABLE -->
//          $limit = 3;
//          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
//          $start_page = ($page > 1) ? ($page * $limit) - $limit : 0;
//          $previous = $page - 1;
//          $next = $page + 1;
//          $data = personData();
//
//          $total_page = ceil(count($data) / $limit);
//          $number = $start_page + 1;

<!---->
<!--              <li class="page-item"><a class="page-link" href="#">1</a></li>-->
<!--              <li class="page-item"><a class="page-link" href="#">2</a></li>-->
<!--              <li class="page-item"><a class="page-link" href="#">3</a></li>-->
<!--              <li class="page-item">-->
<!--                <a class="page-link" href="#" aria-label="Next">-->
<!--                  <span aria-hidden="true">&raquo;</span>-->
<!--                </a>-->
<!--              </li>-->



<!--TABLE FOR SEARCH INPUT-->
<!--          --><?php
//          if (isset($_GET["search"])) {
//            ?>
<!--            <thead>-->
<!--            <tr class="test-color">-->
<!--              <th scope="col">No</th>-->
<!--              <th scope="col">Email</th>-->
<!--              <th scope="col">Name</th>-->
<!--              <th scope="col">Role</th>-->
<!--              <th scope="col"></th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            --><?php
//            //          if (isset($_GET["search"])) {
//            $searchInput = $_GET["search"];
//            $persons = search($searchInput);
//            if (count($persons) == 0) {
//              echo "data was not found!";
//            } else {
//              $limit = 3;
//              $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
//              //              $start_page = ($page > 1) ? ($page * $limit) - $limit : 0;
//              $previous = $page - 1;
//              $next = $page + 1;
////              $persons = personData();
//              $data = paginatedData($persons, $page, $limit);
//              $personsData = $data[PAGING_DATA];
//              //              $number = $page + 1;
//              $number = ($page - 1) * $limit + 1;
//              for ($i = 0; $i < count($personsData); $i++) :
//                ?>
<!--                <tr>-->
<!--                  <th scope="row">--><?php //echo $i + 1 ?><!--</th>-->
<!--                  <td>--><?php //echo $personsData[$i]["email"] ?><!--</td>-->
<!--                  <td>-->
<!--                    --><?php //echo $personsData[$i]["firstName"] . " " . $personsData[$i]["lastName"] ?><!--</td>-->
<!--                  <td>--><?php //echo $personsData[$i]["role"] ?><!--</td>-->
<!--                  <td>-->
<!--                    <div class="table-button">-->
<!--                      <div class="text-end">-->
<!--                        <a class="edit btn-table" href="edit-person.php">-->
<!--                          <button type="button" class="btn btn-outline-primary">-->
<!--                            Edit-->
<!--                          </button>-->
<!--                        </a>-->
<!--                        <a class="view btn-table" href="view-person.php">-->
<!--                          <button type="button" class="btn btn-outline-primary">-->
<!--                            View-->
<!--                          </button>-->
<!--                        </a>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </td>-->
<!--                </tr>-->
<!--              --><?php //endfor;
////            }
//            }
//            ?>
<!--            </tbody>-->
<!--            --><?php
//          } else {
//            ?>
<!--            <!--TABLE FOR SHOW ALL PERSON DATA-->-->
<!--            <thead>-->
<!--            <tr class="test-color">-->
<!--              <th scope="col">No</th>-->
<!--              <th scope="col">Email</th>-->
<!--              <th scope="col">Name</th>-->
<!--              <th scope="col">Role</th>-->
<!--              <th scope="col"></th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            --><?php
//            //          if (isset($_GET["search"])) {
//            //            $searchInput = $_GET["search"];
//            //            $persons = search($searchInput);
//            //            if (count($persons) == 0) {
//            //              echo "data was not found!";
//            //            } else {
//            $limit = 3;
//            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
//            //              $start_page = ($page > 1) ? ($page * $limit) - $limit : 0;
//            $previous = $page - 1;
//            $next = $page + 1;
//            $persons = personData();
//            $data = paginatedData($persons, $page, $limit);
//            $personsData = $data[PAGING_DATA];
//            //              $number = $page + 1;
//            $number = ($page - 1) * $limit + 1;
//            for ($i = 0; $i < count($personsData); $i++) :
//              ?>
<!--              <tr>-->
<!--                <th scope="row">--><?php //echo $number++ ?><!--</th>-->
<!--                <td>--><?php //echo $personsData[$i]["email"] ?><!--</td>-->
<!--                <td>-->
<!--                  --><?php //echo $personsData[$i]["firstName"] . " " . $personsData[$i]["lastName"] ?><!--</td>-->
<!--                <td>--><?php //echo $personsData[$i]["role"] ?><!--</td>-->
<!--                <td>-->
<!--                  <div class="table-button">-->
<!--                    <div class="text-end">-->
<!--                      <a class="edit btn-table" href="edit-person.php">-->
<!--                        <button type="button" class="btn btn-outline-primary">-->
<!--                          Edit-->
<!--                        </button>-->
<!--                      </a>-->
<!--                      <a class="view btn-table" href="view-person.php">-->
<!--                        <button type="button" class="btn btn-outline-primary">-->
<!--                          View-->
<!--                        </button>-->
<!--                      </a>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </td>-->
<!--              </tr>-->
<!--            --><?php //endfor;
//            //            }
//            //          }
//            ?>
<!--            </tbody>-->
<!--            --><?php
//          }
//          ?>


<!--TABLE FOR SEARCH BY AGE-->
<!--          --><?php
//          if (isset($_GET['toddler'])) {
//            $persons = toddler();
//          } else if (isset($_GET['productiveAges'])) {
//            $persons = productiveAges();
//          } else if (isset($_GET['passedAway'])) {
//            $persons = passedAway();
//          } else if (isset($_GET['toddler']) . isset($_GET['search']) == 1) {
//            $filterToddler = toddler();
//            $persons = searchByAges($_GET["search"], $filterToddler);
//          } else if (isset($_GET['productiveAges']) . isset($_GET['search']) == 1) {
//            $filterProductive = productiveAges();
//            $persons = searchByProductive($_GET["search"]);
//          } else if (isset($_GET['passedAway']) . isset($_GET['search']) == 1) {
//            $filterPassedAway = passedAway();
//            $persons = searchByAges($_GET["search"], $filterPassedAway);
//          } else if (isset($_GET["search"]) ==1) {
//            $searchInput = $_GET["search"];
//            $persons = search($searchInput);
//          } else {
//            $persons = personData();
//          }
//          ?>

<!--if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler" && $_GET['search'] != null) {-->
<!--$filterByAge = "?searchByAge=" . $_GET['searchByAge'] . "&" . "search=" . $_GET['search'] . "&";-->
<!--} else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler") {-->
<!--$filterByAge = "?toddler=" . $_GET['searchByAge'] . "&search=" . "&";-->
<!--} else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges" && $_GET['search'] != null) {-->
<!--$filterByAge = "?searchByAge=" . $_GET['searchByAge'] . "&search=" . $_GET['search'] . "&";-->
<!--} else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges") {-->
<!--$filterByAge = "?productiveAge=" . $_GET['searchByAge'] . "&search=" . "&";-->
<!--} else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway" && $_GET['search'] != null) {-->
<!--$filterByAge = "?searchByAge=" . $_GET['searchByAge'] . "&search=" . $_GET['search'] . "&";-->
<!--} else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway") {-->
<!--$filterByAge = "?passedAway=" . $_GET['searchByAge'] . "&search=" . "&";-->
<!--} else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "allPersons") {-->
<!--$filterByAge = "?allPersons=" . $_GET['searchByAge'] . "&search=" . "&";-->
<!--} else if ($_GET["search"]) {-->
<!--$filterByAge = "?search=" . $_GET['search'] . "&";-->
<!--} else {-->
<!--$filterByAge = "?";-->
<!--}-->
<!--?>-->

<?php
//if (isset($_GET['search']) != null && isset($_GET['filter']) != null){
//  $url = "?search=" . $_GET['search'] . "&filter=" . $_GET['filter'] . "&";
//
//
//} else {
//  $url = "?";
//} ?>

<?php
//              if (isset($_GET["toddler"])) {
//                $searchByAges = "?toddler&";
//              } else if (isset ($_GET["passedAway"])) {
//                $searchByAges = "?passedAway&";
//              } else if (isset ($_GET["productiveAges"])) {
//                $searchByAges = "?productiveAges&";
//              } else if (isset($_GET["search"])) {
//                $searchByAges = "?search=" . $_GET["search"] . "&";
//              } else {
//                $searchByAges = "?";
//              }
//              if (isset($_GET['search']) != null && isset($_GET['searchByAge']) != null) {
//                $filterByAges = "?search=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset ($_GET['searchByAge']) == ['toddler'] && isset($_GET_['search'])) {
//                $filterByAges = "?toddler" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset ($_GET['searchByAge']) == ['toddler'] && isset($_GET_['search'])) {
//                $filterByAge = "?productiveAges" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else {
//                $filterByAges = "?";
//              }

//              if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler" && $_GET['search'] != null) {
//                $filterByAge = "?toddler=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler") {
//                $filterByAge = "?toddler=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges" && $_GET['search'] != null) {
//                $filterByAge = "?productiveAges=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges") {
//                $filterByAge = "?productiveAges=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway" && $_GET['search'] != null) {
//                $filterByAge = "?passedAway=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway") {
//                $filterByAge = "?passedAway=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "allPersons") {
//                $filterByAge = "?passedAway=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
//              } else if ($_GET["search"]) {
//                $filterByAge = "?search=" . $_GET['search'] . "&";
//              } else {
//                $filterByAge = "?";
//              }
//              ?>

<!--1702537446-->

//$persons = personsData();
//$id = count($persons) + 1;
//$birthDate = translateDateFromStringToInt($_POST['birthDate']);
//$personData = [
//  "id" => $id,
//  "nik" => $_POST['nik'],
//  "firstName" => $_POST['firstName'],
//  "lastName" => $_POST['lastName'],
//  "birthDate" => $birthDate,
//  "sex" => $_POST['sex'],
//  "email" => $_POST['email'],
//  "password" => $_POST['password'],
//  "address" => $_POST['address'],
//  "role" => $_POST['role'],
//  "internalNotes" => "internalNotes",
//  "loggedIn" => null
//];
//$persons[] = $personData;
//saveDataIntoJson($persons);
//redirect("../persons.php", null);
////  print_r($persons);
////    exit();
//


//$errorData = editValidate($_POST['nik'], $_POST['password'], $_POST['email'], $_SESSION['personId']);
//
//if (count($errorData) != 0){
//  $_SESSION['nikError'] = $errorData['nik'];
//  $_SESSION['emailError'] = $errorData['email'];
//  $_SESSION['passwordError'] = $errorData['password'];
//
//  var_dump($_SESSION);
//
//  header("Location: ../edit.php?salah");
//  exit();
//}else{
//  $saved = saveUpdateData($_SESSION['personId']);
//  if($saved) {
//    redirect("../edit.php", "saved=1");
//  }
//}