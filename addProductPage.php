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
  
    
    <title>Add Product | Ecommerce</title>
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
        ?>
        <div id="addProductFormContainer">
          <form class="m-4" method="POST" action="addProduct.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="pname">Product Name<strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" id="pname" name="pname" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Category<strong class="text-danger">*</strong></label>
              <select class="custom-select" name="cid" required>
                <?php 
                  $sql = "SELECT * FROM category";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="'.$row['cid'].'">'.$row['cname'].'</option>';
                  }
                  ?>
              </select> 
            </div>
            <div class="form-group">
              <label for="price">Price<strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
              <label for="stock">Stock<strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" id="stock" name="stock" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
              <label for="description">Product Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" cols="100" required></textarea>
            </div>
            <div class="form-group">
              <label for="product_img">Product Image<strong class="text-danger">*</strong></label>
              <input type="file" class="form-control-file" id="product_img" name="product_img" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <?php     
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Please Sign Up or Login to continue.";
        header("location: ./signup.php");
      }
    ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
  </body>
</html>