
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="57x57" href="Assets/logo-pma/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="Assets/logo-pma/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="Assets/logo-pma/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="Assets/logo-pma/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="Assets/logo-pma/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="Assets/logo-pma/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="Assets/logo-pma/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="Assets/logo-pma/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="Assets/logo-pma/apple-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="Assets/logo-pma/android-icon-192x192.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="Assets/logo-pma/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="Assets/logo-pma/favicon-96x96.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="Assets/logo-pma/favicon-16x16.png" />
  <link rel="manifest" href="Assets/logo-pma/manifest.json" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />
  <title>Dashboard-PMA</title>

  <!-- LINK CSS FILE -->
  <link rel="stylesheet" href="Assets/css/dashboard.css" />
  <link rel="stylesheet" href="Assets/css/general.css" />
  <link rel="stylesheet" href="Assets/css/queries.css" />

  <!-- LINK ION ICON -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

  <!-- LINK FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Rubik:wght@400;500;700&display=swap" rel="stylesheet" />

  <!-- BOOTSTRAPS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <header class="header-position-fixed sticky-top">
    <nav class="navbar bg-body-tertiary navbar-background">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <button class="btn-nav d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <ion-icon class="icon-header" name="menu"></ion-icon>
          </button>
          <div class="d-flex">
            <div class="logo-pma">
              <img src="Assets/img/logo-pma-3.png" class="logo-pma" />
            </div>
            <p class="d-none d-md-flex PMA-title align-items-center">
              <strong class="PMA">PMA</strong>- Persons Management App
            </p>
          </div>

          <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
              <div class="d-flex align-items-center gx-2 sidebar-padding">
                <div class="logo-pma">
                  <img src="Assets/img/logo-pma-3.png" class="logo-pma" />
                </div>
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
                  <strong class="PMA">PMA</strong><br />
                  Persons Management App
                </h5>
              </div>

              <button class="btn-nav" type="button" data-bs-dismiss="offcanvas">
                <ion-icon class="icon-header" name="close"></ion-icon>
              </button>
            </div>
            <hr />
            <div class="offcanvas-body d-flex flex-column justify-content-between">
              <nav class="main-nav">
                <p>
                  Try scrolling the rest of the page to see this option in
                  action.
                </p>
                <ul class="main-nav-list">
                  <li>
                    <a class="main-nav-link dashboard-link" href="#">
                      <ion-icon name="speedometer"></ion-icon>
                      Dashboard</a>
                  </li>
                  <li>
                    <a class="main-nav-link" href="">
                      <ion-icon name="people"></ion-icon>
                      Persons
                    </a>
                  </li>
                  <li class="my-acount-padding">
                    <p class="my-acount">My Account</p>
                  </li>
                  <li class="sidebar-padding-li">
                    <a class="main-nav-link edit-profile-link" href="edit-profile.php">
                      <ion-icon clas="nav-icon" name="create"></ion-icon>
                      Edit Profil
                    </a>
                  </li>
                  <li class="sidebar-padding-li">
                    <a class="main-nav-link logout-link" href="#">
                      <ion-icon name="log-out"></ion-icon>
                      Logout</a>
                  </li>
                </ul>
              </nav>

              <div class="dropdown">
                <hr />
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2" />
                  <h6><strong>mdo</strong></h6>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                  <li>
                    <a class="dropdown-item" href="#">New project...</a>
                  </li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider" />
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
            <a class="person-link" href="#">me@example.com</a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <section class="section-dashboard d-flex">
      <!-- SIDEBAR -->
      <div class="sidebar-content d-none d-lg-flex">
        <div class="offcanvas-body d-flex flex-column justify-content-between sidebar-background">
          <nav class="main-nav main-nav-padding">
            <ul class="main-nav-list">
              <li>
                <a class="main-nav-link dashboard-link" href="#">
                  <ion-icon name="speedometer" role="img" class="md hydrated"></ion-icon>
                  Dashboard</a>
              </li>
              <li>
                <a class="main-nav-link" href="persons.php">
                  <ion-icon name="people" role="img" class="md hydrated"></ion-icon>
                  Persons
                </a>
              </li>
              <li class="my-acount-padding">
                <p class="my-acount">My Account</p>
              </li>
              <li class="sidebar-padding-li">
                <a class="main-nav-link edit-profile-link" href="edit-profile.php">
                  <ion-icon clas="nav-icon" name="create" role="img" class="md hydrated"></ion-icon>
                  Edit Profil
                </a>
              </li>
              <li class="sidebar-padding-li">
                <a class="main-nav-link logout-link" href="#">
                  <ion-icon name="log-out" role="img" class="md hydrated"></ion-icon>
                  Logout</a>
              </li>
            </ul>
          </nav>

          <div class="dropdown">
            <hr />
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle dropdown-img" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2" />
              <h6><strong>mdo</strong></h6>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
              <li>
                <a class="dropdown-item" href="#">New project...</a>
              </li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="main-content-dashboard d-flex flex-column">
        <div class="dashboard-content">
          <div class="dashboard-header">
<!--              <h3 class="dashboard-title">Hi, Cahya Kumala...</h3>-->
              <?php if(isset($_GET["name"]) ==1 ):
                  echo "<h3 class='dashboard-title'>";
                  echo "Hi, " . $_GET["name"] . "...";
                 echo "</h3>";
                 else :
                     echo "<h3 class='dashboard-title'>";
                     echo "Selamat datang di halaman dashboard!!!";
                     echo "</h3>"; ?>
              <?php endif; ?>

<!--              --><?php //if(checkLogin($_POST["name"])!= 0):
//                  echo "<h3 class='dashboard-title'>";
//                  echo "Hi, " . $_POST["name"] . "...";
//                  echo "</h3>";
//              else :
//                  echo "<h3 class='dashboard-title'>";
//                  echo "Selamat datang di halaman dashboard!!!";
//                  echo "</h3>";
//                  ?>
<!--              --><?php //endif; ?>

            <p class="dashboard-text">
              You were logged previously in
              <strong>Monday, 6 November 2023 3:04 PM</strong>
            </p>
          </div>
        </div>

        <div class="dashboard-boxs">
          <div class="row row-gap-4">
            <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
              <div class="card has-shadow">
                <div class="card-body card-box card-1">
                  <div class="d-flex align-items-center card-title-box">
                    <div>
                      <ion-icon name="people" class="dashboard-icon"></ion-icon>
                    </div>
                    <h2 class="title">103</h2>
                  </div>

                  <p class="card-text">Number of persons</p>
                  <p class="card-text-box">
                    Some quick example text to build on the card title and
                    make up the bulk of the card's content.
                  </p>
                    <a href="persons.php" target="_self">
                  <button class="more-info">More info &rAarr;</button>
                    </a>
                </div>
              </div>
            </div>

            <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
              <div class="card has-shadow">
                <div class="card-body card-box card-2">
                  <div class="d-flex align-items-center card-title-box">
                    <div>
                      <ion-icon name="accessibility" class="dashboard-icon"></ion-icon>
                    </div>
                    <h2 class="title">59</h2>
                  </div>

                  <p class="card-text">in Productive Ages</p>
                  <p class="card-text-box">
                    Some quick example text to build on the card title and
                    make up the bulk of the card's content.
                  </p>
                  <button class="more-info">More info &rAarr;</button>
                </div>
              </div>
            </div>

            <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
              <div class="card has-shadow">
                <div class="card-body card-box card-3">
                  <div class="d-flex align-items-center card-title-box">
                    <div>
                      <ion-icon name="man" class="dashboard-icon"></ion-icon>
                    </div>
                    <h2 class="title">18</h2>
                  </div>
                  <p class="card-text">passed away</p>
                  <p class="card-text-box">
                    Some quick example text to build on the card title and
                    make up the bulk of the card's content.
                  </p>
                  <button class="more-info">More info &rAarr;</button>
                </div>
              </div>
            </div>

            <div class="dashboard-box col-12 col-lg-6 col-md-6 col-sm-6 col-xl-4">
              <div class="card has-shadow">
                <div class="card-body card-box">
                  <div class="d-flex align-items-center card-title-box">
                    <div>
                      <ion-icon name="happy" class="dashboard-icon"></ion-icon>
                    </div>
                    <h2 class="title">18</h2>
                  </div>
                  <p class="card-text">toddler</p>
                  <p class="card-text-box">
                    Some quick example text to build on the card title and
                    make up the bulk of the card's content.
                  </p>
                  <button class="more-info">More info &rAarr;</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- BOOTSTRAPS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>