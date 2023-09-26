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

          <form action="" method="POST">
      <input class="form-control" type="hidden" name="author_idno" value="<?php echo $idno;?>">
        <div class="modal_help float-end" style="margin-right: 25px; margin-top: -55px !important;">
          <!-- Button trigger modal -->
            <button type="button" style="background: none; color: inherit; border: none; cursor: pointer; outline: inherit;" class="badge text-bg-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Instructions
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Instructions</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-black">
                    Things you will want to pay attention to while creating a new recipe for our blog. If you have any questions, please reach out via email, I will try and get back to you all as soon as possible.
                    <ul>
                      <li>For all images wanting to be insertted, please have a link for your image ready. a useful site to help you get a link for images would be: <a href="https://postimages.org" target="_blank">https://postimages.org</a>.</li>
                        <li>Sizes for images to fit inside of blog block.</li>
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary text-black">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>




        </div>
        <div class="row">
        <div class="col w-50">
            <label>Recipe Title <span class="text-muted" style="font-size: 10px;">e.g "Meatball Subs"</span></label>
            <input class="form-control" type="text" name="title">
        </div>
        <div class="col w-50">
            <label>Short Title <span class="text-muted" style="font-size: 10px;">e.g "meatball-subs"</span></label>
            <input class="form-control" type="text" name="short_title">
        </div>
        </div>
        <div class="pt-3"></div>

        <!-- Start row -->
          <div class="row d-flex">

            <div class="col w-50">
              <label>Manager</label>
              <select name="category" class="form-control">
                  <option value="">Select one...</option>
                  <option value="none">None</option>
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
              <label>Manager</label>
              <select style="width: 25%;" name="category" class="form-control">
                  <option value="">Select one...</option>
                  <option value="none">None</option>
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
          </div> 
        <!-- end row -->

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
        <button class="btn btn-dark btn-block" onclick="window.history.go(-1); return false;">Go Back</button>
    </form>





    </div>


    <script src="../assets/scripts/dropdown.js?v=5.1.1"></script>
    


    <script>
    

    </script>
 
    
</body>
</html>
