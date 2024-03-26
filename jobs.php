<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit(); // Terminate script execution after the redirect
}
require_once __DIR__ . "/action/utils-action.php";
require_once __DIR__ . "/include/header.php";
require_once __DIR__ . "/action/jobs-action.php";
?>

<?php
showHeader("Jobs-PMA", "jobs.css", jobsNav: "jobs-nav-link");
?>

<main>
  <section class="section-jobs">
    <?php
    require_once __DIR__ . "/include/sidebar.php";
    showSidebar(jobsNav: "jobs-nav-link");
    ?>
    <div class="main-content">
      <div class="content-header-box d-flex justify-content-between">
        <h3 class="content-title-jobs">Jobs</h3>
        <div class="add-button">
          <?php if (checkRole($_SESSION['email']) != null) : ?>
            <button type="button" class="btn btn-outline-primary btn-add">
              <a class="add" href="add-jobs.php">
                +Add
              </a>
            </button>
          <?php else: ?>
            <button type="button" class="btn btn-outline-primary btn-add">
              <a class="add" href="jobs.php?error=add">
                +Add
              </a>
            </button>
          <?php endif; ?>
        </div>
      </div>
      <?php if (isset($_GET['error']) && $_GET['error'] == "add"): ?>
        <div class="alert alert-danger" role="alert">
          Only admin roles can add new jobs data.
        </div>
      <?php endif; ?>
      <div class="search-box">
        <nav class="navbar bg-body-tertiary has-shadow-grey">
          <div class="container-fluid">
            <a class="navbar-brand">
              <ion-icon name="clipboard-outline"></ion-icon>
            </a>
            <form class="form d-flex" role="search" name="search-form" method="get" action="#table">
              <input
                  class="form-control me-2"
                  type="search"
                  placeholder="Search..."
                  aria-label="Search"
                  name="search"
                  value="<?php if (isset($_GET["search"])):
                    echo $_GET["search"];
                  endif;
                  ?>">
              
              <?php if (isset($_GET['search'])): ?>
                <a href="jobs.php">
                  <button
                      type="button"
                      class="btn btn-outline-primary reset-btn"
                  >
                    Reset
                  </button>
                </a>
              <?php endif; ?>
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
          </div>
        </nav>
      </div>
      <div class="table-responsive">
        <table class="table-primary table-width has-shadow-grey" id="table">
          <?php
          
          if ($_GET['page'] < 1):
            $page = 1;
          elseif (isset($_GET['page']) && !is_numeric($_GET['page'])):
            $page = 1;
          else :
            $page = $_GET['page'];
          endif;
          $limit = 5;
          $previous = $page - 1;
          $next = $page + 1;
          $data = paginatedJobsData($_GET["search"], $page, $limit);
          if ($_GET['page'] > $data[PAGING_TOTAL_PAGE]){
            $page = 1;
            $data = paginatedJobsData($_GET["search"], $page, $limit);
          }
          $number = ($page - 1) * $limit + 1;
          $jobsData = $data[PAGING_DATA];
          ?>
          <thead>
          <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Jobs</th>
            <th scope="col" class="text-center">Count</th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody>
          <?php
          if (count($jobsData) != 0):
            for ($i = 0; $i < count($jobsData); $i++) :
              $_SESSION['id'] = $jobsData[$i]['id'];
              ?>
              <tr>
                <th scope="row" class="text-center"><?php echo $number++ ?></th>
                <td class="text-center"><?php echo ucfirst($jobsData[$i]["job_name"]) ?></td>
                <td class="text-center"><?php
                  if ($jobsData[$i]["count"] == null) :
                    echo "-";
                  else :
                    echo $jobsData[$i]["count"];
                  endif;
                  ?></td>
                <td class="text-end">
                  <div class="table-button">
                    <?php if (checkRole($_SESSION['email']) != null) : ?>
                      <a class="edit btn-table" href="edit-jobs.php?id=<?php echo $jobsData[$i]['id'] ?>">
                        <button type="button" class="btn btn-outline-primary" name="btn-edit">Edit
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                          </svg>
                        </button>
                      </a>
                    <?php else: ?>
                      <a class="edit btn-table" href="jobs.php?error=edit">
                        <button type="button" class="btn btn-outline-primary" name="btn-edit">Edit
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                          </svg>
                        </button>
                      </a>
                    <?php endif; ?>

                    <!-- Modal (delete jobs) -->
                    <?php if (checkRole($_SESSION['email']) != null) : ?>
                      <button
                          type="reset"
                          class="btn btn-secondary btn-delete"
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal<?= $jobsData[$i]['id'] ?>"
                      > Delete
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                      </button>
                    <?php else: ?>
                      <a class="view btn-table" href="jobs.php?error=delete">
                        <button type="button" class="btn btn-outline-primary btn-delete" name="btn-delete">Delete
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                          </svg>
                        </button>
                      </a>
                    <?php endif; ?>
                    <div
                        class="modal fade"
                        id="exampleModal<?= $jobsData[$i]["id"] ?>"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                    >
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <p class="modal-title" id="exampleModalLabel">
                              <?php if ($jobsData[$i]['count'] != null): ?>
                                This jobs data has been used!
                              <?php else : ?>
                                Are you sure want to delete this jobs?
                              <?php endif; ?>
                            </p>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                          </div>
                          <div class="modal-footer">
                            <?php
                            if ($jobsData[$i]['count'] != null):
                              ?>
                              <button
                                  type="button"
                                  class="btn btn-secondary btn-block"
                                  data-bs-dismiss="modal"
                              >
                                Back
                              </button>
                            <?php else: ?>
                              <button
                                  type="button"
                                  class="btn btn-secondary btn-block"
                                  data-bs-dismiss="modal"
                              >
                                No
                              </button>
                              <button
                                  type="button"
                                  class="btn btn-primary confirm"
                              >
                                <a class="link-confirm"
                                   href="action/delete-jobs-action.php?id=<?php echo $jobsData[$i]['id'] ?>">
                                  Yes
                                </a>
                              </button>
                            <?php endif; ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php
            endfor;
          endif;
          ?>
          </tbody>
        </table>
        
        <?php
        if (count($jobsData) == 0) :
          ?>
          <div class="alert alert-danger" role="alert">
            Jobs data was not found!!!
          </div>
        <?php elseif (isset($_GET['deleted'])): ?>
          <div class="alert alert-success" role="alert">
            Jobs data has been deleted.
          </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == "edit") : ?>
          <div class="alert alert-danger" role="alert">
            Only admin roles can change jobs data.
          </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == "delete") : ?>
          <div class="alert alert-danger" role="alert">
            Only admin roles can remove jobs data.
          </div>
        <?php elseif (isset($_GET['changed'])): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['changedJobs'] ?>
          </div>
        <?php elseif (isset($_GET['success'])): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['info'] ?>
          </div>
        <?php endif; ?>
        <div class="page-navigation-position">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              
              <?php
              if (isset($_GET["search"])):
                $search = "?search" . $_GET["search"] . "&";
              else :
                $search = "?";
              endif;
              ?>
              
              <?php
              if ($data[PAGING_TOTAL_PAGE] >= $_GET['page'] && $page > 1):
                ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo $search ?>page=<?php echo $previous ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php endif; ?>
              
              <?php
              for ($x = 1; $x <= $data[PAGING_TOTAL_PAGE]; $x++) :
                ?>
                <li class="page-item"><a class="page-link"
                                         href="<?php echo $search ?>page=<?php echo $x ?>"><?php echo $x ?></a></li>
              <?php endfor; ?>
              <?php
              if ($page < $data[PAGING_TOTAL_PAGE]) :
                ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo $search ?>page=<?php echo $next ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
require_once __DIR__ . "/include/footer.php";
?>
