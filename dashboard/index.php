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
    .timeline {
    list-style-type: none;
    margin: 0;
    padding: 0;
    position: relative
}

.timeline:before {
    content: '';
    position: absolute;
    top: 5px;
    bottom: 5px;
    width: 5px;
    background: #2d353c;
    left: 20%;
    margin-left: -2.5px
}

.timeline>li {
    position: relative;
    min-height: 50px;
    padding: 20px 0
}

.timeline .timeline-time {
    position: absolute;
    left: 0;
    width: 18%;
    text-align: right;
    top: 30px
}

.timeline .timeline-time .date,
.timeline .timeline-time .time {
    display: block;
    font-weight: 600
}

.timeline .timeline-time .date {
    line-height: 16px;
    font-size: 12px
}

.timeline .timeline-time .time {
    line-height: 24px;
    font-size: 16px;
    color: #242a30
}

.timeline .timeline-icon {
    left: 15%;
    position: absolute;
    width: 10%;
    text-align: center;
    top: 40px
}

.timeline .timeline-icon a {
    text-decoration: none;
    width: 15px;
    height: 15px;
    display: inline-block;
    border-radius: 20px;
    background: #2d353c;
    line-height: 10px;
    color: #fff;
    font-size: 10px;
    /* border: 5px solid #2d353c; */
    transition: border-color .2s linear
}

.timeline .timeline-body {
    margin-left: 20%;
    margin-right: 20%;
    /* background: #fff; */
    position: relative;
    padding: 20px 25px;
    border-radius: 6px
}

.timeline .timeline-body:before {
    content: '';
    display: block;
    position: absolute;
    border: 10px solid transparent;
    /* border-right-color: #fff; */
    left: -20px;
    top: 20px
}

.timeline .timeline-body>div+div {
    margin-top: 15px
}

.timeline .timeline-body>div+div:last-child {
    margin-bottom: -20px;
    padding-bottom: 20px;
    border-radius: 0 0 6px 6px
}

.timeline-header {
    line-height: 30px
}

.timeline-header .userimage {
    float: left;
    width: 34px;
    height: 34px;
    border-radius: 40px;
    overflow: hidden;
    margin: -2px 10px -2px 0
}

.timeline-header .title {
    font-size: 16px;
    font-weight: 600
}

.timeline-header .title,
.timeline-header .title a {
    color: #2d353c
}

.timeline-content {
    letter-spacing: .25px;
    line-height: 18px;
    font-size: 13px
}

.timeline-content:after,
.timeline-content:before {
    content: '';
    display: table;
    clear: both
}

.timeline-title {
    margin-top: 0
}

.timeline-footer {
    background: #fff;
    /* border-top: 1px solid #e2e7ec; */
    /* padding-top: 15px */
}

.timeline-footer a:not(.btn) {
    color: #575d63
}

.timeline-footer a:not(.btn):focus,
.timeline-footer a:not(.btn):hover {
    color: #2d353c
}

.timeline-likes {
    color: #6d767f;
    font-weight: 600;
    font-size: 12px
}

.timeline-likes .stats-right {
    float: right
}

.timeline-likes .stats-total {
    display: inline-block;
    line-height: 20px
}

.timeline-likes .stats-icon {
    float: left;
    margin-right: 5px;
    font-size: 9px
}

.timeline-likes .stats-icon+.stats-icon {
    margin-left: -2px
}

.timeline-likes .stats-text {
    line-height: 20px
}

.timeline-likes .stats-text+.stats-text {
    margin-left: 15px
}

.timeline-comment-box {
    background: #f2f3f4;
    margin-left: -25px;
    margin-right: -25px;
    padding: 20px 25px
}

.timeline-comment-box .user {
    float: left;
    width: 34px;
    height: 34px;
    overflow: hidden;
    border-radius: 30px
}

.timeline-comment-box .user img {
    max-width: 100%;
    max-height: 100%
}

.timeline-comment-box .user+.input {
    margin-left: 44px
}

.lead {
    margin-bottom: 20px;
    font-size: 21px;
    font-weight: 300;
    line-height: 1.4;
}

.text-danger, .text-red {
    color: #ff5b57!important;
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
            <div class="card" style="width: 65%; max-height: 800px; background-color: white !important; border: none; border-radius: 20px !important;">
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
            <div class="card" style="width: 35%; max-height: 800px; background-color: white !important; border: none; border-radius: 20px !important;">
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


                  <!-- timeline -->
                    <div class="container">
                      <ul class="timeline">
                        <?php
                          $current_date = date('Y-m-d');
                          $sql = "SELECT * FROM meetings WHERE date >= '$current_date' ORDER BY date ASC, start_time ASC LIMIT 3";
                          $result = mysqli_query($conn, $sql);
                          if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $meeting_id    = $row['meeting_id'];
                                $id            = $row['idno'];
                                $title         = $row['title'];
                                $status        = $row['status'];
                                $date          = $row['date'];
                                $f_date        = date("M d, Y", strtotime($date));
                                $start_time    = $row['start_time'];
                                $f_start_time  = date("h:i A", strtotime($start_time));
                                $end_time      = $row['end_time'];
                                $f_end_time    = date("h:i A", strtotime($end_time));
                                $eid           = $row['engagement_id'];
                                ?>
                        <li>
                          <div class="timeline-time me-3">
                            <span class="date"><?php echo $f_date; ?></span>
                            <span class="time"><?php echo $f_start_time; ?></span>
                          </div>
                          <div class="timeline-icon">
                            <a href="javascript:;">&nbsp;</a>
                          </div>
                          <div class="timeline-body">
                            <div class="timeline-header">
                              <span class="title"><a href="javascript:;"><?php echo $title; ?></a></span>
                            </div>
                            <div class="timeline-content">
                              <?php 
                                // Use a different variable for the second query result
                                $sql2 = "SELECT * FROM engagement WHERE engagement_id= $eid";
                                $result2 = mysqli_query($conn, $sql2);
                                if ($result2) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $client_name = $row2['client_name'];
                                    }
                                }
                              ?>
                              <p class="text-muted" style="margin-top: -15px;">
                                <?php echo $client_name; ?><br>
                                <?php echo $f_date; ?><br>
                                <?php echo $f_start_time . ' - ' . $f_end_time; ?>
                              </p>
                            </div>
                          </div>
                        </li>
                        <?php } } ?>
                      </ul>
                    </div>
                  <!-- end timeline -->


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
