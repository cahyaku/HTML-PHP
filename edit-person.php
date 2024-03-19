<?php
session_start();
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/action/jobs-action.php";
redirectWhenNotLoggedIn($_SESSION['email']);
if (checkRole($_SESSION['email']) == null) {
  redirect("../dashboard.php", null);
}
if ($_GET['id'] == null) {
  redirect("/dashboard.php", null);
}
?>

<?php
require_once __DIR__ . "/include/header.php";
showHeader("Edit-Profile-PMA", "add-edit-person.css", personsNav: "persons-nav-link");
?>

  <main>
    <section class="section-edit-person d-flex">
      <?php
      require_once __DIR__ . "/include/sidebar.php";
      showSidebar(personsNav: "persons-nav-link");
      ?>
      <!-- MAIN CONTENT -->
      <div class="main-content d-flex flex-column">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 col-md-12">
              <div class="person-title">
                <h3 class="title">Edit person</h3>
              </div>
              <?php
              //              $persons = getPersonsDataFromJson();
              //              $persons = getPersonsDataFromDatabase();
              if (!is_numeric($_GET['id'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                  Person data was not found!!!
                </div>
              <?php } else if ($_GET['id'] < 1) { ?>
                <div class="alert alert-danger" role="alert">
                  Person data was not found!!!
                </div>
              <?php } else {
//                $person = getPersonDataById($_GET['id']);
                $person = getPersonByIdFromDatabase($_GET["id"]);
                $birthDate = translateDateFromIntToString($person['birth_date']);
                $_SESSION['id'] = $_GET['id'];
                ?>
                <?php if (isset($_SESSION['errorFirstName']) || isset($_SESSION['errorLastName']) || isset($_SESSION['errorNik'])
                  || isset($_SESSION['errorEmail']) || isset($_SESSION['errorPassword']) || isset($_SESSION['errorConfirmPassword'])) { ?>
                  <div class="alert alert-danger" role="alert">
                    Error while submitting the form:<br>
                    <hr>
                    <?php if (isset($_SESSION['errorFirstName'])): ?>
                      - Invalid first name<br>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['errorLastName'])): ?>
                      - Invalid last name<br>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['errorNik'])): ?>
                      - Invalid NIK<br>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['errorEmail'])): ?>
                      - Invalid Email<br>
                    <?php endif; ?>
                    <?php if ($_SESSION['errorPassword'] == 1 || $_SESSION['errorPassword'] == 2): ?>
                      - Invalid password<br>
                    <?php endif; ?>
                    <?php if ($_SESSION['errorConfirmPassword'] == 1): ?>
                      - New password and confirm password value didn't match<br>
                    <?php endif; ?>
                  </div>
                <?php } ?>
                <?php $id = $_GET['id'] ?>
                <form class="person-form" action="action/edit-person-action.php" name="edit-form" method="post">
                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >First name*</label
                        >
                        <input
                            type="text"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="First name"
                            value="<?php checkErrorValue($_SESSION['inputFirstName'], $person['first_name']); ?>"
                            name="firstName"
                            required
                        />
                        <?php if (isset($_SESSION["errorFirstName"])) : ?>
                          <div class="alert alert-danger" role="alert">
                            The maximum length of first name input is 15!!!
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >Last name*</label
                        >
                        <input
                            type="text"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="Last name"
                            value="<?php checkErrorValue($_SESSION['inputLastName'], $person['last_name']); ?>"
                            name="lastName"
                            required
                        />
                        <?php if (isset($_SESSION["errorLastName"])) : ?>
                          <div class="alert alert-danger" role="alert">
                            The maximum length of last name input is 15!!!
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >NIK*</label
                        >
                        <input
                            type="text"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="NIK"
                            name="nik"
                            value="<?php checkErrorValue($_SESSION['inputNik'], $person['nik']) ?>"

                            required
                        />
                        <?php if (isset($_SESSION["errorNik"])) : ?>
                          <?php if ($_SESSION['errorNik'] == 1) { ?>
                            <div class="alert alert-danger" role="alert">
                              The maximum length of NIK input is 16 characters
                            </div>
                          <?php } else { ?>
                            <div class="alert alert-danger" role="alert">
                              Sorry, nik already exists!!!
                            </div>
                          <?php } ?>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >Email*</label
                        >
                        <input
                            type="email"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="me@example.com"
                            name="email"
                            value="<?php checkErrorValue($_SESSION['inputEmail'], $person['email']) ?>"
                            required
                        />
                        <?php if (isset($_SESSION["errorEmail"])) : ?>
                          <div class="alert alert-danger" role="alert">
                            Sorry, email already exists!!!
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="form-padding">
                        <label for="Sex" class="form-label">Sex*</label>
                        <select
                            class="form-select form-select-lg mb-3 has-shadow select-text has-background"
                            aria-label="Large select example"
                            name="sex"
                        >
                          <option value="<?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputSex'])) {
                            echo $_SESSION['inputSex'];
                          } else {
                            echo translateValue($person['sex'], "F", "FEMALE", "MALE");
                          }
                          ?>">
                            <?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputSex'])) {
                              echo $_SESSION['inputSex'] == "MALE" ? "MALE" : "FEMALE";
                            } else {
                              echo translateValue($person['sex'], "F", "FEMALE", "MALE") == "MALE" ? "MALE" : "FEMALE";
                            } ?>
                          </option>
                          <?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputSex'])) { ?>
                            <option
                                value="<?php echo $_SESSION['inputSex'] == "MALE" ? "FEMALE" : "MALE"; ?>"><?php echo $_SESSION['inputSex'] == "MALE" ? "FEMALE" : "MALE"; ?></option>
                          <?php } else if (isset($_SESSION['inputSex']) == "FEMALE") { ?>
                            <option value="MALE">MALE</option>
                          <?php } else if (translateValue($person['sex'], "F", "FEMALE", "MALE") == "FEMALE") { ?>
                            <option value="MALE">MALE</option>
                          <?php } else { ?>
                            <option value="FEMALE">FEMALE</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >Birth date*</label
                        >
                        <input
                            type="date"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="Birth date"
                            value="<?php checkErrorValue($_SESSION['inputBirthDate'], $birthDate) ?>"
                            name="birthDate"
                            required
                        />
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="form-padding">
                        <label for="Role" class="form-label">Role</label>
                        <select
                            class="form-select form-select-lg mb-3 has-shadow select-text"
                            aria-label="Large select example "
                            name="role"
                            required
                        >
                          <option value="<?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputRole'])) {
                            echo $_SESSION['inputRole'];
                          } else {
                            echo translateValue($person['role'], "A", "ADMIN", "MEMBER");
                          }
                          ?>">
                            <?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputRole'])) {
                              echo $_SESSION['inputRole'] == "ADMIN" ? "ADMIN" : "MEMBER";
                            } else {
                              echo translateValue($person['role'], "A", "ADMIN", "MEMBER") == "ADMIN" ? "ADMIN" : "MEMBER";
                            } ?>
                          </option>
                          <?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputRole'])) { ?>
                            <option
                                value="<?php echo $_SESSION['inputRole'] == "ADMIN" ? "MEMBER" : "ADMIN"; ?>">
                              <?php echo $_SESSION['inputRole'] == "ADMIN" ? "MEMBER" : "ADMIN"; ?></option>
                          <?php } else if (isset($_SESSION['inputRole']) == "MEMBER") { ?>
                            <option value="ADMIN">ADMIN</option>
                          <?php } else if (translateValue($person['role'], "A", "ADMIN", "MEMBER") == "MEMBER") { ?>
                            <option value="ADMIN">ADMIN</option>
                          <?php } else { ?>
                            <option value="MEMBER">MEMBER</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >Address*</label
                        >
                        <input
                            type="text"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="Address"
                            name="address"
                            value="<?php checkErrorValue($_SESSION['inputAddress'], $person['address']) ?>"
                            required
                        />
                      </div>
                    </div>
                  </div>


                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="form-padding">
                        <label for="Jobs" class="form-label">Jobs</label>
                        <select
                            class="form-select form-select-lg mb-3 has-shadow select-text"
                            aria-label="Large select example"
                            name="jobs"
                            required
                        >
                          <?php
                          $personJobs = getPersonJobsByIdFromDatabase($person['job_id']);
                          ?>
                          <option value="<?php
                          if ($personJobs != null):
                            echo $personJobs['id'];
                          else:
                          echo "";
                          endif;
                          ?>">
                            <?php
                            if ($personJobs == null) :
                              echo "Open this select menu";
                            else:
                              echo ucwords($personJobs['job_name']);
                            endif;
                            ?>
                          </option>
                          <?php
                          $jobs = getJobsDataFromDatabase();
                          if (count($jobs) != 0) :
                            $number = 1;
                            for ($i = 0; $i < count($jobs); $i++):
                              ?>
                              <option value="<?php
                              echo $jobs[$i]['id'] ?>">
                                <?php echo ucwords($jobs[$i]['job_name']) ?>
                              </option>
                            <?php
                            endfor;
                          endif;
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class=" col-12 col-md-6 col-lg-6
                          ">
                      <div class="mb-3 text-area form-padding">
                        <label for="exampleFormControlTextarea1" class="form-label">
                          Internal notes
                          <ion-icon name="pencil"></ion-icon>
                        </label>
                        <textarea
                            class="form-control i-text has-background has-shadow"
                            id="exampleFormControlTextarea1"
                            rows="1"
                            name="internalNotes"
                        ><?php checkErrorValue($_SESSION['inputInternalNotes'], $person['internal_notes']) ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="card card-margin card-shadow">
                    <div class="card-header card-background-header">
                      <strong> EDIT PASSWORD
                        <ion-icon name="lock-closed-outline"></ion-icon>
                      </strong>
                    </div>
                    <div class="card-body card-background">
                      <div class="d-md-flex">
                        <div class="col-12 col-md-6 col-lg-6">
                          <div class="mb-3 form-padding">
                            <label for="exampleFormControlInput1" class="form-label"
                            >New Password*</label
                            >
                            <input
                                type="password"
                                class="form-control has-shadow input-data has-background"
                                id="exampleFormControlInput1"
                                placeholder="New Password..."
                                name="password"
                                value="<?php if (isset($_SESSION['errorPassword']) || isset($_SESSION['errorData'])) {
                                  echo $_SESSION['inputPassword'];
                                } else {
                                  echo "";
                                }
                                ?>"
                            />
                            <?php if (isset($_SESSION["errorPassword"])) { ?>
                              <div class="alert alert-danger" role="alert">
                                Password must have at least 1 capital letter, 1 non-capital letter, 1 number.
                                with a minimum length of 8 characters and a maximum of 16 characters.
                              </div>
                            <?php } ?>
                          </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                          <div class="mb-3 form-padding">
                            <label for="exampleFormControlInput1" class="form-label"
                            >Confirm Password*</label
                            >
                            <input
                                type="password"
                                class="form-control has-shadow input-data has-background"
                                id="exampleFormControlInput1"
                                placeholder="Confirm Password..."
                                name="confirmPassword"
                                value="<?php if (isset($_SESSION['errorConfirmPassword']) || isset($_SESSION['errorData'])) {
                                  echo $_SESSION['inputConfirmPassword'];
                                } else {
                                  echo "";
                                }
                                ?>"
                            />
                            <?php if (isset($_SESSION['errorConfirmPassword'])) : ?>
                              <div class="alert alert-danger" role="alert">
                                Confirm password is not correct!
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-check form-switch form-padding">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                           name="status"
                           value="ALIVE"
                           value="<?php if (isset($_SESSION['errorData'])) {
                             echo $_SESSION['inputAlive'];
                           } ?>"
                      <?php
                      if ($person['status'] == 1) {
                        echo "checked";
                      }
                      ?>
                    >
                    <label class="form-check-label" for="flexSwitchCheckDefault">This person is alive</label>
                  </div>
                  <div class="text-end btn-padding">
                    <button
                        type="submit"
                        class="btn btn-outline-primary btn-save"
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
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php
unset($_SESSION['errorNik']);
unset($_SESSION['errorEmail']);
unset($_SESSION['errorPassword']);
unset($_SESSION['errorFirstName']);
unset($_SESSION['errorLastName']);
unset ($_SESSION['inputEmail']);
unset ($_SESSION['inputNik']);
unset ($_SESSION['inputPassword']);
unset ($_SESSION['inputFirstName']);
unset ($_SESSION['inputLastName']);
unset ($_SESSION['inputAddress']);
unset ($_SESSION['inputSex']);
unset ($_SESSION['inputRole']);
unset ($_SESSION['inputBirthDate']);
unset ($_SESSION['internalNotes']);
unset ($_SESSION['errorConfirmPassword']);
unset ($_SESSION['inputConfirmPassword']);
unset ($_SESSION['inputJobs']);
?>
<?php
require_once __DIR__ . "/include/footer.php";
?>