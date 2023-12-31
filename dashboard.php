<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit(); // Terminate script execution after the redirect
}

require_once __DIR__ . "/action/persons-action.php";
require_once __DIR__ . "/action/common-action.php";
require_once __DIR__ . "/action/dashboard-action.php";
require_once __DIR__ . "/include/header.php";
?>

<?php
//showHeader("Dashboard-PMA","dashboard.css","general.css","queries.css",dashboardNav: "dashboard-link" );
//?>

<?php
showHeader("Dashboard-PMA", "dashboard.css", dashboardNav: "dashboard-link");
?>
<main>
  <section class="section-dashboard d-flex">
    
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(dashboardNav: "dashboard-link");
    ?>
    <!-- MAIN CONTENT -->
    <div class="main-content-dashboard d-flex flex-column">
      <div class="dashboard-content">
        <div class="dashboard-header">
          <!--              <h3 class="dashboard-title">Hi, Cahya Kumala...</h3>-->
          <!--                              --><?php //if (isset($_GET["name"]) == 1):
          //                                  echo "<h3 class='dashboard-title'>";
          //                                  echo "Hi, " . $_GET["name"] . "...";
          //                                  echo "</h3>";
          //                              else :
          //                                  echo "<h3 class='dashboard-title'>";
          //                                  echo "Selamat datang di halaman dashboard!!!";
          //                                  echo "</h3>"; ?>
          <!--                              --><?php //endif; ?>
          <?php
          echo "<h3 class='dashboard-title'>";
          echo "Hi, " . $_SESSION['userFirstName'] . " " . $_SESSION['userLastName'] . "...";
          echo "</h3>";
          ?>
          <p class="dashboard-text">
            <?php if ($_SESSION['userLoggedIn'] != null) { ?>
              You were logged previously in
            <?php } ?>
            <strong><?php echo customDateToString($_SESSION['userLoggedIn']) . "!" ?></strong>
          </p>
        </div>
      </div>

      <div class="dashboard-boxs">
        <div class="row row-gap-4">

          <!--ALL PERSONS-->
          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="people" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $allPersons = count(personsData());
                  echo "<h2 class='title'>";
                  echo "$allPersons";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">All Persons</p>
                <p class="card-text-box">
                  Some quick example text to build on the card title and
                  make up the bulk of the card's content.
                </p>
                <a href="persons.php?searchByAge=allPersons&search=">
                  <button class="more-info">More info &rAarr;</button>
                </a>
              </div>
            </div>
          </div>

          <!--          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">-->
          <!--            <div class="card has-shadow">-->
          <!--              <div class="card-body card-box card-1">-->
          <!--                <div class="d-flex align-items-center card-title-box">-->
          <!--                  <div>-->
          <!--                    <ion-icon name="people-circle-outline" class="dashboard-icon"></ion-icon>-->
          <!--                  </div>-->
          <!--                  --><?php
          //                  $allPersons = count(personsData());
          //                  echo "<h2 class='title'>";
          //                  echo "$allPersons";
          //                  echo "</h2>";
          //                  ?>
          <!--                </div>-->
          <!---->
          <!--                <p class="card-text">Number of persons</p>-->
          <!--                <p class="card-text-box">-->
          <!--                  Some quick example text to build on the card title and-->
          <!--                  make up the bulk of the card's content.-->
          <!--                </p>-->
          <!--                <a href="persons.php">-->
          <!--                  <button class="more-info">More info &rAarr;</button>-->
          <!--                </a>-->
          <!--              </div>-->
          <!--            </div>-->
          <!--          </div>-->

          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="happy" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $toddler = count(toddler());
                  echo "<h2 class='title'>";
                  echo "$toddler";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">toddler</p>
                <p class="card-text-box">
                  Some quick example text to build on the card title and
                  make up the bulk of the card's content.
                </p>
                <a href="persons.php?searchByAge=toddler&search=">
                  <button class="more-info">More info &rAarr;</button>
                </a>
              </div>
            </div>
          </div>

          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box card-2">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="accessibility" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $productiveAges = count(productiveAges());
                  echo "<h2 class='title'>";
                  echo "$productiveAges";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">in Productive Ages</p>
                <p class="card-text-box">
                  Some quick example text to build on the card title and
                  make up the bulk of the card's content.
                </p>
                <a href="persons.php?searchByAge=productiveAges&search=">
                  <button class="more-info">More info &rAarr;</button>
                </a>
              </div>
            </div>
          </div>

          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box card-3">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="man" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $passedAway = count(passedAway());
                  echo "<h2 class='title'>";
                  echo "$passedAway";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">passed away</p>
                <p class="card-text-box">
                  Some quick example text to build on the card title and
                  make up the bulk of the card's content.
                </p>
                <a href="persons.php?searchByAge=passedAway&search=">
                  <button class="more-info">More info &rAarr;</button>
                </a>
              </div>
            </div>
          </div>

          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="people" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $elderly = count(elderly());
                  echo "<h2 class='title'>";
                  echo "$elderly";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">elderly</p>
                <p class="card-text-box">
                  Some quick example text to build on the card title and
                  make up the bulk of the card's content.
                </p>
                <a href="persons.php?searchByAge=elderly&search=">
                  <button class="more-info">More info &rAarr;</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
