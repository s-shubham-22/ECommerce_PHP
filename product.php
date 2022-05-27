<?php
  require 'includes/conn.php';
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
  
    
    <title>Products | Ecommerce</title>
  </head>
  <body>
    <?php
      $pgname='';
      $pgname='product';
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
        echo '<a href="addProductPage.php" class="btn btn-primary m-4">Add Product</a>';
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);

        echo '<div class="m-4">
          <table class="table table-striped table-dark" id="product_table">
            <thead>
              <tr>
                <th scope="col">PID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Slug</th>
                <th scope="col">CID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Image Name</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Added By</th>
                <th scope="col">Added At</th>
                <th scope="col">Updated By</th>
                <th scope="col">Updated At</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>';
        while($row = mysqli_fetch_assoc($result)) {
          $cid = $row['cid'];
          $sql2 = "SELECT * FROM category WHERE cid = $cid";
          $result2 = mysqli_query($conn, $sql2);
          $row2 = mysqli_fetch_assoc($result2);
          $cname = $row2['cname'];
          echo '<tr>
            <td>'.$row['pid'].'</td>
            <td>'.$row['pname'].'</td>
            <td>'.$row['slug'].'</td>
            <td>'.$row['cid'].'</td>
            <td>'.$row2['cname'].'</td>
            <td>'.$row['img_name'].'</td>
            <td>'.$row['price'].'</td>
            <td>'.$row['stock'].'</td>
            <td>'.$row['added_by'].'</td>
            <td>'.$row['added_at'].'</td>
            <td>'.$row['updated_by'].'</td>
            <td>'.$row['updated_at'].'</td>
            <td>'.$row['description'].'</td>
            <td>
              <!-- New Page Edit Button -->
              <a href="editProductPage.php?pid='.$row['pid'].'" class="mr-4"><img src = "./asset/icon/edit.svg" alt="Edit" width="18"/></a>
              
              <a id="delete-product-'.$row['pid'].'" href-url="deleteProduct.php?pid='.$row['pid'].'" href="javascript:void(0);" onclick="confirmation('.$row['pid'].');"><img src = "./asset/icon/delete.svg" alt="Delete" width="18"/></a>
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
        $('#product_table').DataTable();
      });

      function confirmation(id){
        var answer = confirm("Are you sure you want to delete this task?");
        if(answer){
          window.location = document.getElementById('delete-product-' + id).getAttribute('href-url'); 
        }
      }
    </script>
  </body>
</html>