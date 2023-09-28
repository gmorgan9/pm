<!DOCTYPE html>

<?php

require_once "../app/connection.php";
require_once "../path.php";
session_start();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagements - ProjectManager</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

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
    <!-- Main Content -->
    <div class="content" id="content" style="display: none;">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Engagements</li>
            </ol>
          </nav>



          <div class="container-fluid main">

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Client Name</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
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
                                $id               = $row['idno'];
                                $status           = $row['status'];
                                $client_name      = $row['client_name'];
                                $engagement_type  = $row['engagement_type'];
                                // $location       = $row['location'];
                                // $created_at     = $row['created_at'];
                                // $created_at = $row['created_at'];
                                // $utc_date_time = new DateTime($created_at, new DateTimeZone('UTC'));
                                // $local_date_time = $utc_date_time->setTimezone(new DateTimeZone('America/Denver'));
                                // $formatted_date = $local_date_time->format('M d, Y');
                ?>
                <tr>
                    <th scope="row"><?php echo $id; ?></th>
                    <td><?php echo $client_name ? $client_name : '-'; ?></td>
                    <td>
                        <?php
                        if ($engagement_type == 1) {
                          echo "SOC 1 Type 1";
                        } elseif($engagement_type == 2) {
                          echo "SOC 1 Type 2";
                        } elseif($engagement_type == 3) {
                          echo "SOC 2 Type 1";
                        } elseif($engagement_type == 4) {
                          echo "SOC 2 Type 2";
                        } elseif($engagement_type == 5) {
                          echo "SOC 3 Type 1";
                        } elseif($engagement_type == 6) {
                          echo "SOC 3 Type 2";
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
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
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                    <!-- <td><?php //echo $formatted_date ? $formatted_date : '-'; ?></td> -->
                    <!-- <td><?php //echo $status ? $status : '-'; ?></td> -->
                    <td style="font-size: 20px;"><a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $id; ?>" class="view"><i class="bi bi-eye text-success"></i></a> &nbsp; <a href="update-app.php?updateid=<?php echo $id; ?>"><i class="bi bi-pencil-square" style="color:#005382;"></a></i> &nbsp; <a href="open-app.php?appid=<?php echo $id; ?>" class="delete"><i class="bi bi-trash" style="color:#941515;"></i></a></td>
                </tr>


                <!-- VIEW Modal -->
                    <!-- <div class="modal fade" id="viewModal<?php //echo $id; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel">View Application</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                <?php
                                            // $new = "SELECT * FROM applications WHERE appid=$id";
                                            // $new1 = mysqli_query($conn, $new);
                                            // if($new1) {
                                            //     while ($cap = mysqli_fetch_assoc($new1)) {       
                                        ?> 
                                    <div>
                                        <h5 class="float-start">Job Details</h5>
                                        <div class="float-end">
                                            <?php //if($cap['watchlist'] == 1){ ?>
                                                <i class="bi bi-eye text-muted"></i>
                                            <?php //} else {} ?>
                                            <?php// if($cap['interview_set'] == 1){ ?>
                                                <i class="bi bi-people"></i>
                                            <?php //} else {} ?>
                                        </div>
                                    </div>

                                    <br>
                                    
                                    <hr>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Status</p> 
                                       <?php //if($cap['status'] == 'Applied'){ ?>
                                            <p><span class="float-end"><i style="font-size: 12px; margin-top: -5px;" class="bi bi-circle-fill text-primary"></i> &nbsp; <?php //echo $cap['status']; ?></span></p>
                                        <?php //} else if($cap['status'] == 'Interviewed') { ?>
                                            <p><span class="float-end"><i style="font-size: 12px; margin-top: -5px;" class="bi bi-circle-fill text-info"></i> &nbsp; <?php //echo $cap['status']; ?></span></p>
                                        <?php //} else if($cap['status'] == 'Offered') { ?>
                                            <p><span class="float-end"><i style="font-size: 12px; margin-top: -5px;" class="bi bi-circle-fill text-success"></i> &nbsp; <?php //echo $cap['status']; ?></span></p>
                                        <?php //} else if($cap['status'] == 'Rejected') { ?>
                                            <p><span class="float-end"><i style="font-size: 12px; margin-top: -5px;" class="bi bi-circle-fill text-danger"></i> &nbsp; <?php //echo $cap['status']; ?></span></p>
                                        <?php //} ?>
                                    </div>
                                    <br>
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
                                    <br>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Job Type</p> 
                                       <p><span class="float-end"><?php //echo $cap['job_type']; ?></span></p>
                                    </div>
                                    <br>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Base Pay</p> 
                                       <p><span class="float-end"><?php //echo $cap['pay']; ?></span></p>
                                    </div>
                                    <br>
                                    <div class="ms-3 me-3">
                                       <p class="float-start fw-bold">Bonus Pay</p> 
                                       <p><span class="float-end"><?php //echo $cap['bonus_pay']; ?></span></p>
                                    </div>
                                    <br><br>
                                    <div class="ms-3 me-3">
                                       <p class="fw-bold">Notes</p> 
                                       <p><span><?php //echo $cap['notes']; ?></span></p>
                                    </div>
                                    

                                    <?php //} } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
            $sql = "SELECT COUNT(*) as total FROM enagement";
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


    <script src="../assets/scripts/dropdown.js?v=5.1.1"></script>
    


    <script>
    

    </script>
 
    
</body>
</html>
