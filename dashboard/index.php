<!DOCTYPE html>

<?php

require_once "../app/connection.php";
require_once "../path.php";
require_once "../app/functions.php";
session_start();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ProjectManager</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../assets/scripts/timeout.js?v=3.0"></script>
</head>
<body style="background-color: #e3e3e3;" >

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;" id="spinner-group">
        <div class="spinner-grow" style="width: 3rem; height: 3rem; background-color: rgb(172, 202, 83);" role="status" id="spinner-item-1">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow" style="width: 3rem; height: 3rem; margin-left: -15px; background-color: rgb(23, 62, 71);" role="status" id="spinner-item-2">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow" style="width: 3rem; height: 3rem; margin-left: -15px; background-color: rgb(172, 202, 83);" role="status" id="spinner-item-3">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div class="spinner-grow" style="width: 3rem; height: 3rem; margin-left: -15px; background-color: rgb(23, 62, 71);" role="status" id="spinner-item-4">
            <span class="visually-hidden">Loading...</span>
          </div>
    </div>
    

    <?php include("../includes/sidebar.php"); ?>
    

    <!-- Main Content -->
    <div class="content" id="content" style="display: none;">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>


          <div class="d-flex">

            <div class="card" style="width: 65%;">
              <div class="card-body">
                  <p class="card-text float-start" style="font-size: 28px;">Projects</p>
                  <p class="card-text float-end" style="font-size: 20px;">September 28, 2023</p>
                
                  <div class="mt-5"></div>

                  <!-- stats -->
                    <div class="d-flex" style="margin-top: 80px !important;">
                      <span class="1 me-4">
                        <h5 style="margin-bottom: 0;">
                          14
                        </h5>
                        <p class="text-muted">
                          Upcoming
                        </p>
                      </span>
                      <span class="2 me-4">
                        <h5 style="margin-bottom: 0;">
                          22
                        </h5>
                        <p class="text-muted">
                          In Progress
                        </p>
                      </span>
                      <span class="2 me-4">
                        <h5 style="margin-bottom: 0;">
                          36
                        </h5>
                        <p class="text-muted">
                          Total Projects
                        </p>
                      </span>
                    </div>
                  <!-- end stats -->

                  <!-- table -->
                    <div class="container-fluid main">

                      <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID Number</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Review Period</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <?php
                              // Pagination variables
                              $limit = 10; // Number of entries per page
                              $page = isset($_GET['page']) ? $_GET['page'] : 1;
                              $offset = ($page - 1) * $limit;

                              $sql = "SELECT * FROM engagement ORDER BY created_at ASC LIMIT $limit OFFSET $offset";
                              $result = mysqli_query($conn, $sql);
                              if($result) {
                                  $num_rows = mysqli_num_rows($result);
                                  if($num_rows > 0) {
                                      while ($row = mysqli_fetch_assoc($result)) {
                                          $personnel_id    = $row['personnel_id'];
                                          $id              = $row['idno'];
                                          $name            = $row['first_name'] . ' ' . $row['last_name'];
                                          $title           = $row['title'];
                          ?>
                          <tr>
                              <th scope="row"><?php echo $id; ?></th>
                              <td><?php echo $name; ?></td>
                              <td><?php echo $title; ?></td>
                              <td style="font-size: 20px;"> 
                              <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $id; ?>" class="view"><i class="bi bi-eye text-success"></i></a> 
                          </tr>

                          <!-- VIEW Modal -->
                    <div class="modal fade" id="viewModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">View Engagement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                <?php
                                            $new = "SELECT * FROM engagement WHERE idno=$id";
                                            $new1 = mysqli_query($conn, $new);
                                            if($new1) {
                                                while ($cap = mysqli_fetch_assoc($new1)) {       
                                        ?> 
                                    <div>
                                        <h5 class="float-start">Engagement Details</h5>
                                        <div class="float-end">
                                            <?php if($cap['status'] == 1){ ?>
                                              <span class="badge text-bg-primary">Internal Planning Call</span>
                                            <?php } elseif($cap['status'] == 2) { ?>
                                              <span class="badge text-bg-secondary">Client Planning Call</span>
                                            <?php } elseif($cap['status'] == 3) { ?>
                                              <span class="badge text-bg-danger">Fieldwork Calls</span>
                                            <?php } elseif($cap['status'] == 4) { ?>
                                              <span class="badge text-bg-warning">Fieldwork Documentation</span>
                                            <?php } elseif($cap['status'] == 5) { ?>
                                              <span class="badge text-bg-dark">Manager QA Review</span>
                                            <?php } elseif($cap['status'] == 6) { ?>
                                              <span class="badge text-bg-info">Executive QA Review</span>
                                            <?php } elseif($cap['status'] == 7) { ?>
                                              <span class="badge text-bg-success">Completed</span>
                                            <?php } else {} ?>
                                        </div>
                                    </div>

                                    <br>
                                    
                                    <hr>
                                    
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Job Title</p> 
                                       <p><span class="float-end"><?php //echo $cap['job_title']; ?></span></p>
                                    </div>
                                    <br>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Company</p> 
                                       <p><span class="float-end"><?php //echo $cap['company']; ?></span></p>
                                    </div>
                                    <br>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Location</p>
                                       <p><span class="float-end"><?php //echo $cap['location']; ?></span></p>
                                    </div>
                                    <br>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Application Link</p> 
                                       <p><a target="_blank" href="<?php //echo $cap['app_link']; ?>" class="float-end">Link Here</a></p>
                                    </div>
                                    
                                    

                                    <?php } } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- end VIEW Modal -->


                          <?php
                                  }
                              }
                          }
                          ?>
                        </tbody>
                      </table>

                      <br>
                      <?php
                          // Pagination links
                          $sql = "SELECT COUNT(*) as total FROM personnel";
                          $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          $total_pages = ceil($row["total"] / $limit);

                              echo '<ul class="pagination justify-content-center">';
                              for ($i = 1; $i <= $total_pages; $i++) {
                                  $active = ($page == $i) ? "active" : "";
                                  echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                              }
                              echo '</ul>';
                      ?>
                    </div>
                  <!-- end table -->

                
              </div>
            </div>

            <div class="card" style="width: 35%">
              <div class="card-body">
                <p class="card-text" style="font-size: 20px;">Projects</p>
                <h5 class="card-title" style="font-size: 65px;">
                  25
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">2 Completed</h6>
              </div>
            </div>

          </div>






          
    </div>


    <script src="../assets/scripts/dropdown.js?v=5.1.1"></script>
    


    <script>
    

    </script>
 
    
</body>
</html>
