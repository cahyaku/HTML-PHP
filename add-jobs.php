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
    <div class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="content-box padding">
              
              <div class="d-lg-flex align-items-center justify-content-center ">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-7 has-shadow-blue">
                  <div class="card d-flex">
                    <div class="card-body card-background">
                      <h3 class="content-title">Add Jobs</h3>
                      <hr>
                      <form class="jobs-form" action="action/add-jobs-action.php" name="create-jobs" method="post">
                        <div class="mb-3">
                          <ion-icon name="pencil"></ion-icon>
                          <label for="exampleInputPassword1" class="form-label">Jobs</label>
                          <input type="text"
                                 class="form-control has-shadow-grey"
                                 id="exampleInputPassword1"
                                 name="jobs"
                                 placeholder="jobs..."
                                 value="<?php
                                 if(isset($_SESSION['errorInputJobs'])) {
                                   echo $_SESSION['inputJobs'];
                                 }
                                 ?>"
                          >
                        </div>
                        <?php
                        if (isset($_SESSION["errorInputJobs"])):
                          ?>
                          <div class="alert alert-danger" role="alert">
                            Sorry jobs data already exists.
                          </div>
                        <?php endif; ?>
                        <div class="text-end">
                          <button
                              type="submit"
                              class="btn btn-outline-primary btn-save"
                              name="save-btn"
                          >
                            Save
                          </button>
                          <a class="cancel" href="jobs.php">
                            <button
                                type="button"
                                class="btn btn-secondary btn-cancel"
                            >
                              Cancel
                            </button>
                          </a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
unset ($_SESSION['errorInputJobs']);
unset ($_SESSION['inputJobs']);
?>

<?php
require_once __DIR__ . "/include/footer.php";
?>
