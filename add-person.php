<?php
session_start();
require_once __DIR__ . "/action/common-action.php";
successLogin($_SESSION['email']);
?>

<?php
//require_once __DIR__ ."/include/header.php";
//showHeader("Add-Person-PMA", "add-edit-person.css", "general.css", "queries.css",personsNav: "persons-nav-link");
//?>

<?php
require_once __DIR__ ."/include/header.php";
showHeader("Add-Person-PMA", "add-edit-person.css",personsNav: "persons-nav-link");
?>
<main>
  <section class="section-add-person d-flex">
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
              <h3 class="title">Add person</h3>
            </div>

            <form class="person-form" action="action/add-person-action.php" name="create-form" method="post">
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
                        placeholder="First Name"
                        name="firstName"
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputFirstName'];
                        } ?>"
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
                        placeholder="Last Name"
                        name="lastName"
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputLastName'];
                        } ?>"
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
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputNik'];
                        } ?>"
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
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputEmail'];
                        } ?>"
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
                  <div class="mb-3 form-padding">
                    <label for="exampleFormControlInput1" class="form-label"
                    >Password*</label
                    >
                    <input
                        type="password"
                        class="form-control has-shadow input-data has-background"
                        id="exampleFormControlInput1"
                        placeholder="Password"
                        name="password"
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputPassword'];
                        } ?>"
                        required
                    />
                    <?php if (isset($_SESSION["errorPassword"])) : ?>
                      <div class="alert alert-danger" role="alert">
                        Password must have at least 1 capital letter, 1 non-capital letter, 1 number.
                        with a minimum length of 8 characters and a maximum of 16 characters.
                      </div>
                    <?php endif; ?>
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
                        placeholder="Confirm Password"
                        name="confirmPassword"
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputConfirmPassword'];
                        } ?>"
                        required
                    />
                    <?php if (isset($_SESSION["errorConfirmPassword"])) : ?>
                      <div class="alert alert-danger" role="alert">
                        Confirm password is not correct!
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              
              <div class="d-md-flex">
                <div class="col-12 col-md-6 col-lg-6">
                  <div class="form-padding">
                    <label for="Role" class="form-label">Sex</label>
                    <select
                        class="form-select form-select-lg mb-3 has-shadow select-text"
                        aria-label="Large select example"
                        name="sex"
                        required
                    >
                      <?php
                      if (isset($_SESSION['inputSex'])) {
                        ?>
                        <option value="<?php echo $_SESSION['inputSex']; ?>">
                          <?php echo($_SESSION['inputSex']); ?></option>
                        <?php if ($_SESSION['inputSex'] == "FEMALE") { ?>
                          <option value="MALE">MALE</option>
                        <?php } else { ?>
                          <option value="FEMALE">FEMALE</option>
                        <?php } ?>
                      <?php } else if (isset($_GET['errorInput'])) { ?>
                        <option selected disabled="disabled" value="">Open this select menu</option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                      <?php } else { ?>
                        <option selected disabled="disabled" value="">Open this select menu</option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                      <?php } ?>
                      <!--                        <option value="--><?php //if (isset($_GET['errorInput'])) {
                      //                          echo $_SESSION['inputSex'];
                      //                        } else {
                      //                          echo "";
                      //                        }
                      //                        ?><!--" selected disabled>-->
                      <!--                          --><?php //if (isset($_SESSION['inputSex'])) {
                      //                            echo $_SESSION['inputSex'] == "Male" ? "MALE" : "FEMALE";
                      //                          } else {
                      //                            echo "Open this select menu";
                      //                          } ?>
                      <!--                        </option>-->
                      <!--                        --><?php //if (isset($_SESSION['inputSex']) == "FEMALE") { ?>
                      <!--                          <option value="MALE">Male</option>-->
                      <!--                        --><?php //} else if (isset($_SESSION['inputSex']) == "MALE") { ?>
                      <!--                          <option value="FEMALE">Female</option>-->
                      <!--                        --><?php //} else { ?>
                      <!--                          <option value="MALE">Male</option>-->
                      <!--                          <option value="FEMALE">Female</option>-->
                      <!--                      --><?php //} ?>
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
                        class="form-control has-shadow input-data has-background "
                        id="exampleFormControlInput1"
                        placeholder="Birth date"
                        name="birthDate"
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputBirthDate'];
                        } ?>"
                        required
                    />
                    <?php if (isset($_SESSION["errorBirthDate"])) : ?>
                      <div class="alert alert-danger" role="alert">
                        Maaf, input tanggal lahir tidak valid!
                      </div>
                    <?php endif; ?>
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
                      <?php
                      if (isset($_SESSION['inputRole'])) {
                        ?>
                        <option value="<?php echo $_SESSION['inputRole']; ?>">
                          <?php echo ucwords($_SESSION['inputRole']); ?></option>
                        <?php if ($_SESSION['inputRole'] == "MEMBER") { ?>
                          <option value="ADMIN">ADMIN</option>
                        <?php } else { ?>
                          <option value="MEMBER">MEMBER</option>
                        <?php } ?>
                      <?php } else if (isset($_GET['errorInput'])) { ?>
                        <option selected disabled="disabled" value="">Open this select menu</option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="MEMBER">MEMBER</option>
                      <?php } else { ?>
                        <option selected disabled="disabled" value="">Open this select menu</option>
                        <option value="ADMIN">ADMIN</option>
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
                        value="<?php if ($_GET['errorInput'] == 1) {
                          echo $_SESSION['inputAddress'];
                        } ?>"
                        required
                    />
                  </div>
                </div>
              </div>

              <div class="form-padding">
                <div class="mb-3 text-area">
                  <label for="exampleFormControlTextarea1" class="form-label">
                    Internal notes
                    <ion-icon name="pencil"></ion-icon>
                  </label>
                  <textarea
                      class="form-control i-text has-background has-shadow"
                      id="exampleFormControlTextarea1"
                      rows="2"
                      name="internalNotes"
                  ><?php if ($_GET['errorInput'] == 1) {
                      echo $_SESSION['inputInternalNotes'];
                    } ?></textarea>
                </div>
              </div>
<!--              <div class="form-check form-switch form-padding">-->
<!--                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="alive"-->
<!--                       value="ALIVE">-->
<!--                <label class="form-check-label" for="flexSwitchCheckDefault">This person is alive</label>-->
<!--              </div>-->

              <div class="form-check form-switch form-padding">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="alive"
                       value="ALIVE"
                <?php
                if ($_GET['errorInput'] == 1 && $_SESSION['inputStatus'] != null) {
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
unset($_SESSION['errorConfirmPassword']);
unset($_SESSION['errorBirthDate']);

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
unset ($_SESSION['inputConfirmPassword']);
?>

<?php
require_once __DIR__ . "/include/footer.php";
?>
