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
  
    
    <title>Edit Products | Ecommerce</title>
  </head>
  <body>
    <?php
      $pgname='';
      $pgname='product';
      include "./includes/nav.php";
      $pid = $_GET['pid'];
      $sql = "SELECT * FROM product WHERE pid = '$pid'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $pname = $row['pname'];
      $slug = $row['slug'];
      $cid = $row['cid'];
      $img_name = $row['img_name'];
      $price = $row['price'];
      $stock = $row['stock'];
      $added_by = $row['added_by'];
      $added_at = $row['added_at'];
      $updated_by = $row['updated_by'];
      $updated_at = $row['updated_at'];
      $description = $row['description'];
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
          <form class="m-4" method="POST" action="editProduct.php" enctype="multipart/form-data">
            <div class="form-group">
              <input type="hidden" class="form-control" id="pid" name="pid" aria-describedby="emailHelp" value="<?php echo $pid; ?>" required>
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control" id="old_img_name" name="old_img_name" aria-describedby="emailHelp" value="<?php echo $img_name; ?>" required>
            </div>
            <div class="form-group">
              <label for="pname">Product Name<strong class="text-danger">*</strong></label>
              <input type="text" class="form-control" id="pname" name="pname" aria-describedby="emailHelp" value="<?php echo $pname; ?>" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Category<strong class="text-danger">*</strong></label>
              <select class="custom-select" name="cid" required>
                <?php 
                  $sql = "SELECT * FROM category";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result)) {
                    if($row['cid'] == $cid) {
                      echo '<option value="'.$row['cid'].'" selected>'.$row['cname'].'</option>';
                    } else {
                      echo '<option value="'.$row['cid'].'">'.$row['cname'].'</option>';
                    }
                  }
                  ?>
              </select> 
            </div>
            <div class="form-group">
              <label for="price">Price<strong class="text-danger">*</strong></label>
              <input type="number" class="form-control" id="price" name="price" value="<?php echo $price ?>" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
              <label for="stock">Stock<strong class="text-danger">*</strong></label>
              <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock ?>" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
              <label for="description">Product Description<strong class="text-danger">*</strong></label>
              <textarea class="form-control" id="description" name="description" rows="3" cols="100" required><?php echo $description ?></textarea>
            </div>
            <div class="form-group">
              <label for="product_img">Product Image</label>
              <input type="file" class="form-control-file" id="product_img" name="product_img">
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