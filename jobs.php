<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit(); // Terminate script execution after the redirect
}
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/action/jobs-action.php";
?>

<?php
showHeader("Jobs-PMA", "jobs.css", jobsNav: "jobs-nav-link");
?>

<main>
  <section class="section-jobs">
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(jobsNav: "jobs-nav-link");
    ?>
    <div class="main-content">
      <div class="content-header-box d-flex justify-content-between">
        <h3 class="content-title">Jobs</h3>
        <div class="add-button">
          <button type="button" class="btn btn-outline-primary btn-add">
            <a class="add" href="add-jobs.php">
              +Add
            </a>
          </button>
        </div>
      </div>
      <div class="search-box">
        <nav class="navbar bg-body-tertiary has-shadow">
          <div class="container-fluid">
            <a class="navbar-brand">
              <ion-icon name="clipboard-outline"></ion-icon>
            </a>
            <form class="d-flex" role="search" name="search-form" method="get" action="#table">
              <input
                  class="form-control me-2"
                  type="search"
                  placeholder="Search"
                  aria-label="Search"
                  name="search"
                  value="<?php if (isset($_GET["search"])):
                    echo $_GET["search"];
                  endif;
                  ?>">
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
          </div>
        </nav>
      </div>

      <div class="table-responsive">
        <table class="table-primary table-width has-shadow" id="table">
          <?php
          if (isset($_GET["search"])) {
            $jobs = searchJobs($_GET["search"]);
          }
          else {
            $jobs = getJobsDataFromDatabase();
          }
          
          $limit = 5;
          $page = 1;
          $previous = $page - 1;
          $next = $page + 1;
          $data = paginatedData($jobs,$page,$limit);
          $jobsData = $data[PAGING_DATA];
          ?>
          <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col" class="text-center">Count</th>
          </tr>
          </thead>
          <tbody>
          
          <?php
          if (count($jobsData) != 0) :
            $number = ($page - 1) * $limit + 1;
            for ($i = 0; $i < count($jobsData); $i++) :
              ?>
              <tr>
                <th scope="row"><?php echo $number++?></th>
                <td><?php echo ucfirst($jobsData[$i]["job_name"])?></td>
                <td><?php echo ucfirst($jobsData[$i]["count"])?></td>
              </tr>
            <?php
            endfor;
          endif;
          ?>
          </tbody>
        </table>
        
        <div class="page-navigation-position">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php
              if (isset($_GET["search"])):
                $search = "?search" . $_GET["search"] . "&";
              else :
                $search = "?";
              endif;
              ?>
              
              <?php
              for ($x = 1; $x <= $data[PAGING_TOTAL_PAGE]; $x++) {
              ?>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
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
