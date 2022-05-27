<?php
  require "./includes/conn.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/css/style.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
  
    
    <title>Users | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname='user';
      include "./includes/nav.php";
      if(isset($_SESSION['err']) && $_SESSION['err'] == 1){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> '.$_SESSION['errmsg'].' 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        $_SESSION['err'] = 0;
        $_SESSION['errmsg'] = "";
      } else if (isset($_SESSION['success']) && $_SESSION['success'] == 1){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> '.$_SESSION['successmsg'].' 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        $_SESSION['success'] = 0;
        $_SESSION['successmsg'] = "";
      }
      if(isset($_SESSION['username'])) {
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        echo '<div class="m-4">
          <table class="table table-striped table-dark" id="user_table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Mobile No.</th>
                <th scope="col">Email ID</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Joined</th>
                <th scope="col">Last Login</th>
                <th scope="col">Action</th>
              </tr>
            </thead>';
        while($row = mysqli_fetch_assoc($result)) {
          echo '<tr>
            <th scope="row">'.$row['sno'].'</th>
            <td>'.$row['username'].'</td>
            <td>'.$row['fname'].'</td>
            <td>'.$row['lname'].'</td>
            <td>'.$row['mobile'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$row['address'].'</td>
            <td>'.$row['join_date'].'</td>
            <td>'.$row['lastlogin'].'</td>
            <td>
              <a href="./editUser.php?sno='.$row['sno'].'" class="mr-4"><img src = "./asset/icon/edit.svg" alt="Edit" width="18"/></a>
              <a id="delete-url-'.$row['sno'].'" href-url="delete.php?sno='.$row['sno'].'" href="javascript:void(0);" onclick="confirmation('.$row['sno'].');"><img src = "./asset/icon/delete.svg" alt="Delete" width="18"/></a>
            </td>
          </tr>';
        }
        
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Please Sign Up or Login to continue.";
        header("location: ./signup.php");
      }
    ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    <script>
      $(document).ready( function () {
        $('#user_table').DataTable();
      });

      function confirmation(id){
        var answer = confirm("Are you sure you want to delete this task?");
        if(answer){
          window.location = document.getElementById('delete-url-' + id).getAttribute('href-url'); 
        }
      }
    </script>
  </body>
</html>