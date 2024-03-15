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
                $jobs = getJobsByIdFromDatabase($_GET['id']);
                $_SESSION['id'] = $_GET['id'];
                $id = $_GET['id'];
                ?>
                <div class="d-lg-flex align-items-center justify-content-center gap-4">
                  <!--                  <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-4">-->
                  <!--                    <div class="card d-flex">-->
                  <!--                      <div class="card-body">-->
                  <!--                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of-->
                  <!--                          the-->
                  <!--                          card's content.</p>-->
                  <!--                      </div>-->
                  <!--                    </div>-->
                  <!--                  </div>-->
                  <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-7 has-shadow-card">
                    <div class="card d-flex">
                      <div class="card-body">
                        <h3 class="content-title">Edit Jobs</h3>
                        <hr>
                        <form class="jobs-form" action="action/edit-jobs-action.php" name="edit-jobs" method="post">
                          <input type="hidden" name="id" value="<?= $id ?>"/>
                          <div class="mb-3">
                            <ion-icon name="pencil"></ion-icon>
                            <label for="exampleInputPassword1" class="form-label">Jobs</label>
                            <input type="text"
                                   class="form-control"
                                   id="exampleInputPassword1"
                                   name="jobs"
                                   placeholder="jobs..."
                                   value="<?php echo $_POST['jobs'] ?>"
                            >
                          </div>
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
require_once __DIR__ . "/include/footer.php";
?>
