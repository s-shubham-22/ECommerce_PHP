<?php
  require './includes/conn.php';
?>
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

    <title><?php 
      $sql = "SELECT * FROM product WHERE pid = ".$_GET['pid'];
      $result = mysqli_query($conn, $sql);
      if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['pname'];
      }
    ?></title>
  </head>
  <body>
    <?php 
      $pgname='store';
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
        $sql = 'SELECT * FROM product WHERE cid = '.$row['cid'].' AND pid != '.$row['pid'];
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
          ?>
          <div class="product-container">
            <img src="./uploads/product/<?php echo $row['img_name'] ?>" class="img-fluid product-image" alt="...">
            <div class="product-details">
              <h1 class="product-title"><?php echo $row['pname'] ?></h1>
              <p class="product-description"><?php echo $row['description'] ?></p>
              <h3 class="product-price">$<?php echo $row['price'] ?></h3>
              <h5 class="product-stock">Left in Stock: <?php echo $row['stock'] ?></h5> 
              <a class="btn btn-success" onclick="manageQuantity(<?php echo $row['pid']; ?>);">Add to Cart</a>
            </div>
          </div>
          <div class="related-product-container">
            <h4 class="title">Related Products:</h4>
            <div class="related-product">
            <?php
              echo '<section class="center"><div class="row row-cols-1 row-cols-md-3">';
              while($row = mysqli_fetch_assoc($result)) {
                echo '<a href="productDetails.php?pid='.$row['pid'].'">
                        <div class="col mb-4">
                          <div class="card h-100 product-card">
                            <img src=\'./uploads/product/'.$row['img_name'].'\' class="card-img-top product-img-list" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">'.$row['pname'].'</h5>
                              <h6 class="card-title">Rs. '.$row['price'].'</h6>
                            </div>
                          </div>
                        </div>
                      </a>';
                }
                echo '</div></section>';
              ?>
            </div>
          </div>
          <?php
        }
      }
    ?>
    

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
      function manageQuantity(pid) {
        console.log(pid);
        $.ajax({
          url: './addToCart.php',
          type: 'POST',
          data: {
            sno : <?php echo $_SESSION['sno']; ?>,
            pid: pid
          },
          success: function(response) {
            response = JSON.parse(response);
            console.log(response);
            if(response.status == 1) {
              if(response.msg) {
              $('#success-msg').html(
                `<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> `+ response.msg +` 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>`
                );
              } 
            }
          }
        });
      }
    </script>
  </body>
</html>