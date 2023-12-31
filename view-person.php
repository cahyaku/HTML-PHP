<?php
session_start();
require_once __DIR__ . "/action/common-action.php";
successLogin($_SESSION['email']);
?>

<!-- HEADER -->
<?php
require_once __DIR__ . "/include/header.php";
showHeader("Persons-PMA","view-person.css","persons.css",personsNav: "persons-nav-link");
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
      <div class="container">
        <div class="row">
          <div class="person-title">
            <h3 class="title">View person data</h3>
          </div>
          <?php
          if (isset($_GET['id'])) {
//            if ($_GET['id'] < 1) {
//              $id = $_GET['id'];
//            } else if (!is_numeric($_GET['id'])) {
//              $id = $_GET['id'];
//            } else {
//              $id = $_GET['id'];
//            }
          
          $id = $_GET['id'];
          $persons = getPersonData($id);
          ?>
          <div class="person-data">
            <div class="card card-shadow">
              <div class="card-body has-background">
                <div class="d-md-flex ">
                  <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card-padding">
                      <p class="text-title">First name*</p>
                      <p class="data"><?php echo ucwords($persons['firstName']) ?></p>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card-padding">
                      <p class="text-title">Last name*</p>
                      <p class="data"><?php echo ucwords($persons['lastName']) ?></p>
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
                      <p class="data"><?php echo $persons['sex'] ?></p>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card-padding">
                      <p class="text-title">Birth Date*</p>
                      <p class="data"><?php echo dateFormatToString($persons['birthDate']) ?></p>
                    </div>
                  </div>
                </div>

                <div class="d-md-flex ">
                  <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card-padding">
                      <p class="text-title">Role*</p>
                      <p class="data"><?php echo $persons['role'] ?></p>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 col-lg-6 ">
                    <div class="card-padding">
                      <p class="text-title">Address*</p>
                      <p class="data"><?php echo ucwords($persons['address']) ?></p>
                    </div>
                  </div>
                </div>

                <div class="card-padding">
                  <p class="text-title">Internal notes*</p>
                  <?php if ($persons['internalNotes'] != "") { ?>
                    <p class="data"><?php echo $persons['internalNotes'] ?></p>
                  <?php } ?>
                </div>

                <div class="text-end">
<!--                  <button-->
<!--                      type="button"-->
<!--                      class="btn btn-outline-primary btn-edit btn-space"-->
<!--                  >-->
<!--                    <a class="edit btn-text" href="edit-person.php?id=--><?php //echo $persons['id'] ?><!--">-->
<!--                      Edit&ensp;🐻-->
<!--                    </a>-->
<!--                  </button>-->
                  
                  <?php if (checkRole($_SESSION['email']) != null) { ?>
                  <button
                      type="button"
                      class="btn btn-outline-primary btn-edit btn-space"
                  >
                    <a class="edit btn-text" href="edit-person.php?id=<?php echo $persons['id'] ?>">
                      Edit&ensp;🐻
                    </a>
                  </button>
                  <?php } ?>
                  
                  <button
                      type="button"
                      class="btn btn-secondary btn-back btn-space"
                  >
                    <a class="back btn-text" href="persons.php"> Back </a>
                  </button>
                  <!-- Button trigger modal -->
                  <!--                  <button-->
                  <!--                      type="reset"-->
                  <!--                      class="btn btn-secondary btn-delete"-->
                  <!--                      data-bs-toggle="modal"-->
                  <!--                      data-bs-target="#exampleModal"-->
                  <!--                  >-->
                  <!--                    Delete-->
                  <!--                  </button>-->
                  
                  <?php if (checkRole($_SESSION['email']) != null) { ?>
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
            
            <?php endif;?>
          
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
