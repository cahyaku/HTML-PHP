<?php
session_start();
require_once __DIR__ . "/action/utils-action.php";
redirectWhenNotLoggedIn($_SESSION['email']);
require_once __DIR__ . "/action/persons-action.php";
require_once __DIR__ . "/include/db.php";
global $PDO;
?>

<?php
require_once __DIR__ . "/include/header.php";
showHeader("Persons-PMA", "persons.css", personsNav: "persons-nav-link");
?>
<main>
  <section class="section-persons d-flex">
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(personsNav: "persons-nav-link");
    ?>
    <!-- MAIN CONTENT -->
    <div class="main-content-persons">
      <div class="persons-box d-flex justify-content-between">
        <div class="person-header">
          <h3 class="box-title">Persons</h3>
        </div>

        <div class="add-button">
          <button type="button" class="btn btn-outline-primary btn-add">
            <?php
            if (checkRole($_SESSION['email']) != null) {
              ?>
              <a class="add" href="add-person.php">
                +Add
              </a>
            <?php } else { ?>
              <a class="add" href="persons.php?error=1">
                +Add
              </a>
            <?php } ?>
          </button>
        </div>
      </div>
      <?php if ($_GET["error"] == 1) : ?>
        <div class="alert alert-danger" role="alert">
          Only admin roles can add new person data!!!
        </div>
      <?php endif; ?>
      <div class="search-box">
        <form class="form d-flex" name="search-form" role="search" method="get" action="#table">
          <div class="searchByAge">
            <select name="searchByAge" class="form-select has-shadow select-background"
                    aria-label="Default select example">
              <option name="searchByAge" class="select-item selected" value="<?php if (isset($_GET['searchByAge'])) {
                echo $_GET['searchByAge'];
              } else {
                echo "allPersons";
              } ?>" selected disabled>
                <?php if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges") {
                  echo "Productive Ages";
                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway") {
                  echo "Passed Away";
                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler") {
                  echo "Toddler";
                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "elderly") {
                  echo "Elderly";
                } else {
                  echo "All Persons";
                } ?>
              </option>
              <option value="productiveAges">Productive Ages</option>
              <option value="passedAway">Passed Away</option>
              <option value="toddler">Toddler</option>
              <option value="elderly">Elderly</option>
              <option value="allPersons" class="select-items">All Persons</option>
            </select>
          </div>

          <label for="search-input"></label>
          <input
              id="search-input"
              name="search"
              class="form-control me-2 has-shadow search-person"
              type="search"
              placeholder="Search..."
              aria-label="Search"
              value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>"
          />
          
          <?php if (isset($_GET['search']) || isset($_GET['searchByAge'])) { ?>
            <a href="persons.php">
              <button
                  type="button"
                  class="btn btn-outline-primary has-shadow reset-btn"
              >
                Reset
              </button>
            </a>
          <?php } ?>

          <button
              type="submit"
              class="btn btn-outline-primary has-shadow"
          >
            Search
          </button>
        </form>
      </div>

      <div class="table-responsive">
        <table class="table-primary table-width" id="table">
          <?php
          if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler" && $_GET['search'] != null):
            $toddler = getToddlerData();
            $persons = searchPersons($_GET['search'], $toddler);
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "toddler"):
            $persons = getToddlerData();
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges" && $_GET['search'] != null):
            $productiveAges = getProductiveAgesData();
            $persons = searchPersons($_GET['search'], $productiveAges);
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "productiveAges"):
            $persons = getProductiveAgesData();
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway" && $_GET['search'] != null):
            $passedAway = getPassedAwayData();
            $persons = searchPersons($_GET['search'], $passedAway);
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "passedAway"):
            $persons = getPassedAwayData();
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "elderly" && $_GET['search'] != null):
            $elderly = getElderlyData();
            $persons = searchPersons($_GET['search'], $elderly);
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "elderly"):
            $persons = getElderlyData();
          elseif (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "allPersons"):
            $persons = getPersonsDataFromJson();
          elseif ($_GET["search"]):
            $searchInput = $_GET["search"];
            $persons = searchPersons($searchInput);
          else:
            $persons = getPersonsDataFromDatabase($PDO);
//            $persons = getPersonsDataFromJson();
          endif;
          ?>
          <thead>
          <tr class="test-color">
            <th scope="col">No</th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Age</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
          <?php
          if (count($persons) != 0) {
            if ($_GET['page'] < 1) {
              $page = 1;
            } else if (isset($_GET['page']) && !is_numeric($_GET['page'])) {
              $page = 1;
            } else {
              $page = $_GET['page'];
            }
            $limit = 5;
            $previous = $page - 1;
            $next = $page + 1;
            $data = paginatedData($persons, $page, $limit);
            $personsData = $data[PAGING_DATA];
            $number = ($page - 1) * $limit + 1;
            for ($i = 0; $i < count($personsData); $i++) :
              ?>
              <tr>
                <th scope="row"><?php echo $number++ ?></th>
                <td><?php echo $personsData[$i]["email"] ?></td>
                <td>
                  <?php echo ucwords($personsData[$i]["first_name"]) . " " . ucwords($personsData[$i]["last_name"]) ?></td>
                <td><?php echo $personsData[$i]["role"] ?></td>
                <td><?php echo checkAges($personsData[$i]["birth_date"]) ?></td>
                <td><?php
                  if ($personsData[$i]["status"] == 1) {
                    echo "Alive";
                  } else {
                    echo "Passed away";
                  }
                  ?></td>
                <td>
                  <div class="table-button">
                    <div class="text-end">
                      <?php if (checkRole($_SESSION['email']) != null && $_SESSION['email'] != $personsData[$i]["email"]) { ?>
                        <a class="edit btn-table" href="edit-person.php?id=<?php echo $personsData[$i]["id"] ?>">
                          <button type="button" class="btn btn-outline-primary" name="btn-edit">
                            Edit
                          </button>
                        </a>
                      <?php } else if (checkRole($_SESSION['email']) != null && $_SESSION['email'] == $personsData[$i]["email"]) { ?>
                        <a class="edit btn-table" href="edit-profile.php">
                          <button type="button" class="btn btn-outline-primary" name="btn-edit">
                            Edit
                          </button>
                        </a>
                      <?php } else { ?>
                        <a class="edit btn-table" href="persons.php?error=2">
                          <button type="button" class="btn btn-outline-primary" name="btn-edit">
                            Edit
                          </button>
                        </a>
                      <?php } ?>
                      <a class="view btn-table" href="view-person.php?id=<?php echo $personsData[$i]["id"] ?>">
                        <button type="button" class="btn btn-outline-primary" name="btn-view">
                          View
                        </button>
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endfor;
          } ?>
          </tbody>
          <?php ?>
        </table>
        
        <?php
        if (count($persons) == 0) {
          ?>
          <div class="alert alert-danger" role="alert">
            Person data was not found!!!
          </div>
        <?php } ?>

        <div class="page-position ">
          
          <?php if ($_GET["error"] == 2) : ?>
            <div class="alert alert-danger" role="alert">
              Only admin roles can edit person data!!!
            </div>
          <?php elseif (isset($_GET['success'])): ?>
            <div class="alert alert-success form-padding alert-padding" role="alert">
<!--              Data person has been saved !!!-->
              <?php echo $_SESSION['info']; ?>
            </div>
          <?php elseif (isset($_GET['changed'])): ?>
            <div class="alert alert-success form-padding alert-padding" role="alert">
              Person data has been changed !!!
            </div>
          <?php elseif (isset($_GET['deleted'])): ?>
            <div class="alert alert-success form-padding alert-padding" role="alert">
              Person data has been deleted !!!
            </div>
          <?php endif; ?>
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <?php
              if (isset($_GET['search']) != null && isset($_GET['searchByAge']) != null) {
                $filterByAge = "?search=" . $_GET['search'] . "&searchByAge=" . $_GET['searchByAge'] . "&";
              } else {
                $filterByAge = "?";
              } ?>
              <?php if ($page > 1) { ?>
                <li class="page-item">
                  <a class="page-link" aria-label="Previous"
                     href="<?php echo $filterByAge ?>page=<?php echo $previous ?>">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php } ?>
              <?php
              for ($x = 1; $x <= $data[PAGING_TOTAL_PAGE]; $x++) {
                ?>
                <li class="page-item"><a class="page-link"
                                         href="<?php echo $filterByAge ?>page=<?php echo $x ?>"><?php echo $x; ?></a>
                </li>
              <?php } ?>
              <?php
              if ($page < $data[PAGING_TOTAL_PAGE]) {
                ?>
                <li class="page-item">
                  <a class="page-link" aria-label="Next" href="<?php echo $filterByAge ?>page=<?php echo $next ?>"
                  >
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php } ?>
              <?php ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
