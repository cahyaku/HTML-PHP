<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit(); // Terminate script execution after the redirect
}
require_once __DIR__ . "/action/jobs-action.php";
require_once __DIR__ . "/action/utils-action.php";
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
            <div class="content-box padding">
              <?php
              if (!is_numeric($_GET['id']) || $_GET['id'] < 1) :
                ?>
                <div class="alert alert-danger" role="alert">
                  Jobs data was not found.
                </div>
              <?php
              else:
                $id = $_GET['id'];
                $jobs = getPersonJobsByIdFromDatabase($id);
                $_SESSION['id'] = $_GET['id'];
                ?>
                <div class="d-lg-flex align-items-center justify-content-center">
                  <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-7 has-shadow-blue">
                    <div class="card d-flex">
                      <div class="card-body card-background">
                        <h3 class="content-title">Edit Jobs</h3>
                        <hr>
                        <form class="jobs-form" action="action/edit-jobs-action.php" name="edit-jobs" method="post">
                          <input type="hidden" name="id" value="<?= $id ?>"/>
                          <div class="mb-3">
                            <ion-icon name="pencil"></ion-icon>
                            <label for="exampleInputPassword1" class="form-label">Jobs</label>
                            <input type="text"
                                   class="form-control has-shadow-grey"
                                   id="exampleInputPassword1"
                                   name="jobs"
                                   placeholder="jobs..."
                                   value="<?php
                                   if (isset($_SESSION["errorInputJobs"])) {
                                     echo $_SESSION["inputJobs"];
                                   } else {
                                     echo $jobs['job_name'];
                                   } ?>"
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
              <?php endif; ?>
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
