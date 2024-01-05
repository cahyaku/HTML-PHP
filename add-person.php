<?php
session_start();
require_once __DIR__ . "/action/common-action.php";
successLogin($_SESSION['email']);

//if (!isset($_SESSION['email'])) {
//  header("Location: login.php");
//  exit(); // Terminate script execution after the redirect
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- FAVICON -->
  <link
      rel="apple-touch-icon"
      sizes="57x57"
      href="assets/logo-pma/apple-icon-57x57.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="60x60"
      href="assets/logo-pma/apple-icon-60x60.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="72x72"
      href="assets/logo-pma/apple-icon-72x72.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="assets/logo-pma/apple-icon-76x76.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="114x114"
      href="assets/logo-pma/apple-icon-114x114.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="120x120"
      href="assets/logo-pma/apple-icon-120x120.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="144x144"
      href="assets/logo-pma/apple-icon-144x144.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="152x152"
      href="assets/logo-pma/apple-icon-152x152.png"
  />
  <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="assets/logo-pma/apple-icon-180x180.png"
  />
  <link
      rel="icon"
      type="image/png"
      sizes="192x192"
      href="assets/logo-pma/android-icon-192x192.png"
  />
  <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="assets/logo-pma/favicon-32x32.png"
  />
  <link
      rel="icon"
      type="image/png"
      sizes="96x96"
      href="assets/logo-pma/favicon-96x96.png"
  />
  <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="assets/logo-pma/favicon-16x16.png"
  />
  <link rel="manifest" href="assets/logo-pma/manifest.json"/>
  <meta name="msapplication-TileColor" content="#ffffff"/>
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"/>
  <meta name="theme-color" content="#ffffff"/>
  <title>Add-Person-PMA</title>

  <!-- LINK CSS FILE -->
  <link rel="stylesheet" href="assets/css/add-edit-person.css"/>
  <link rel="stylesheet" href="assets/css/general.css"/>
  <link rel="stylesheet" href="assets/css/queries.css"/>

  <!-- LINK ION ICON -->
  <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
  ></script>

  <!-- LINK FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet"
  />

  <!-- BOOTSTRAPS -->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
  />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<header class="header-position-fixed sticky-top">
  <nav class="navbar bg-body-tertiary navbar-background">
    <div class="container-fluid">
      <div class="d-flex align-items-center">
        <button
            class="btn-nav d-lg-none"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasScrolling"
            aria-controls="offcanvasScrolling"
        >
          <ion-icon class="icon-header" name="menu"></ion-icon>
        </button>
        <div class="d-flex">
          <div class="logo-pma">
            <a href="persons.php">
              <img src="assets/img/logo-pma-3.png" class="logo-pma"/>
            </a>
          </div>
          <p class="d-none d-md-flex PMA-title align-items-center">
            <strong class="PMA">PMA</strong>- Persons Management App
          </p>
        </div>
        <div
            class="offcanvas offcanvas-start"
            data-bs-scroll="true"
            data-bs-backdrop="false"
            tabindex="-1"
            id="offcanvasScrolling"
            aria-labelledby="offcanvasScrollingLabel"
        >
          <div class="offcanvas-header">
            <div class="d-flex align-items-center gx-2 sidebar-padding">
              <div class="logo-pma">
                <img src="assets/img/logo-pma-3.png" class="logo-pma"/>
              </div>
              <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
                <strong class="PMA">PMA</strong><br/>
                Persons Management App
              </h5>
            </div>
            <button
                class="btn-nav"
                type="button"
                data-bs-dismiss="offcanvas"
            >
              <ion-icon class="icon-header" name="close"></ion-icon>
            </button>
          </div>
          <hr/>
          <div
              class="offcanvas-body d-flex flex-column justify-content-between"
          >
            <nav class="main-nav">
              <p>
                Try scrolling the rest of the page to see this option in
                action.
              </p>
              <ul class="main-nav-list">
                <li>
                  <a class="main-nav-link" href="dashboard.php">
                    <ion-icon name="speedometer"></ion-icon>
                    Dashboard</a
                  >
                </li>
                <li>
                  <a
                      class="main-nav-link persons-nav-link"
                      href="persons.php"
                  >
                    <ion-icon name="people"></ion-icon>
                    Persons
                  </a>
                </li>

                <li class="my-acount-padding">
                  <p class="my-acount">My Account</p>

                </li>
                <li class="sidebar-padding-li">
                  <a
                      class="main-nav-link edit-profile-link"
                      href="edit-profile.php"
                  >
                    <ion-icon clas="nav-icon" name="create"></ion-icon>
                    Edit Profil
                  </a>
                </li>
                <li class="sidebar-padding-li">
                  <a class="main-nav-link logout-link" href="logout.php">
                    <ion-icon name="log-out"></ion-icon>
                    Logout</a
                  >
                </li>
              </ul>
            </nav>

            <div class="dropdown">
              <hr/>
              <a
                  href="#"
                  class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
              >
                <img
                    src="https://github.com/mdo.png"
                    alt="picture"
                    width="32"
                    height="32"
                    class="rounded-circle me-2"
                />
                <h6><strong>mdo</strong></h6>
              </a>
              <ul
                  class="dropdown-menu dropdown-menu-dark text-small shadow"
              >
                <li>
                  <a class="dropdown-item" href="#">New project...</a>
                </li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                  <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center">
        <div>
          <ion-icon name="person" class="person-icon"></ion-icon>
        </div>
        <div class="d-none d-lg-block">
          <a class="person-link" href="edit-profile.php">
            <?php
            echo $_SESSION['email'];
            ?>
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>

<main>
  <section class="section-add-person d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar-content d-none d-lg-flex">
      <div
          class="offcanvas-body d-flex flex-column justify-content-between sidebar-background"
      >
        <nav class="main-nav main-nav-padding">
          <ul class="main-nav-list">
            <li>
              <a class="main-nav-link" href="dashboard.php">
                <ion-icon
                    name="speedometer"
                    role="img"
                    class="md hydrated"
                ></ion-icon>
                Dashboard</a
              >
            </li>
            <li>
              <a class="main-nav-link persons-nav-link" href="persons.php">
                <ion-icon
                    name="people"
                    role="img"
                    class="md hydrated"
                ></ion-icon>
                Persons
              </a>
            </li>
            <li class="my-acount-padding">
              <p class="my-acount">My Account</p>
            </li>
            <li class="sidebar-padding-li">
              <a
                  class="main-nav-link edit-profile-link"
                  href="edit-profile.php"
              >
                <ion-icon
                    clas="nav-icon"
                    name="create"
                    role="img"
                    class="md hydrated"
                ></ion-icon>
                Edit Profil
              </a>
            </li>
            <li class="sidebar-padding-li">
              <a class="main-nav-link logout-link" href="logout.php">
                <ion-icon
                    name="log-out"
                    role="img"
                    class="md hydrated"
                ></ion-icon>
                Logout</a
              >
            </li>
          </ul>
        </nav>

        <div class="dropdown">
          <hr/>
          <a
              href="#"
              class="d-flex align-items-center text-white text-decoration-none dropdown-toggle dropdown-img"
              data-bs-toggle="dropdown"
              aria-expanded="false"
          >
            <img
                src="https://github.com/mdo.png"
                alt=""
                width="32"
                height="32"
                class="rounded-circle me-2"
            />
            <h6>
              <srtong>mdo</srtong>
            </h6>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li>
              <a class="dropdown-item" href="#">New project...</a>
            </li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
              <hr class="dropdown-divider"/>
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>

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
<!--                        The minimum length of Password input is 8 characters and maximum 16 characters-->
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
                      <!--                      --><?php
                      //                      if (isset($_GET['errorInput'])) {
                      //                        ?>
                      <!--                        <option-->
                      <!--                            value="--><?php //echo $_SESSION['inputRole']; ?><!--">-->
                      <?php //echo $_SESSION['inputRole']; ?><!--</option>-->
                      <!--                      --><?php //} else { ?>
                      <!--                        <option selected disabled="disabled" value="">Open this select menu</option>-->
                      <!--                        <option value="ADMIN">ADMIN</option>-->
                      <!--                        <option value="MEMBER">MEMBER</option>-->
                      <!--                      --><?php //} ?>
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

<!-- BOOTSTRAPS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>

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

</body>
</html>
