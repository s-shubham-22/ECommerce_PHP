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

    <title>Store | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname='store';
      include "./includes/nav.php";
      ?>
        <div id="success-msg"></div>
      <?php
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
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);
        if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cid'])) {
          $sql = "SELECT * FROM product WHERE cid = ".$_GET['cid'];
          $result = mysqli_query($conn, $sql);
        }
        if($result && mysqli_num_rows($result) > 0) {
          echo '<section class="center">';
          ?>
          <div class="dropdown mb-3">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
              Category
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <?php 
              $sql2 = "SELECT * FROM category";
              $result2 = mysqli_query($conn, $sql2);
              if($result2 && mysqli_num_rows($result2) > 0) {
                while($row2 = mysqli_fetch_assoc($result2)) {
                  echo '<a class="dropdown-item" href="store.php?cid='.$row2['cid'].'">'.$row2['cname'].'</a>';
                }
              }
              ?>
            </div>
          </div>
          <?php
          echo '<div class="row row-cols-1 row-cols-md-3">';
          while($row = mysqli_fetch_assoc($result)) {
            echo '
                    <div class="col mb-4">
                      <div class="card h-100 product-card">
                      <a href="productDetails.php?pid='.$row['pid'].'"><img src=\'./uploads/product/'.$row['img_name'].'\' class="card-img-top product-img-list" alt="..."></a>
                        <div class="card-body">
                          <h5 class="card-title">'.$row['pname'].'</h5>
                          <h6 class="card-title">Rs. '.$row['price'].'</h6>
                          <a class="btn btn-success" onclick="manageQuantity('.$row['pid'].');">Add to Cart</a>
                        </div>
                      </div>
                    </div>
                  ';
          }
          echo '</div>
          </section>';
        }
        ?>
        <?php
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