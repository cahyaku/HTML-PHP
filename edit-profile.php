<?php
session_start();
require_once __DIR__ . "/action/utils-action.php";
redirectWhenNotLoggedIn($_SESSION['email']);
?>

<?php
require_once __DIR__ . "/include/header.php";
showHeader("Edit-Profile-PMA", "add-edit-person.css", editProfileNav: "profile-nav-link");
?>

  <main>
    <section class="section-edit-person d-flex">
      <?php
      require_once __DIR__ . "/include/sidebar.php";
      showSidebar(editProfileNav: "profile-nav-link");
      ?>
      <!-- MAIN CONTENT -->
      <div class="main-content d-flex flex-column">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 col-md-12">
              <div class="person-title">
                <h3 class="title">My Profile</h3>
              </div>
              <?php
              if (isset($_SESSION['email'])) {
                $person = getPersonDataByEmail($_SESSION['email']);
                $_SESSION['userEmail'] = $_SESSION['email'];
                $_SESSION['id'] = $person['id'];
                $birthDate = translateDateFromIntToString($person['birthDate']);
                ?>
                
                <?php if (isset($_SESSION['errorFirstName']) || isset($_SESSION['errorLastName']) || isset($_SESSION['errorNik'])
                  || isset($_SESSION['errorEmail']) || isset($_SESSION['errorPassword']) || isset($_SESSION['errorConfirmPassword'])
                  || isset($_SESSION['errorCurrentPassword'])) { ?>
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
                    <?php if (isset($_SESSION['errorPassword'])): ?>
                      - Invalid password<br>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['errorCurrentPassword'])): ?>
                      - Invalid current password!<br>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['errorConfirmPassword']) && $_SESSION['errorConfirmPassword'] != 1): ?>
                      - New password and confirm password value didn't match<br>
                    <?php endif; ?>
                    <?php if ($_SESSION['errorConfirmPassword'] == 1) : ?>
                      - Invalid current password
                    <?php endif; ?>
                  </div>
                <?php } ?>

                <form class="person-form" action="action/edit-profile-action.php" name="edit-profile-form"
                      method="post">

                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >First name*</label
                        >
                        <input
                            type="text"
                            name="firstName"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="First name"
                            value="<?php checkErrorValue($_SESSION['inputFirstName'],$person['firstName'])?>"
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
                            name="lastName"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="LastName"
                          value="<?php checkErrorValue($_SESSION['inputLastName'],$person['lastName'])?>"
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
                            name="nik"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="NIK"
                            value="<?php checkErrorValue($_SESSION['inputNik'],$person['nik'])?>"
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
                            name="email"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="me@example.com"
                            value="<?php checkErrorValue($_SESSION['inputEmail'],$person['email'])?>"
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
                            class="form-select form-select-lg mb-3 has-shadow select-text"
                            aria-label="Large select example"
                            name="sex"
                        >
                          <option value="<?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputSex'])) {
                            echo $_SESSION['inputSex'];
                          } else {
                            echo $person['sex'];
                          }
                          ?>">
                            <?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputSex'])) {
                              echo $_SESSION['inputSex'] == "MALE" ? "MALE" : "FEMALE";
                            } else {
                              echo $person['sex'] == "MALE" ? "MALE" : "FEMALE";
                            } ?>
                          </option>
                          <?php if (isset($_SESSION['errorData']) && isset($_SESSION['inputSex'])) { ?>
                            <option
                                value="<?php echo $_SESSION['inputSex'] == "MALE" ? "FEMALE" : "MALE"; ?>"><?php echo $_SESSION['inputSex'] == "MALE" ? "FEMALE" : "MALE"; ?></option>
                          <?php } else if (isset($_SESSION['inputSex']) == "FEMALE") { ?>
                            <option value="MALE">MALE</option>
                          <?php } else if ($person['sex'] == "FEMALE") { ?>
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
                            name="birthDate"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="Birth date"
                            value="<?php checkErrorValue($_SESSION['inputBirthDate'],$birthDate)?>"
                            required
                        />
                      </div>
                    </div>
                  </div>

                  <div class="d-md-flex">
                    <div class="col-12 col-md-6 col-lg-6">
                      <div class="mb-3 form-padding">
                        <label for="exampleFormControlInput1" class="form-label"
                        >Address*</label
                        >
                        <input
                            type="text"
                            name="address"
                            class="form-control has-shadow input-data has-background"
                            id="exampleFormControlInput1"
                            placeholder="Address"
                            value="<?php checkErrorValue($_SESSION['inputAddress'],$person['address'])?>"
                            required
                        />
                      </div>
                    </div>
                    <?php
                    if (checkRole($_SESSION['email']) != null) {
                      ?>
                      <div class="col-12 col-md-6 col-lg-6">
                        <div class="mb-3 text-area form-padding">
                          <label
                              for="exampleFormControlTextarea1"
                              class="form-label"
                          >
                            Internal notes
                            <ion-icon name="pencil"></ion-icon>
                          </label>
                          <textarea
                              class="form-control i-text has-background has-shadow"
                              id="exampleFormControlTextarea1"
                              rows="1"
                              name="internalNotes"
                          ><?php checkErrorValue($_SESSION['inputInternalNotes'],$person['internalNotes'])?></textarea>
                        </div>
                      </div>
                    <?php } ?>
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
                            >Current Password*</label
                            >
                            <input
                                type="password"
                                class="form-control has-shadow input-data has-background"
                                id="exampleFormControlInput1"
                                placeholder="Current Password..."
                                name="currentPassword"
                                value="<?php if (isset($_SESSION['errorCurrentPassword']) || isset($_SESSION['errorPassword'])
                                  || isset($_SESSION['errorConfirmPassword'])
                                ) {
                                  echo $_SESSION['inputCurrentPassword'];
                                } else {
                                  echo "";
                                }
                                ?>"
                            />
                            <?php if (isset($_SESSION["errorCurrentPassword"]) && $_SESSION["errorCurrentPassword"] == 1) : ?>
                              <div class="alert alert-danger" role="alert">
                                Current password input is not correct!
                              </div>
                            <?php endif; ?>
                            
                            <?php if ($_SESSION['errorConfirmPassword'] == 1) : ?>
                              <div class="alert alert-danger" role="alert">
                                Please input current password!!!
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>

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
                            <?php if ($_SESSION["errorPassword"] == "1") { ?>
                              <div class="alert alert-danger" role="alert">
                                Password must have at least 1 capital letter, 1 non-capital letter, 1 number.
                                with a minimum length of 8 characters and a maximum of 16 characters.
                              </div>
                            <?php } ?>
                          </div>
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
                          <?php if ($_SESSION['errorConfirmPassword'] == 2) : ?>
                            <div class="alert alert-danger" role="alert">
                              Confirm password is not correct!
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                  if (isset($_GET['success'])) {
                    ?>
                    <div class="alert alert-success form-padding alert-padding" role="alert">
                      Data person has been changed!!!
                    </div>
                  <?php } ?>
                  <div class="text-end btn-padding">
                    <button
                        type="submit"
                        class="btn btn-outline-primary btn-save"
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
unset ($_SESSION['inputBirthDate']);
unset ($_SESSION['internalNotes']);
unset ($_SESSION['errorConfirmPassword']);
unset($_SESSION['errorCurrentPassword']);
unset ($_SESSION['inputConfirmPassword']);
unset($_SESSION['inputCurrentPassword']);
?>

<?php
require_once __DIR__ . "/include/footer.php";
?>