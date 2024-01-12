<?php
function showSidebar(string $personsNav = null,
                     string $dashboardNav = null,
                     string $editProfileNav = null):void
{
?>
  <div class="sidebar-content d-none d-lg-flex">
    <div
      class="offcanvas-body d-flex flex-column justify-content-between sidebar-background"
    >
      <nav class="main-nav main-nav-padding">
        <ul class="main-nav-list">
          <li>
            <a class="main-nav-link <?php echo $dashboardNav?>" href="dashboard.php">
              <ion-icon
                name="speedometer"
                role="img"
                class="md hydrated"
              ></ion-icon>
              Dashboard</a
            >
          </li>
          <li>
            <a class="main-nav-link <?php echo $personsNav?>" href="persons.php">
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
              class="main-nav-link <?php echo $editProfileNav?>"
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
          <h6><strong>mdo</strong></h6>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
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
<?php } ?>
