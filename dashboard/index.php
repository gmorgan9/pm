<!DOCTYPE html>

<?php
date_default_timezone_set('America/Denver');

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

    <style>
    /* Remove background color for the table */
    table.custom-table.table {
        background-color: transparent !important; /* Set background color to transparent */
    }
</style>
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

          <!-- Projects Card -->
            <div class="card" style="width: 65%; height: 800px; background-color: white !important; border: none; border-radius: 20px !important;">
              <div class="card-body">
                  <p class="card-text float-start" style="font-size: 28px;">Projects</p>
                  <p class="card-text float-end" style="font-size: 20px;"><?php $currentDate = date('F d, Y'); echo $currentDate; ?></p>
                
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

                  <div class="mt-3"></div>

                  <!-- table -->
                      <table class="table table-default table-hover" style="background-color: transparent;">
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
                                          $engagement_id    = $row['engagement_id'];
                                          $id              = $row['idno'];
                                          $client_name      = $row['client_name'];
                                          $status      = $row['status'];
                                          $review_start           = $row['review_start'];
                                          $f_review_start = date("M d, Y", strtotime($review_start));
                                          $review_end           = $row['review_end'];
                                          $f_review_end = date("M d, Y", strtotime($review_end));
                                          $as_of_date           = $row['as_of_date'];
                                          $f_as_of_date = date("M d, Y", strtotime($as_of_date));
                          ?>
                          <tr>
                              <th scope="row"><?php echo $id; ?></th>
                              <td><?php echo $client_name; ?></td>
                              <td>
                              <?php
                                if ($status == 1) {
                                  echo "Internal Planning Call";
                                } elseif($status == 2) {
                                  echo "Client Planning Call";
                                } elseif($status == 3) {
                                  echo "Fieldwork Calls";
                                } elseif($status == 4) {
                                  echo "Fieldwork Documentation";
                                } elseif($status == 5) {
                                  echo "Manager QA Review";
                                } elseif($status == 6) {
                                  echo "Executive QA Review";
                                } elseif($status == 7) {
                                  echo "Completed";
                                } else { ?>
                                  <span class="badge text-bg-warning">Not Set</span>
                                <?php
                                }
                                ?>
                              </td>
                              <td>
                                <?php 
                                if (!empty($as_of_date)) {
                                    echo $f_as_of_date;
                                } elseif (!empty($review_start)) {
                                    echo $f_review_start . ' - ' . $f_review_end;
                                } else { ?>
                                  <span class="badge text-bg-warning">Not Set</span>
                                <?php
                                }
                                ?>
                              </td>
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
                      
                    
                  <!-- end table -->

                
              </div>
              <?php
                // Pagination links
                $sql = "SELECT COUNT(*) as total FROM engagement";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $total_pages = ceil($row["total"] / $limit);
                  echo '<ul class="pagination justify-content-center mb-3">';
                  for ($i = 1; $i <= $total_pages; $i++) {
                      $active = ($page == $i) ? "active" : "";
                      echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                  }
                  echo '</ul>';
              ?>
            </div>
          <!-- end project card -->

          <!-- start Meetings Card -->
            <div class="card" style="width: 35%; background-color: white !important; border: none; border-radius: 20px !important;">
              <div class="card-body">
                <p class="card-text" style="font-size: 28px;">Meetings</p>

                  <div class="mt-4"></div>

                  <!-- stats -->
                    <div class="d-flex">
                      <span class="1 me-4">
                        <h5 style="margin-bottom: 0;">
                          02
                        </h5>
                        <p class="text-muted">
                          Upcoming
                        </p>
                      </span>
                      <span class="2 me-4">
                        <h5 style="margin-bottom: 0;">
                          03
                        </h5>
                        <p class="text-muted">
                          Today
                        </p>
                      </span>
                      <!-- <span class="2 me-4">
                        <h5 style="margin-bottom: 0;">
                          36
                        </h5>
                        <p class="text-muted">
                          Total Projects
                        </p>
                      </span> -->
                    </div>
                  <!-- end stats -->











                  <div class="container">
   <ul class="timeline">
      <li>
         <!-- begin timeline-time -->
         <div class="timeline-time">
            <span class="date">today</span>
            <span class="time">04:20</span>
         </div>
         <!-- end timeline-time -->
         <!-- begin timeline-icon -->
         <div class="timeline-icon">
            <a href="javascript:;">&nbsp;</a>
         </div>
         <!-- end timeline-icon -->
         <!-- begin timeline-body -->
         <div class="timeline-body">
            <div class="timeline-header">
               <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></span>
               <span class="username"><a href="javascript:;">John Smith</a> <small></small></span>
               <span class="pull-right text-muted">18 Views</span>
            </div>
            <div class="timeline-content">
               <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc faucibus turpis quis tincidunt luctus.
                  Nam sagittis dui in nunc consequat, in imperdiet nunc sagittis.
               </p>
            </div>
            <div class="timeline-likes">
               <div class="stats-right">
                  <span class="stats-text">259 Shares</span>
                  <span class="stats-text">21 Comments</span>
               </div>
               <div class="stats">
                  <span class="fa-stack fa-fw stats-icon">
                  <i class="fa fa-circle fa-stack-2x text-danger"></i>
                  <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                  </span>
                  <span class="fa-stack fa-fw stats-icon">
                  <i class="fa fa-circle fa-stack-2x text-primary"></i>
                  <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                  </span>
                  <span class="stats-total">4.3k</span>
               </div>
            </div>
            <div class="timeline-footer">
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
            </div>
            <div class="timeline-comment-box">
               <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar6.png"></div>
               <div class="input">
                  <form action="">
                     <div class="input-group">
                        <input type="text" class="form-control rounded-corner" placeholder="Write a comment...">
                        <span class="input-group-btn p-l-10">
                        <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
                        </span>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- end timeline-body -->
      </li>
      <li>
         <!-- begin timeline-time -->
         <div class="timeline-time">
            <span class="date">24 February 2014</span>
            <span class="time">08:17</span>
         </div>
         <!-- end timeline-time -->
         <!-- begin timeline-icon -->
         <div class="timeline-icon">
            <a href="javascript:;">&nbsp;</a>
         </div>
         <!-- end timeline-icon -->
         <!-- begin timeline-body -->
         <div class="timeline-body">
            <div class="timeline-header">
               <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></span>
               <span class="username">Richard Leong</span>
               <span class="pull-right text-muted">1,282 Views</span>
            </div>
            <div class="timeline-content">
               <p class="lead">
                  <i class="fa fa-quote-left fa-fw pull-left"></i>
                  Quisque sed varius nisl. Nulla facilisi. Phasellus consequat sapien sit amet nibh molestie placerat. Donec nulla quam, ullamcorper ut velit vitae, lobortis condimentum magna. Suspendisse mollis in sem vel mollis.
                  <i class="fa fa-quote-right fa-fw pull-right"></i>
               </p>
            </div>
            <div class="timeline-footer">
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
            </div>
         </div>
         <!-- end timeline-body -->
      </li>
      <li>
         <!-- begin timeline-time -->
         <div class="timeline-time">
            <span class="date">10 January 2014</span>
            <span class="time">20:43</span>
         </div>
         <!-- end timeline-time -->
         <!-- begin timeline-icon -->
         <div class="timeline-icon">
            <a href="javascript:;">&nbsp;</a>
         </div>
         <!-- end timeline-icon -->
         <!-- begin timeline-body -->
         <div class="timeline-body">
            <div class="timeline-header">
               <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></span>
               <span class="username">Lelouch Wong</span>
               <span class="pull-right text-muted">1,021,282 Views</span>
            </div>
            <div class="timeline-content">
               <h4 class="template-title">
                  <i class="fa fa-map-marker text-danger fa-fw"></i>
                  795 Folsom Ave, Suite 600 San Francisco, CA 94107
               </h4>
               <p>In hac habitasse platea dictumst. Pellentesque bibendum id sem nec faucibus. Maecenas molestie, augue vel accumsan rutrum, massa mi rutrum odio, id luctus mauris nibh ut leo.</p>
               <p class="m-t-20">
                  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
               </p>
            </div>
            <div class="timeline-footer">
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
               <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
            </div>
         </div>
         <!-- end timeline-body -->
      </li>
      <li>
         <!-- begin timeline-icon -->
         <div class="timeline-icon">
            <a href="javascript:;">&nbsp;</a>
         </div>
         <!-- end timeline-icon -->
         <!-- begin timeline-body -->
         <div class="timeline-body">
            Loading...
         </div>
         <!-- begin timeline-body -->
      </li>
   </ul>
</div>













              </div>
            </div>
          <!-- end meetings card -->

          </div>






          
    </div>


    <script src="../assets/scripts/dropdown.js?v=5.1.1"></script>
    


    <script>
    

    </script>
 
    
</body>
</html>
