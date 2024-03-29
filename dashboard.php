<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit(); // Terminate script execution after the redirect
}

require_once __DIR__ . "/action/persons-action.php";
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/action/dashboard-action.php";
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/action/jobs-action.php";
?>

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
          <?php
          echo "<h3 class='dashboard-title'>";
          echo "Hi, " . $_SESSION['userFirstName'] . " " . $_SESSION['userLastName'] . "...";
          echo "</h3>";
          ?>
          <p class="dashboard-text">
            <?php if ($_SESSION['userLoggedIn'] != null) { ?>
              You were logged previously in
            <?php } ?>
            <strong><?php
              if ($_SESSION['userLoggedIn'] == null):
                echo "Welcome in dashboard page!";
              else:
                echo $_SESSION['userLoggedIn'] . "!";
              endif;
              ?></strong>
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
                  $allPersons = getCountPersonDataByAges("allPersons");
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
          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="happy" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $toddler = getCountPersonDataByAges("toddler");
                  echo "<h2 class='title'>";
                  echo "$toddler";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">Toddler</p>
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
              <div class="card-body card-box">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="happy" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $child = getCountPersonDataByAges("child");
                  echo "<h2 class='title'>";
                  echo "$child";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">Child</p>
                <p class="card-text-box">
                  Some quick example text to build on the card title and
                  make up the bulk of the card's content.
                </p>
                <a href="persons.php?searchByAge=child&search=">
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
                  $productiveAges = getCountPersonDataByAges("productiveAges");
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
              <div class="card-body card-box">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="people" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $elderly = getCountPersonDataByAges("elderly");
                  echo "<h2 class='title'>";
                  echo "$elderly";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">Elderly</p>
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

          <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
            <div class="card has-shadow">
              <div class="card-body card-box card-3">
                <div class="d-flex align-items-center card-title-box">
                  <div>
                    <ion-icon name="man" class="dashboard-icon"></ion-icon>
                  </div>
                  <?php
                  $passedAway = getCountPersonDataByAges("passedAway");
                  echo "<h2 class='title'>";
                  echo "$passedAway";
                  echo "</h2>";
                  ?>
                </div>
                <p class="card-text">Passed Away</p>
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
        </div>
      </div>
      <a href="jobs.php" class="table-title">
        <ion-icon name="clipboard-outline"></ion-icon>JOBS</a>
      <hr class="s3">
      <div class="table-style table-background">
        <table class="table table-striped table-hover" id="table">
          <thead class="table-dark">
          <tr class="color">
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Hobby</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
          <?php
          $jobs = getJobsDataFromDatabase();
          ?>
          <?php
          if (count($jobs) != 0):
            $number = 1;
            for ($i = 0; $i < count($jobs); $i++) :
              ?>
              <tr>
                <th scope="row" class="text-center"><?php echo $number++ ?></th>
                <td class="text-center"><?php echo $jobs[$i]['job_name'] ?></td>
                <td class="text-center"><?php
                  if ($jobs[$i]["count"] == null) :
                    echo "-";
                  else :
                    echo $jobs[$i]["count"];
                  endif;
                  ?></td>
              </tr>
            <?php
            endfor;
          endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
