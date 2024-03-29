<?php

session_start();
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/include/db.php";
require_once __DIR__ . "/action/hobby-action.php";
require_once __DIR__ . "/action/jobs-action.php";
redirectWhenNotLoggedIn($_SESSION['email']);
if ($_GET['id'] == null) {
  redirect("/dashboard.php", null);
}
global $PDO;
?>

  <!-- HEADER -->
<?php
require_once __DIR__ . "/include/header.php";
showHeader("Persons-PMA", "view-person.css", "persons.css", cssStyle3: "hobby.css", personsNav: "persons-nav-link");
?>
  <main>
    <section class="section-View-person d-flex">
      <!--  SIDEBAR  -->
      <?php
      require_once __DIR__ . "/include/sidebar.php";
      showSidebar(personsNav: "persons-nav-link");
      ?>

      <!-- MAIN CONTENT -->
      <div class="main-content d-flex flex-column">
        <div class="container ">
          <div class="row">
            <div class="person-title">
              <h3 class="title">View person data</h3>
            </div>
            
            <?php if (isset($_GET["hobby"])): ?>
              <div class="alert alert-info" role="alert">
                Scroll down to view and manage hobby data.
              </div>
            <?php endif; ?>
            
            <?php
            if (!is_numeric($_GET['id'])) {
              ?>
              <div class="alert alert-danger" role="alert">
                Person data was not found!!!
              </div>
            <?php }
            else if ($_GET['id'] < 1) {
              ?>
              <div class="alert alert-danger" role="alert">
                Person data was not found!!!
              </div>
            <?php } else {
            $persons = getPersonByIdFromDatabase($_GET["id"]);
            ?>
            
            <?php if (isset($_SESSION['errorInputHobby'])): ?>
              <div class="alert alert-danger" role="alert">
                Invalid input hobby.
              </div>
            <?php endif; ?>
            <div class="person-data">
              <div class="card card-shadow">
                <div class="card-body">
                  <div class="d-md-flex ">
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">First name*</p>
                        <p class="data"><?php echo ucwords($persons['first_name']) ?></p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Last name*</p>
                        <p class="data"><?php echo ucwords($persons['last_name']) ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex ">
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">NIK*</p>
                        <p class="data"><?php echo $persons['nik'] ?></p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Email*</p>
                        <p class="data"><?php echo $persons['email'] ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="d-md-flex ">


                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Sex*</p>
                        <p class="data"><?php echo translateValue($persons['sex'], "F", "FEMALE", "MALE"); ?> </p>
                      </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Birth Date*</p>
                        <p class="data"><?php echo dateFormatToString($persons['birth_date']) ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex ">
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Role*</p>
                        <p class="data"><?php echo translateValue($persons['role'], "A", "ADMIN", "MEMBER"); ?> </p>
                      </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Address*</p>
                        <p class="data"><?php echo ucwords($persons['address']) ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex ">
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Job*</p>
                        <?php
                        $personJob = getPersonJobsByIdFromDatabase($persons['job_id']);
                        ?>
                        <p class="data"><?php echo ucwords($personJob['job_name']) ?></p>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 ">
                      <div class="card-padding">
                        <p class="text-title">Internal notes*</p>
                        <?php if ($persons['internal_notes'] != null) { ?>
                          <p class="data"><?php echo $persons['internal_notes']; ?></p>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <?php
                  $id = $_GET['id'];
                  ?>
                  <div class="d-xl-flex-column align-items-center justify-content-center space gap-4  has-background">
                    <h3 class="content-title">Hobby</h3>
                    <hr class="s1">
                    <?php if (checkRole($_SESSION['email']) != null && $_SESSION['email'] == $persons['email'] ||
                      checkRole($_SESSION['email']) != null && $_SESSION['email'] != $persons['email'] ||
                      checkRole($_SESSION['email']) == null && $_SESSION['email'] == $persons['email']): ?>
                      <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="card d-flex has-shadow-grey">
                          <div class="card-body">
                            <div class="d-flex-column justify-content-center">
                              <div>
                              </div>
                              <form class="hobby-form" action="action/add-hobby-action.php" name="create-hobby"
                                    id="table"
                                    method="post">
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
                                         } ?>"
                                         required
                                  >
                                  <?php if (isset($_SESSION['errorInputHobby'])): ?>
                                    <div class="alert alert-danger" role="alert">
                                      Sorry hobby data already exists.
                                    </div>
                                  <?php endif; ?>
                                </div>
                                <?php if (isset($_GET['success'])): ?>
                                  <div class="alert alert-success" role="alert">
                                    New jobs data has been saved.
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
                      </div>
                    <?php endif; ?>

                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
                      <div class="table-responsive">
                        <?php
                        $hobby = getPersonHobbyByIdFromDatabase($id);
                        if ($hobby != null):
                          ?>
                          <div class="table-style">
                            <table class="table table-hover  has-shadow-grey" id="table">
                              <thead class="table-light">
                              <tr class="color">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Hobby</th>
                                <th scope="col"></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                              $hobby = getPersonHobbyByIdFromDatabase($id);
                              if (count($hobby) != 0) :
                                $number = 1;
                                for ($i = 0; $i < count($hobby); $i++):
                                  ?>
                                  <tr>
                                    <th scope="row" class="text-center"><?php echo $number++ ?></th>
                                    <td class="text-center"><?php echo $hobby[$i]["name"] ?></td>
                                    <td class="text-end">
                                      <?php if (checkRole($_SESSION['email']) != null && $_SESSION['email'] == $persons['email'] ||
                                        checkRole($_SESSION['email']) != null && $_SESSION['email'] != $persons['email'] ||
                                        checkRole($_SESSION['email']) == null && $_SESSION['email'] == $persons['email'])
                                        : ?>
                                        <a class="hobby btn-table"
                                           href="edit-hobby.php?hobbyId=<?php echo $hobby[$i]["id"] ?>&personId=<?php echo $_GET['id'] ?>">
                                          <button type="button" class="btn btn-outline-primary edit" name="btn-hobby">
                                            Edit&ensp;🐻
                                          </button>
                                        </a>
                                        <button
                                            type="reset"
                                            class="btn btn-secondary btn-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal<?= $hobby[$i]['id'] ?>"
                                        > Delete
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                               fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                          </svg>
                                        </button>
                                      <?php endif; ?>
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
                                endfor;
                              endif; ?>
                              </tbody>
                            </table>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>


                  <div class="btn-box">
                    <?php if (checkRole($_SESSION['email']) != null && $_SESSION['email'] != $persons['email']) { ?>
                      <button
                          type="button"
                          class="btn btn-outline-primary btn-edit"
                      >
                        <a class="edit btn-text" href="edit-person.php?id=<?php echo $persons['id'] ?>">
                          Edit&ensp;😃
                        </a>
                      </button>
                    <?php } else if (checkRole($_SESSION['email']) != null && $_SESSION['email'] == $persons['email']) { ?>
                      <button
                          type="button"
                          class="btn btn-outline-primary btn-edit "
                      >
                        <a class="edit btn-text" href="edit-profile.php">
                          Edit&ensp;😃
                        </a>
                      </button>
                    <?php } ?>

                    <button
                        type="button"
                        class="btn btn-secondary btn-back "
                    >
                      <a class="back btn-text" href="persons.php">Back👈</a>
                    </button>
                    <!-- Button trigger modal -->
                    <?php if (checkRole($_SESSION['email']) != null && $_SESSION['email'] != $persons['email']) { ?>
                      <button
                          type="reset"
                          class="btn btn-secondary btn-delete"
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                      >
                        Delete
                      </button>
                    <?php } ?>

                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="exampleModal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                    >
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <p class="modal-title" id="exampleModalLabel">
                              Are you sure want to delete this person?
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
                                class="btn btn-primary btn-edit"
                            >
                              <a class="link-confirm"
                                 href="action/view-person-action.php?id=<?php echo $persons['id'] ?>">
                                Yes
                              </a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if ($_GET["error"] == 1) : ?>
                <div class="alert alert-danger" role="alert">
                  Only admin roles can edit person data!!!
                </div>
              <?php endif; ?>
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