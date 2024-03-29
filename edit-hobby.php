<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit(); // Terminate script execution after the redirect
}
require_once __DIR__ . "/action/persons-action.php";
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/action/hobby-action.php";
?>

<?php
require_once __DIR__ . "/include/header.php";
showHeader("Edit-Hobby-PMA", "hobby.css","persons.css", personsNav: "persons-nav-link");
?>

<main>
  <section class="section-jobs">
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(personsNav: "persons-nav-link");
    ?>
    <div class="main-content d-flex-column">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="content-box padding-box">
              <?php ?>
              <div class="d-lg-flex align-items-center justify-content-center gap-4">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12 col-xl-7 has-shadow">
                  <div class="card d-flex has-shadow-blue card-background">
                    <div class="card-body">
                      <h3 class="content-title"> Edit Hobby</h3>
                      <hr class="s1">
                      <div class="d-flex-column justify-content-center">
                        <?php $id = $_GET['hobbyId'];
                        $hobby = getHobbyByIdFromDatabase($id);
                        $personId = $_GET['personId'];
                        ?>
                        <form class="hobby-form" action="action/edit-hobby-action.php" name="edit-hobby" method="post">
                          <input type="hidden" name="hobbyId" value="<?= $id ?>"/>
                          <input type="hidden" name="personId" value="<?= $personId ?>"/>
                          <div class="mb-3">
                            <ion-icon name="pencil"></ion-icon>
                            <label for="exampleInputPassword1" class="form-label">Hobby</label>
                            <input type="text"
                                   class="form-control"
                                   id="exampleInputPassword1"
                                   name="hobby"
                                   placeholder="hobby..."
                                   value="<?php
                                   if(isset($_SESSION['errorInputHobby'])) {
                                     echo $_SESSION['inputHobby'];
                                   } else {
                                     echo $hobby['name'];
                                   }
                                   ?>"
                            >
                          </div>
                          <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success" role="alert">
                              New jobs data has been saved.
                            </div>
                          <?php endif; ?>
                          
                          <?php if (isset($_GET['errorInput']) && $_GET['errorInput'] == 1): ?>
                          <div class="alert alert-danger" role="alert">
                          Sorry hobby data already exists;
                          </div>
                          <?php endif; ?>
                          <div class="text-end">
                            <button
                                type="submit"
                                class="btn btn-outline-primary save"
                                name="save-btn"
                            >
                              Save
                            </button>
                            <a class="cancel" href="persons.php">
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
    </div>
  </section>
</main>
<?php
unset ($_SESSION['errorInputHobby']);
unset ($_SESSION['inputHobby']);
?>
<?php
require_once __DIR__ . "/include/footer.php";
?>

