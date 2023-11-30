<?php
//include("persons.json");
//$personsData = loadDataFromJson("persons.json")
require_once __DIR__ . "/Action/persons-action.php";
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
            href="Assets/logo-pma/apple-icon-57x57.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="60x60"
            href="Assets/logo-pma/apple-icon-60x60.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="72x72"
            href="Assets/logo-pma/apple-icon-72x72.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="Assets/logo-pma/apple-icon-76x76.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="114x114"
            href="Assets/logo-pma/apple-icon-114x114.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="120x120"
            href="Assets/logo-pma/apple-icon-120x120.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="144x144"
            href="Assets/logo-pma/apple-icon-144x144.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="152x152"
            href="Assets/logo-pma/apple-icon-152x152.png"
    />
    <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="Assets/logo-pma/apple-icon-180x180.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="192x192"
            href="Assets/logo-pma/android-icon-192x192.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="Assets/logo-pma/favicon-32x32.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="96x96"
            href="Assets/logo-pma/favicon-96x96.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="Assets/logo-pma/favicon-16x16.png"
    />
    <link rel="manifest" href="Assets/logo-pma/manifest.json"/>
    <meta name="msapplication-TileColor" content="#ffffff"/>
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png"/>
    <meta name="theme-color" content="#ffffff"/>

    <title>Persons-PMA</title>

    <!-- LINK CSS FILE -->
    <link rel="stylesheet" href="Assets/css/general.css"/>
    <link rel="stylesheet" href="Assets/css/persons.css"/>
    <link rel="stylesheet" href="Assets/css/queries.css"/>

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
                        <a href="dashboard.php">
                            <img src="Assets/img/logo-pma-3.png" class="logo-pma"/>
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
                                <img src="Assets/img/logo-pma-3.png" class="logo-pma"/>
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
                                    <a class="main-nav-link" style="color: #364fc7" href="#">
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
                                    <a class="main-nav-link logout-link" href="#">
                                        <ion-icon name="log-out"></ion-icon>
                                        Logout</a
                                    >
                                </li>
                            </ul>
                        </nav>

                        <div class="dropdown dropdown-padding">
                            <hr/>
                            <a
                                    href="#"
                                    class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
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
                    <a class="person-link" href="edit-profile.php">me@example.com</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="section-persons d-flex">
        <div class="sidebar-content d-none d-lg-flex">
            <div
                    class="d-flex flex-column justify-content-between sidebar-background"
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
                            <a class="main-nav-link" style="color: #364fc7" href="persons.php">
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
                            <a class="main-nav-link logout-link" href="#">
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
                        <h6><strong>mdo</strong></h6>
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
        <div class="main-content-persons">
            <div class="persons-box d-flex justify-content-between">
                <div class="person-header">
                    <h3 class="box-title">Persons</h3>
                </div>
                <div class="add-button">
                    <a class="add" href="add-person.php">
                        <button type="button" class="btn btn-outline-primary btn-add">
                            +Add
                        </button>
                    </a>
                </div>
            </div>

            <div class="search-box">
                <div class="d-flex">
                    <div class="dropdown">
                        <button
                                class="btn btn-secondary dropdown-toggle btn-dropdown"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                id="searchByAge"
                        >
                            Search by age
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">Productive ages</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Passed away</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Toddler</a>
                            </li>
                        </ul>
                    </div>

                    <div class="search-person">
                        <form class="form d-flex" role="search" action="#table" method="get">
                            <input
                                    id="searchPerson"
                                    name="searchPerson"
                                    class="form-control me-2 has-shadow"
                                    type="search"
                                    placeholder="Search..."
                                    aria-label="Search"
                                    required
                            />
                            <button
                                    type="submit"
                                    name="search-buttom"
                                    class="btn btn-outline-primary has-shadow"
                            >
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div class="scroll"> -->
            <!--            --><?php
            //            if (search($_POST["searchPerson"]) != 0) {
            //                for ($i = 0; $i < count($_POST["searchPerson"]); $i++) {
            //                }
            //            }
            //            ?>

            <div class="table-responsive">
                <table class="table-primary table-width" id="table">
                    <thead>
                    <tr class="test-color">
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <!--                    --><?php
                    //                    if (isset($_POST["searchPerson"])) {
                    //                        $persons = search($_GET["searchPerson"]);
                    //                    } else {
                    //                        $persons = loadDataFromJson("persons.json");
                    //                    }
                    //                    for ($i = 0;
                    //                         $i < count($persons);
                    //                         $i++) { ?>
                    <!--                        <tr>-->
                    <!--                            <td>--><?php //echo $i + 1 ?><!--</td>-->
                    <!--                            <td>--><?php //echo $persons[$i]["email"] ?><!--</td>-->
                    <!--                            <td>-->
                    <!--                                -->
                    <?php //echo $persons[$i]["firstName"] . " " . $persons[$i]["lastName"] ?><!--</td>-->
                    <!--                            <td>--><?php //echo $persons[$i]["role"] ?><!--</td>-->
                    <!---->
                    <!--                        <tr style="vertical-align: baseline">-->
                    <!--                            <th scope="row">1</th>-->
                    <!--                            <td>cahya@gmail.com</td>-->
                    <!--                            <td>Cahya</td>-->
                    <!--                            <td>ADMIN</td>-->
                    <!--                            <td>-->
                    <!--                                <div class="table-button">-->
                    <!--                                    <div class="text-end">-->
                    <!--                                        <a class="edit btn-table" href="edit-person.php">-->
                    <!--                                            <button type="button" class="btn btn-outline-primary">-->
                    <!--                                                Edit-->
                    <!--                                            </button>-->
                    <!--                                        </a>-->
                    <!--                                        <a class="view btn-table" href="view-person.php">-->
                    <!--                                            <button type="button" class="btn btn-outline-primary">-->
                    <!--                                                View-->
                    <!--                                            </button>-->
                    <!--                                        </a>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </td>-->
                    <!--                        </tr>-->

                    <tr style="vertical-align: baseline">
                        <th scope="row">1</th>
                        <td>cahya@gmail.com</td>
                        <td>Cahya</td>
                        <td>ADMIN</td>
                        <td>
                            <div class="table-button">
                                <div class="text-end">
                                    <a class="edit btn-table" href="edit-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            Edit
                                        </button>
                                    </a>

                                    <a class="view btn-table" href="view-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            View
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="vertical-align: baseline">
                        <th scope="row">2</th>
                        <td>Kumala@a.com</td>
                        <td>Kumala</td>
                        <td>MEMBER</td>
                        <td>
                            <div class="table-button">
                                <div class="text-end">
                                    <a class="edit btn-table" href="edit-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            Edit
                                        </button>
                                    </a>
                                    <a class="view btn-table" href="view-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            View
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="vertical-align: baseline">
                        <th scope="row">3</th>
                        <td>Ayong@gmail.com</td>
                        <td>Ayong</td>
                        <td>ADMIN</td>
                        <td>
                            <div class="table-button">
                                <div class="text-end">
                                    <a class="edit btn-table" href="edit-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            Edit
                                        </button>
                                    </a>

                                    <a class="view btn-table" href="view-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            View
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="vertical-align: baseline">
                        <th scope="row">4</th>
                        <td>Nilam@gmail.com</td>
                        <td>Nilam</td>
                        <td>MEMBER</td>
                        <td>
                            <div class="table-button">
                                <div class="text-end">
                                    <button type="button" class="btn btn-outline-primary">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-outline-primary">
                                        View
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="vertical-align: baseline">
                        <th scope="row">5</th>
                        <td>Shifa@gmail.com</td>
                        <td>Shifa</td>
                        <td>ADMIN</td>
                        <td>
                            <div class="table-button">
                                <div class="text-end">
                                    <a class="edit btn-table" href="edit-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            Edit
                                        </button>
                                    </a>

                                    <a class="view btn-table" href="view-person.php">
                                        <button type="button" class="btn btn-outline-primary">
                                            View
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!--                    --><?php //} ?>
                    </tbody>
                </table>
            </div>

            <div class="page-position">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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
</body>
</html>
