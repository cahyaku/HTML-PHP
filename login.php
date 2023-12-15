<?php
if (isset($_SESSION['email'])) {
  header("Location: ../dashboard.php");
  exit(); // Terminate script execution after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="57x57" href="Assets/logo-pma/apple-icon-57x57.png"/>
  <link rel="apple-touch-icon" sizes="60x60" href="Assets/logo-pma/apple-icon-60x60.png"/>
  <link rel="apple-touch-icon" sizes="72x72" href="Assets/logo-pma/apple-icon-72x72.png"/>
  <link rel="apple-touch-icon" sizes="76x76" href="Assets/logo-pma/apple-icon-76x76.png"/>
  <link rel="apple-touch-icon" sizes="114x114" href="Assets/logo-pma/apple-icon-114x114.png"/>
  <link rel="apple-touch-icon" sizes="120x120" href="Assets/logo-pma/apple-icon-120x120.png"/>
  <link rel="apple-touch-icon" sizes="144x144" href="Assets/logo-pma/apple-icon-144x144.png"/>
  <link rel="apple-touch-icon" sizes="152x152" href="Assets/logo-pma/apple-icon-152x152.png"/>
  <link rel="apple-touch-icon" sizes="180x180" href="Assets/logo-pma/apple-icon-180x180.png"/>
  <link rel="icon" type="image/png" sizes="192x192" href="Assets/logo-pma/android-icon-192x192.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="Assets/logo-pma/favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="96x96" href="Assets/logo-pma/favicon-96x96.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="Assets/logo-pma/favicon-16x16.png"/>
  <link rel="manifest" href="Assets/logo-pma/manifest.json"/>
  <meta name="msapplication-TileColor" content="#ffffff"/>
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"/>
  <meta name="theme-color" content="#ffffff"/>
  <title><?php echo "PMA - Person Management App" ?></title>

  <!-- ION-ICON -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

  <!-- FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Rubik:wght@400;500;700&display=swap"
      rel="stylesheet"/>

  <!-- LINK CSS FILE -->
  <link rel="stylesheet" href="Assets/css/general.css"/>
  <link rel="stylesheet" href="Assets/css/login.css"/>
  <link rel="stylesheet" href="Assets/css/queries.css"/>

  <!-- BOOTSTRAPS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<main>
  <section class="section-cta d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-9 col-xl-8">
          <div class="cta">
            <div class="cta-heading">
              <p>masuk ke halaman administrasi</p>
            </div>
            <div class="cta-box">
              <div class="row">
                <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-xl-12">
                  <div class="login-pma">
                    <div class="row d-flex align-items-center justify-content-center">
                      <div class="col-8 col-lg-4 col-md-8 col-sm-8 justify-content-center">
                        <div class="cta-logo">
                          <div class="logo">
                            <img src="Assets/img/logo-pma-3.png" class="logo-pma-login" title="Person-Management-App"/>
                          </div>
                          <p class="PMA-title">
                            <strong class="PMA">PMA</strong><br/>
                            Person Management App
                          </p>
                        </div>
                      </div>

                      <div class="col-12 col-lg-7 col-md-12">
                        <div class="cta-text-box">
                          <form name="login-form" class="cta-form"
                                action="Action/login-action.php" method="post">
                            <div class="mb-3">
                              <label for="email">
                                <ion-icon name="mail"></ion-icon>
                                Email
                              </label>
                              <input class="form-contol" id="email" name="email"
                                     type="email" placeholder="me@example.com" required/>
                            </div>
                            <div class="mb-3">
                              <label for="password">
                                <ion-icon name="key"></ion-icon>
                                Password
                              </label>
                              <input class="form-contol" id="password" name="password"
                                     type="password" placeholder="Password" required/>
                            </div>
                            <?php if ($_GET["error"] == 1) : ?>
                              <div class="alert alert-danger" role="alert">
                                Sorry, your email or password was wrong. Please check
                                again.
                              </div>
                            <?php endif; ?>
                            <button name="login-button" type="submit"
                                    class="btn btn-outline-primary btn-login">
                              Login
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="link">
              <a class="cta-link" href="#">Register as Member</a> "or"
              <a class="cta-link" href="#">Forgot Password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- BOOTSTRAPS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>