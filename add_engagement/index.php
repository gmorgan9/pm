<!DOCTYPE html>


<?php

require_once "../app/connection.php";
require_once "../path.php";
require_once "../app/functions.php";
session_start();

if(isset($_POST['add-engagement'])){

    $idno = rand(10000, 99999);

    while (true) {
        $select = "SELECT * FROM engagement WHERE idno = '$idno'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) == 0) {
            // ID doesn't exist, break out of the loop
            break;
        } else {
            // ID exists, generate a new one
            $idno = rand(10000, 99999);
        }
    }

    if(isset($_POST['client_name'])) {
      $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
  } else {
      $client_name = "";
  }

  if(isset($_POST['engagement_type'])) {
      $engagement_type = mysqli_real_escape_string($conn, $_POST['engagement_type']);
  } else {
      $engagement_type = "";
  }

  if(isset($_POST['status'])) {
      $status = mysqli_real_escape_string($conn, $_POST['status']);
  } else {
      $status = "";
  }

  if(isset($_POST['manager'])) {
      $manager = mysqli_real_escape_string($conn, $_POST['manager']);
  } else {
      $manager = "";
  }

  if(isset($_POST['senior'])) {
      $senior = mysqli_real_escape_string($conn, $_POST['senior']);
  } else {
      $senior = "";
  }

  if(isset($_POST['staff_1'])) {
      $staff_1 = mysqli_real_escape_string($conn, $_POST['staff_1']);
  } else {
      $staff_1 = "";
  }

  if(isset($_POST['staff_2'])) {
      $staff_2 = mysqli_real_escape_string($conn, $_POST['staff_2']);
  } else {
      $staff_2 = "";
  }

  if(isset($_POST['staff_3'])) {
      $staff_3 = mysqli_real_escape_string($conn, $_POST['staff_3']);
  } else {
      $staff_3 = "";
  }

  if(isset($_POST['review_start'])) {
      $review_start = mysqli_real_escape_string($conn, $_POST['review_start']);
  } else {
      $review_start = "";
  }

  if(isset($_POST['review_end'])) {
      $review_end = mysqli_real_escape_string($conn, $_POST['review_end']);
  } else {
      $review_end = "";
  }

  if(isset($_POST['as_of_date'])) {
      $as_of_date = mysqli_real_escape_string($conn, $_POST['as_of_date']);
  } else {
      $as_of_date = "";
  }

  if(isset($_POST['evidence_due_date'])) {
      $evidence_due_date = mysqli_real_escape_string($conn, $_POST['evidence_due_date']);
  } else {
      $evidence_due_date = "";
  }

  if(isset($_POST['scope_categories'])) {
    $selectedCategories = $_POST['scope_categories'];
    $scope_categories = implode(", ", $selectedCategories);
  } elseif(isset($_POST['scope_categories2'])) {
    $scope_categories = mysqli_real_escape_string($conn, $_POST['scope_categories2']);
  } else {
    $scope_categories = "";
  }

  if(isset($_POST['IRL_delivery_date'])) {
      $IRL_delivery_date = mysqli_real_escape_string($conn, $_POST['IRL_delivery_date']);
  } else {
      $IRL_delivery_date = "";
  }

  if(isset($_POST['IPC_date'])) {
      $IPC_date = mysqli_real_escape_string($conn, $_POST['IPC_date']);
  } else {
      $IPC_date = "";
  }

  if(isset($_POST['CPC_date'])) {
      $CPC_date = mysqli_real_escape_string($conn, $_POST['CPC_date']);
  } else {
      $CPC_date = "";
  }

  if(isset($_POST['fieldwork_call_start'])) {
      $fieldwork_call_start = mysqli_real_escape_string($conn, $_POST['fieldwork_call_start']);
  } else {
      $fieldwork_call_start = "";
  }

  if(isset($_POST['fieldwork_doc_start'])) {
      $fieldwork_doc_start = mysqli_real_escape_string($conn, $_POST['fieldwork_doc_start']);
  } else {
      $fieldwork_doc_start = "";
  }

  if(isset($_POST['closing_meeting_date'])) {
      $closing_meeting_date = mysqli_real_escape_string($conn, $_POST['closing_meeting_date']);
  } else {
      $closing_meeting_date = "";
  }

  if(isset($_POST['draft_date'])) {
      $draft_date = mysqli_real_escape_string($conn, $_POST['draft_date']);
  } else {
      $draft_date = "";
  }

  if(isset($_POST['CC_draft_date'])) {
      $CC_draft_date = mysqli_real_escape_string($conn, $_POST['CC_draft_date']);
  } else {
      $CC_draft_date = "";
  }

  if(isset($_POST['final_report_date'])) {
      $final_report_date = mysqli_real_escape_string($conn, $_POST['final_report_date']);
  } else {
      $final_report_date = "";
  }


    $insert = "INSERT INTO engagement (idno, client_name, engagement_type, status, manager, senior, staff_1, staff_2, staff_3, review_start, review_end, as_of_date, evidence_due_date, scope_categories, IRL_delivery_date, IPC_date, CPC_date, fieldwork_call_start, fieldwork_doc_start, closing_meeting_date, draft_date, CC_draft_date, final_report_date) VALUES ('$idno', NULLIF('$client_name',''), NULLIF('$engagement_type',''), NULLIF('$status',''), NULLIF('$manager',''), NULLIF('$senior',''), NULLIF('$staff_1',''), NULLIF('$staff_2',''), NULLIF('$staff_3',''), NULLIF('$review_start',''), NULLIF('$review_end',''), NULLIF('$as_of_date',''), NULLIF('$evidence_due_date',''), NULLIF('$scope_categories',''), NULLIF('$IRL_delivery_date',''), NULLIF('$IPC_date',''), NULLIF('$CPC_date',''), NULLIF('$fieldwork_call_start',''), NULLIF('$fieldwork_doc_start',''), NULLIF('$closing_meeting_date',''), NULLIF('$draft_date',''), NULLIF('$CC_draft_date',''), NULLIF('$final_report_date',''))";


    if (mysqli_query($conn, $insert)) {
        header('location: ../engagements/');
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}


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
    <!-- Main Content -->
    <div class="content" id="content" style="display: none;">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add an Engagement</li>
            </ol>
          </nav>

          <div class="pt-3"></div>
          <form action="" method="POST">


          <!-- start top -->
            <div class="row d-flex">
              <div class="col w-50">
                  <label>Client Name <span class="text-muted" style="font-size: 10px;">e.g "AARC-360"</span></label>
                  <input class="form-control" type="text" name="client_name">
              </div>
              <div class="col w-25">
                <label>Engagement Type</label>
                <select name="engagement_type" class="form-control">
                    <option value="">Select one...</option>
                    <option value="1">SOC 1 Type 1</option>
                    <option value="2">SOC 1 Type 2</option>
                    <option value="3">SOC 2 Type 1</option>
                    <option value="4">SOC 2 Type 2</option>
                    <option value="5">SOC 3 Type 1</option>
                    <option value="6">SOC 3 Type 2</option>
                </select>
              </div>
              <div class="col w-25">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Select one...</option>
                    <option value="1">Internal Planning Call</option>
                    <option value="2">Client Planning Call</option>
                    <option value="3">Fieldwork Calls</option>
                    <option value="4">Fieldwork Documentation</option>
                    <option value="5">Manager QA Review</option>
                    <option value="6">Executive QA Review</option>
                    <option value="7">Completed</option>
                </select>
              </div>
            </div>
          <!-- end top -->

        <div class="pt-3"></div>

        <!-- Start staff row -->
          <div class="row d-flex">

            <div class="col w-50">
              <label>Manager</label>
              <select name="manager" class="form-control">
                  <option value="">Select one...</option>
                  <?php
                  $query ="SELECT * FROM personnel where title = 'Manager'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name'] . ' ' . $option['last_name']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="col w-50">
              <label>Senior</label>
              <select style="" name="senior" class="form-control">
                  <option value="">Select one...</option>
                  <?php
                  $query ="SELECT * FROM personnel where title = 'Senior'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name'] . ' ' . $option['last_name']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="col w-25">
              <label>Staff 1</label>
              <select name="staff_1" class="form-control">
                  <option value="">Select one...</option>
                  <?php
                  $query ="SELECT * FROM personnel where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name'] . ' ' . $option['last_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
                      
            <div class="col w-25">
              <label>Staff 2</label>
              <select style="" name="staff_2" class="form-control">
                  <option value="">Select one...</option>
                  <?php
                  $query ="SELECT * FROM personnel where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name'] . ' ' . $option['last_name']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="col w-25">
              <label>Staff 3</label>
              <select name="staff_3" class="form-control">
                  <option value="">Select one...</option>
                  <?php
                  $query ="SELECT * FROM personnel where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name'] . ' ' . $option['last_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div> 
        <!-- end staff row -->

        <div class="pt-3"></div>

        <!-- Start review date row -->
          <div class="row d-flex">
            <div class="col w-50 p-3" style="border-top: 1px solid #8c8c8c; border-left: 1px solid #8c8c8c; border-bottom: 1px solid #8c8c8c;">
            <p style="margin-bottom: 0px;">Type 1 Engagement</p>
              <label>Review "as of" Date</label>
              <input class="form-control" type="date" name="as_of_date" value="">
            </div>
            <div class="col w-50 p-3" style="border-top: 1px solid #8c8c8c; border-left: 1px solid #8c8c8c; border-bottom: 1px solid #8c8c8c;">
            <p style="margin-bottom: 0px;">Type 2 Engagement</p>
              <label>Review Start Date</label>
              <input class="form-control" type="date" name="review_start" value="">
            </div>
            <div class="col w-50 p-3" style="border-top: 1px solid #8c8c8c; border-right: 1px solid #8c8c8c; border-bottom: 1px solid #8c8c8c;">
            <p style="color: #e3e3e3;margin-bottom: 0px;">.</p>
              <label>Review End Date</label>
              <input class="form-control" type="date" name="review_end" value="">
            </div>
          </div>
        <!-- end review date row -->

        <div class="pt-3"></div>

        <!-- start scope row -->
          <div class="alert alert-primary" role="alert">
            <i class="bi bi-exclamation-diamond-fill"></i>&nbsp;&nbsp;<strong>For SOC 2 engagements:</strong> Please select the categories in scope.
          </div>
          <label>Categories in Scope</label>
          <div>
                        
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="scope_categories[]" value="Security">
              <label class="form-check-label" for="inlineCheckbox1">Security</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="scope_categories[]" value="Availability">
              <label class="form-check-label" for="inlineCheckbox2">Availability</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="scope_categories[]" value="Confidentiality">
              <label class="form-check-label" for="inlineCheckbox3">Confidentiality</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="scope_categories[]" value="Privacy">
              <label class="form-check-label" for="inlineCheckbox3">Privacy</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="scope_categories[]" value="Processing Integrity">
              <label class="form-check-label" for="inlineCheckbox3">Processing Integrity</label>
            </div>
          </div>


          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Categories in Scope</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="scope_categories2" rows="3"></textarea>
          </div>
        <!-- end scope row -->

        <div class="pt-3"></div>

        <!-- Start enagement dates row -->
          <div class="row d-flex">
            <div class="col w-25">
              <label>IRL Delivery Date</label>
              <input class="form-control" type="date" name="IRL_delivery_date" value="">
            </div>
            <div class="col w-25">
              <label>Evidence Due Date</label>
              <input class="form-control" type="date" name="evidence_due_date" value="">
            </div>
            <div class="col w-25">
              <label>Internal Planning Call</label>
              <input class="form-control" type="date" name="IPC_date" value="">
            </div>
            <div class="col w-25">
              <label>Client Planning Call</label>
              <input class="form-control" type="date" name="CPC_date" value="">
            </div>
            <div class="col w-25">
              <label>Fieldwork Call Date</label>
              <input class="form-control" type="date" name="fieldwork_call_start" value="">
            </div>
          </div>

          <div class="pt-3"></div>

          <div class="row d-flex flex-wrap">
            <div class="col w-25">
              <label>Fieldwork Documentation Date</label>
              <input class="form-control" type="date" name="fieldwork_doc_start" value="">
            </div>
            <div class="col w-25">
              <label>Closing Meeting Date</label>
              <input class="form-control" type="date" name="closing_meeting_date" value="">
            </div>
            <div class="col w-25">
              <label>Draft Date</label>
              <input class="form-control" type="date" name="draft_date" value="">
            </div>
            <div class="col w-25">
              <label>Client Comment Date</label>
              <input class="form-control" type="date" name="CC_draft_date" value="">
            </div>
            <div class="col w-25">
              <label>Final Report Date</label>
              <input class="form-control" type="date" name="final_report_date" value="">
            </div>
          </div>
        <!-- end engagement dates row -->

        <div class="pt-3"></div>

        <!-- <div class="row d-flex">
          <div class="col w-100">
            <label>Engagement Notes</label>
            <textarea  name="myeditor" placeholder="Product Details" class="form-control" rows="8" cols="50"></textarea>
          </div>
        </div> -->
        <br>
        <input type="submit" name="add-engagement" value="Submit" class="btn btn-light btn-block"> &nbsp;
        <!-- <button class="btn btn-dark btn-block" onclick="window.history.go(-1); return false;">Go Back</button> -->
    </form>





    </div>


    <script src="../assets/scripts/dropdown.js?v=5.1.1"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <script>
    window.onload = function() {
        CKEDITOR.replace('myeditor');
    };
</script>
    


    <script>
    

    </script>
 
    
</body>
</html>
