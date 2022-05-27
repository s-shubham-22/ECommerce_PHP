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
    
    <title>Edit Category | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname = 'category';
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
        $cid = $_GET['cid'];
        $sql = "SELECT * FROM category WHERE cid = $cid";
        $result = mysqli_query($conn, $sql);
        echo mysqli_num_rows($result);
        if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $cname = $row['cname'];
          echo '<form class="m-4 mx-auto form col-6" method="POST" action="editCategory.php" >
                  <input type="hidden" name="cid" value='.$cid.'>
                  <input type="text" class="form-control mb-2" id="edit-category" aria-describedby="emailHelp" name="cname" value='.$cname.'>
                  <button type="submit" class="btn btn-primary mx-auto" style="display: block;">Edit Category</button>
                </form>';
        } else {
          header("Location: ./category.php");
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
    
    <script>
      $(document).ready( function () {
        $('#category_table').DataTable();
      });

      function confirmation(id){
        var answer = confirm("Are you sure you want to delete this task?");
        if(answer){
          window.location = document.getElementById('delete-category-' + id).getAttribute('href-url'); 
        }
      }

      
    </script>
  </body>
</html>