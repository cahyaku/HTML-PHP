<?php
session_start();
require_once __DIR__ . "/action/utils-action.php";
redirectWhenNotLoggedIn($_SESSION['email']);
require_once __DIR__ . "/action/persons-action.php";
require_once __DIR__ . "/include/db.php";
require_once __DIR__ . "/action/constants.php";
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
                } else if (isset($_GET['searchByAge']) && $_GET['searchByAge'] == "child") {
                  echo "Child";
                } else {
                  echo "All Persons";
                } ?>
              </option>
              <option value="productiveAges">Productive Ages</option>
              <option value="passedAway">Passed Away</option>
              <option value="toddler">Toddler</option>
              <option value="elderly">Elderly</option>
              <option value="child">Child</option>
              <option value="allPersons" class="select-items">All Persons</option>
            </select>
          </div>

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
          $searchByAge = $_GET['search'] ?? null;
          $filterData = validateSearchByAge($_GET['searchByAge']) ?? null;
          ?>
          <thead>
          <tr class="test-color">
            <th scope="col" class="text-center">No</th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col" class="text-center">Age</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
          <?php
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
            $data = paginatedPersonsData($_GET["search"], $page, $limit, $filterData,$searchByAge);
            if ($_GET["page"] > $data[PAGING_TOTAL_PAGE]){
              $page = 1;
              $data = paginatedPersonsData($_GET["search"], $page, $limit, $filterData,$searchByAge);
            }
            $personsData = $data[PAGING_DATA];
            $number = ($page - 1) * $limit + 1;
            for ($i = 0; $i < count($personsData); $i++) :
              ?>
              <tr>
                <th scope="row" class="text-center"><?php echo $number++ ?></th>
                <td><?php echo $personsData[$i]["email"] ?></td>
                <td>
                  <?php echo ucwords($personsData[$i]["first_name"]) . " " . ucwords($personsData[$i]["last_name"]) ?></td>
                <td><?php echo translateValue($personsData[$i]["role"], "A", "ADMIN", "MEMBER"); ?></td>
                <td class="text-center"><?php echo checkAges($personsData[$i]["birth_date"]) ?></td>
                <td class="text-center"><?php echo translateValue($personsData[$i]["status"], 1, "Alive", "Passed Away"); ?></td>
                <td>
                  <div class="table-button">
                    <div class="text-end">
                      <?php if (checkRole($_SESSION['email']) != null && $_SESSION['email'] != $personsData[$i]["email"]) { ?>
                        <a class="edit btn-table" href="edit-person.php?id=<?php echo $personsData[$i]["id"] ?>">
                          <button type="button" class="btn btn-outline-primary" name="btn-edit">
                            Edit
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                              <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                            </svg>
                          </button>
                        </a>
                      <?php } else if (checkRole($_SESSION['email']) != null && $_SESSION['email'] == $personsData[$i]["email"]) { ?>
                        <a class="edit btn-table" href="edit-profile.php">
                          <button type="button" class="btn btn-outline-primary" name="btn-edit">
                            Edit
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                              <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                            </svg>
                          </button>
                        </a>
                      <?php } else { ?>
                        <a class="edit btn-table" href="persons.php?error=2">
                          <button type="button" class="btn btn-outline-primary" name="btn-edit">
                            Edit
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                              <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                            </svg>
                          </button>
                        </a>
                      <?php } ?>
                      <a class="view btn-table" href="view-person.php?id=<?php echo $personsData[$i]["id"] ?>">
                        <button type="button" class="btn btn-outline-primary btn-view" name="btn-view">
                          View
                        </button>
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endfor;
          ?>
          </tbody>
          <?php ?>
        </table>
        <?php
        if (count($data[PAGING_DATA]) == null) {
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
              <?php echo $_SESSION['info']; ?>
            </div>
          <?php elseif (isset($_GET['changed'])): ?>
            <div class="alert alert-success form-padding alert-padding" role="alert">
              <?php echo $_SESSION["changed"] ?>
            </div>
          <?php elseif (isset($_GET['deleted'])): ?>
            <div class="alert alert-success form-padding alert-padding" role="alert">
              <?php echo $_SESSION["delete"] ?>
            </div>
          <?php elseif (isset($_GET['hobby'])): ?>
            <div class="alert alert-success form-padding alert-padding" role="alert">
              <?php echo $_SESSION["hobby"] ?>
            </div>
          <?php elseif (isset($_GET['deleted-hobby'])): ?>
            <div class="alert alert-success" role="alert">
              Data hobby has been deleted.
            </div>
          <?php elseif (isset($_GET['changed-hobby'])): ?>
            <div class="alert alert-success" role="alert">
              Data hobby has been update.
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
              <?php
              if ($data[PAGING_TOTAL_PAGE] >= $_GET['page'] && $page > 1 && is_numeric($_GET['page']) != null) { ?>
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
