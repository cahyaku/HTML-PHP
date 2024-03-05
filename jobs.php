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
showHeader("Jobs-PMA", "jobs.css", dashboardNav: "dashboard-link");
?>

<main>
  <section class="section-jobs">
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(jobsNav: "jobs-nav-link");
    ?>

    <!--     MAIN CONTENT-->
    <!--    <div class="main-content">-->
    <!--      <div class="content-header-box">-->
    <!--        <div class="jobs-header">-->
    <!--          <h3 class="content-title">Jobs</h3>-->
    <!--          -->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    -->
    <div class="main-content d-flex flex-column">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12 col-xl-12 col-md-12">
            <div class="title">
              <h3 class="content-title">Jobs</h3>
            </div>

            <div>
              <table class="table">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
