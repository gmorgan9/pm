<!DOCTYPE html>
<?php

require_once "../app/connection.php";
require_once "../path.php";
require_once "../app/functions.php";
session_start();

?>

<!-- delete personnel -->
  <?php 
  if(isset($_GET['personnel_id'])) {
    $id = $_GET['personnel_id'];

    $sql = "DELETE FROM personnel WHERE personnel_id=$id";
    $result = mysqli_query($conn, $sql);
    header('location: ../personnel/');
  }
  ?>
<!-- end delete personnel -->

<!-- add personnel -->
<?php
if(isset($_POST['add-personnel'])){

  $idno = rand(10000, 99999);

  while (true) {
      $select = "SELECT * FROM personnel WHERE idno = '$idno'";
      $result = mysqli_query($conn, $select);

      if (mysqli_num_rows($result) == 0) {
          // ID doesn't exist, break out of the loop
          break;
      } else {
          // ID exists, generate a new one
          $idno = rand(10000, 99999);
      }
  }

  if(isset($_POST['first_name'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
} else {
    $first_name = "";
}

if(isset($_POST['last_name'])) {
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
} else {
    $last_name = "";
}

if(isset($_POST['title'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
} else {
    $title = "";
}


  $insert = "INSERT INTO personnel (idno, first_name, last_name, title) VALUES ('$idno', NULLIF('$first_name',''), NULLIF('$last_name',''), NULLIF('$title',''))";


  if (mysqli_query($conn, $insert)) {
      header('location: ../personnel/');
  } else {
      echo "Error: " . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>
<!-- end add personnel -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnel - ProjectManager</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="../assets/scripts/timeout.js?v=3.0"></script>
</head>
<body style="background-color: #e3e3e3;">


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
              <li class="breadcrumb-item"><a href="../dashboard/">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Personnel</li>
            </ol>
          </nav>

          <div class="d-inline">
            <h2 class="float-start ms-2">
              Personnel
            </h2>
            <div class="float-end mb-3 me-2">
              <button type="button" class="btn btn-secondary"><a href="#" data-bs-toggle="modal" data-bs-target="#newModal" class="view text-white text-decoration-none"><i class="bi bi-plus"></i> Add Personnel</a></button>
            </div>
          </div>
          

          <!-- add Modal -->
            <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="viewModalLabel">Add Personnel</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form action="" method="POST">
                        <div class="">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name">
                        </div>
                        <div class="pt-3"></div>
                        <div class="">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name">
                        </div>
                        <div class="pt-3"></div>
                        <div class="">
                          <label>Title</label>
                          <select name="title" class="form-control">
                              <option value="">Select one...</option>
                              <option value="Staff">Staff</option>
                              <option value="Senior">Senior</option>
                              <option value="Manager">Manager</option>
                              <option value="Executive Director">Executive Director</option>
                              <option value="Chief Executive Officer">Chief Executive Officer</option>
                          </select>
                        </div>
                        <div class="pt-3"></div>
                        <input type="submit" name="add-personnel" value="Submit" class="btn btn-secondary btn-block">
                      </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
            </div>
          <!-- end add Modal -->

          <div class="container-fluid main">

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Pagination variables
                    $limit = 10; // Number of entries per page
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;
                    
                    $sql = "SELECT * FROM personnel ORDER BY created_at ASC LIMIT $limit OFFSET $offset";
                    $result = mysqli_query($conn, $sql);
                    if($result) {
                        $num_rows = mysqli_num_rows($result);
                        if($num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $personnel_id    = $row['personnel_id'];
                                $id              = $row['idno'];
                                $name            = $row['first_name'] . ' ' . $row['last_name'];
                                $title           = $row['title'];=
                ?>
                <tr>
                    <th scope="row"><?php echo $id; ?></th>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $title; ?></td>
                    <td style="font-size: 20px;"> 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $id; ?>" class="update"><i class="bi bi-pencil-square" style="color:#005382;"></i></a>
                    &nbsp; 
                    <a href="/personnel/?personnel_id=<?php echo $personnel_id; ?>" class="delete"><i class="bi bi-trash" style="color:#941515;"></i></a></td>
                </tr>

                <!-- UPDATE Modal -->
                  <div class="modal fade" id="updateModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Personnel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                <?php
                                            // $new = "SELECT * FROM personnel WHERE idno=$id";
                                            // $new1 = mysqli_query($conn, $new);
                                            // if($new1) {
                                            //     while ($cap = mysqli_fetch_assoc($new1)) {       
                                        ?> 

                                    <form action="" method="POST">
                                      <div class="">
                                          <label>First Name</label>
                                          <input class="form-control" type="text" name="first_name" >
                                      </div>
                                      <div class="pt-3"></div>
                                      <div class="">
                                          <label>Last Name</label>
                                          <input class="form-control" type="text" name="last_name">
                                      </div>
                                      <div class="pt-3"></div>
                                      <div class="">
                                        <label>Title</label>
                                        <select name="title" class="form-control">
                                            <option value="">Select one...</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Senior">Senior</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Executive Director">Executive Director</option>
                                            <option value="Chief Executive Officer">Chief Executive Officer</option>
                                        </select>
                                      </div>
                                      <div class="pt-3"></div>
                                      <input type="submit" name="add-personnel" value="Submit" class="btn btn-secondary btn-block">
                                    </form>
                                
                                    

                                    <?php //} } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- end UPDATE Modal -->

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

    <script src="/assets/scripts/dropdown.js?v=5.1.1"></script>
</body>
</html>
