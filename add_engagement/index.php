<!DOCTYPE html>


<?php

require_once "../app/connection.php";
require_once "../path.php";
session_start();

if(isset($_POST['add-engagement'])){
  $idno  = rand(10000, 99999); // figure how to not allow duplicates
  $short_title = mysqli_real_escape_string($conn, $_POST['short_title']);
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $author = mysqli_real_escape_string($conn, $_POST['author']);
  $category = mysqli_real_escape_string($conn, $_POST['category']);
  $tags = mysqli_real_escape_string($conn, $_POST['tags']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  $author_idno = mysqli_real_escape_string($conn, $_POST['author_idno']);
  $created_date = date("F j, Y");
  $created_time = date("g:i a");



  $select = " SELECT * FROM recipes WHERE title = '$title'";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

     $error[] = 'title already exist!';

  }else {
        $insert = "INSERT INTO recipes (idno, short_title, title, content, author, author_idno, category, tags, created_date, created_time) VALUES ('$idno', '$short_title', '$title','$content','$author','$author_idno','$category', '$tags', '$created_date', '$created_time')";
        mysqli_query($conn, $insert);
        header('location: all_recipes.php');
     }

};

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
<br><br>
          <form action="" method="POST">


        <div class="">
            <label>Client Name <span class="text-muted" style="font-size: 10px;">e.g "AARC-360"</span></label>
            <input class="form-control" type="text" name="client_name">
        </div>
        <!-- <div class="col w-50">
            <label>Short Title <span class="text-muted" style="font-size: 10px;">e.g "meatball-subs"</span></label>
            <input class="form-control" type="text" name="short_title">
        </div> -->


        <div class="pt-3"></div>

        <!-- Start type row -->
          <div class="row d-flex">

            <div class="col w-50">
              <label>Engagement Type</label>
              <select name="engagement_type" class="form-control">
                  <option value="0">Select one...</option>
                  <option value="1">SOC 1 Type 1</option>
                  <option value="2">SOC 1 Type 2</option>
                  <option value="3">SOC 2 Type 1</option>
                  <option value="4">SOC 2 Type 2</option>
                  <option value="5">SOC 3 Type 1</option>
                  <option value="6">SOC 3 Type 2</option>
              </select>
            </div>

            <div class="col w-50">
              <label>Status</label>
              <select name="status" class="form-control">
                  <option value="0">Select one...</option>
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
        <!-- end type row -->

        <div class="pt-3"></div>

        <!-- Start manager,senior row -->
          <div class="row d-flex">

            <div class="col w-50">
              <label>Manager</label>
              <select name="manager" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Manager'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="col w-50">
              <label>Senior</label>
              <select style="" name="senior" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Senior'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div> 
        <!-- end manager,senior row -->

        <div class="pt-3"></div>

        <!-- Start staff row -->
          <div class="row d-flex">

            <div class="col w-25">
              <label>Staff 1</label>
              <select name="staff_1" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
                      
            <div class="col w-25">
              <label>Staff 2</label>
              <select style="" name="staff_2" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="col w-25">
              <label>Staff 3</label>
              <select name="staff_3" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div> 
        <!-- end staff row -->

        <div class="pt-3"></div>

        <!-- Start staff row -->
          <div class="row d-flex">

          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Type 2</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Type 1</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0" style="height: 100px;">
              <div class="row d-flex align-items-center">
                <div class="col w-50">
                  <label>Review End Date</label>
                  <input class="form-control" type="date" name="review_end">
                </div>
                <div class="col w-50">
                  <div class="alert alert-primary" role="alert">
                    Only given an "as of date" because of a type 1 engagement.
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0" style="height: 100px;">
            <div class="row d-flex">
                <div class="col w-50">
                  <label>Review Start Date</label>
                  <input class="form-control" type="date" name="review_start">
                </div>          
                <div class="col w-50">
                  <label>Review End Date</label>
                  <input class="form-control" type="date" name="review_end">
                </div>
              </div>
            </div>
          </div>



            
                      
            <div class="col w-25">
              <label>Staff 2</label>
              <select style="" name="staff_2" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>

            <div class="col w-25">
              <label>Staff 3</label>
              <select name="staff_3" class="form-control">
                  <option value="none">Select one...</option>
                  <?php
                  $query ="SELECT * FROM team_members where title = 'Staff'";
                  $result = $conn->query($query);
                  if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                  }
                  ?>
                  <?php 
                      foreach ($options as $option) {
                  ?>
                  <option value="<?php echo $option['idno']; ?>"><?php echo $option['first_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div> 
        <!-- end staff row -->


        <div class="pt-3"></div>
        <div>
            <label>Tags</label>
            <input class="form-control" style="width: 99%;" type="text" name="tags">
        </div>
        <br>
        <textarea name="content" id="content" style="width: 99%;"></textarea>
        <input type="hidden" name="author" value="<?php echo $firstname; ?>&nbsp;<?php echo $lastname; ?>">
        <br>
        <input type="submit" name="add" value="Submit" class="btn btn-light btn-block"> &nbsp;
        <!-- <button class="btn btn-dark btn-block" onclick="window.history.go(-1); return false;">Go Back</button> -->
    </form>





    </div>


    <script src="../assets/scripts/dropdown.js?v=5.1.1"></script>
    


    <script>
    

    </script>
 
    
</body>
</html>
