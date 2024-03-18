<?php

function showHeader($title,
                    string $cssStyle = null,
                    string $cssStyle2 = null,
                    string $cssStyle3 = null,
                    string $personsNav = null,
                    string $dashboardNav = null,
                    string $editProfileNav = null,
                    string $jobsNav = null
):void
{ ?>
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
  <title><?php echo $title ?></title>

  <!-- LINK CSS FILE -->
  <link rel="stylesheet" href="assets/css/<?php echo $cssStyle?>"/>
  <link rel="stylesheet" href="assets/css/general.css"/>
  <link rel="stylesheet" href="assets/css/queries.css"/>
  <?php if ($cssStyle2 != null) {?>
  <link rel="stylesheet" href="assets/css/<?php echo $cssStyle2?>"/>
  <?php } ?>
  <?php if ($cssStyle2 != null) {?>
    <link rel="stylesheet" href="assets/css/<?php echo $cssStyle3?>"/>
  <?php } ?>
  
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
                  <a class="main-nav-link <?php echo $dashboardNav?>" href="dashboard.php">
                    <ion-icon name="speedometer"></ion-icon>
                    Dashboard</a
                  >
                </li>
                <li>
                  <a
                      class="main-nav-link <?php echo $personsNav?>"
                      href="persons.php"
                  >
                    <ion-icon name="people"></ion-icon>
                    Persons
                  </a>
                </li>
                <li>
                  <a
                      class="main-nav-link <?php echo $jobsNav?>"
                      href="jobs.php"
                  >
                    <ion-icon name="people"></ion-icon>
                    Jobs
                  </a>
                </li>
                <li class="my-acount-padding">
                  <p class="my-acount">My Account</p>

                </li>
                <li class="sidebar-padding-li">
                  <a
                      class="main-nav-link <?php echo $editProfileNav?>"
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
                  <a class="dropdown-item" href="/persons.php">New project...</a>
                </li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="/edit-profile.php">Profile</a></li>
                <li>
                  <hr class="dropdown-divider"/>
                </li>
                <li><a class="dropdown-item" href="/logout.php">Sign out</a></li>
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
<?php } ?>
