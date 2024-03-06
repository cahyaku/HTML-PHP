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
?>

<?php
showHeader("Add-PMA", "jobs.css", jobsNav: "jobs-nav-link");
?>

<main>
  <section class="section-jobs">
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(jobsNav: "jobs-nav-link");
    ?>
    <div class="main-content d-flex-column">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="add-jobs-form padding">
                                <h3>Add Jobs</h3>
<!--              <div class="row background has-shadow">-->
              <div class="d-lg-flex">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-6">
                  <div class="card d-flex">
<!--                    <img src="assets/img/logo-pma-3.png" class="card-img-top" alt="logo">-->
                    <div class="card-body">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the
                        card's content.</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-6">
                  <div class="card d-flex">
<!--                    <img src="assets" class="card-img-top" alt="logo">-->
                    <div class="card-body">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                        the
                        card's content.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!--            </div>-->
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
