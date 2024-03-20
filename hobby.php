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
require_once __DIR__ . "/action/hobby-action.php";
?>

<?php
showHeader("Add-PMA", "hobby.css", personsNav: "persons-nav-link");
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
              <?php $id = $_GET['id']; ?>
              <?php ?>
              <div class="d-xl-flex align-items-center justify-content-center gap-4 space">
                <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-8 has-background has-shadow-blue">
                  <h3 class="content-title">Hobby</h3>
                  <div class="card d-flex has-shadow-grey">
                    <div class="card-body">
                      <div class="d-flex-column justify-content-center">
                        <div>
                        </div>
                        <form class="hobby-form" action="action/add-hobby-action.php" name="create-hobby" method="post">
                          <input type="hidden" name="id" value="<?= $id ?>"/>
                          <div class="mb-3">
                            <ion-icon name="pencil"></ion-icon>
                            <label for="exampleInputPassword1" class="form-label">Hobby</label>
                            <input type="text"
                                   class="form-control"
                                   id="exampleInputPassword1"
                                   name="hobby"
                                   placeholder="hobby..."
                                   value="<?php
                                   if (isset($_SESSION['errorInputHobby'])) {
                                     echo $_SESSION['inputHobby'];
                                   } else {
                                     echo $_POST['hobby'];
                                   }?>"
                            >
                            <?php  if (isset($_SESSION['errorInputHobby'])): ?>
                              <div class="alert alert-danger" role="alert">
                                Sorry hobby data already exists.
                              </div>
                            <?php endif; ?>
                          </div>
                          <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success" role="alert">
                              New jobs data has been saved.
                            </div>
                          <?php endif;?>
                          
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
                                  class="btn btn-secondary cancel"
                              >
                                Cancel
                              </button>
                            </a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <?php $hobby = getPersonHobbyByIdFromDatabase($id);
                    
                    if ($hobby != null):
                      ?>
                      <table class="table table-hover  has-shadow-grey">
                        <thead class="table-light">
                        <tr class="color">
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Hobby</th>
                          <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
//                        $hobby = getHobbyDataFromDatabase();
                        if (count($hobby) != 0) :
                          $number = 1;
                          for ($i = 0; $i < count($hobby); $i++):
                            if ($hobby[$i]['person_id'] == $id):
                              ?>
                              <tr>
                                <th scope="row" class="text-center"><?php echo $number++ ?></th>
                                <td class="text-center"><?php echo $hobby[$i]["name"] ?></td>
                                <td class="text-end">
                                  <a class="hobby btn-table" href="edit-hobby.php?id=<?php echo $hobby[$i]["id"] ?>">
                                    <button type="button" class="btn btn-outline-primary edit" name="btn-hobby">
                                      Edit
                                    </button>
                                  </a>
                                  <button
                                      type="reset"
                                      class="btn btn-secondary btn-delete"
                                      data-bs-toggle="modal"
                                      data-bs-target="#exampleModal<?= $hobby[$i]['id'] ?>"
                                  > Delete
                                  </button>
                                  <div
                                      class="modal fade"
                                      id="exampleModal<?= $hobby[$i]["id"] ?>"
                                      tabindex="-1"
                                      aria-labelledby="exampleModalLabel"
                                      aria-hidden="true"
                                  >
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <p class="modal-title" id="exampleModalLabel">
                                            Are you sure want to delete this hobby?
                                          </p>
                                          <button
                                              type="button"
                                              class="btn-close"
                                              data-bs-dismiss="modal"
                                              aria-label="Close"
                                          ></button>
                                        </div>
                                        <div class="modal-footer">
                                          <button
                                              type="button"
                                              class="btn btn-secondary btn-block"
                                              data-bs-dismiss="modal"
                                          >
                                            No
                                          </button>
                                          <button
                                              type="button"
                                              class="btn btn-primary confirm"
                                          >
                                            <a class="link-confirm"
                                               href="action/delete-hobby-action.php?id=<?php echo $hobby[$i]['id'] ?>">
                                              Yes
                                            </a>
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            <?php
                            endif;
                          endfor;
                        endif; ?>
                        </tbody>
                      </table>
                    <?php endif; ?>
                  </div>
                  
                  <div class="btn-space">
                    <a class="cancel" href="persons.php">
                      <button
                          type="button"
                          class="btn btn-secondary cancel"
                      >
                        Back
                      </button>
                    </a>
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

