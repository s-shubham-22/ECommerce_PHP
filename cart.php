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

    <title>Cart | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname='cart';
      include "./includes/nav.php";
      ?>
      <div id="success-msg">
      </div>
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
        ?>
          <section>
            <?php
            $sql = "SELECT * FROM cart WHERE sno='".$_SESSION['sno']."'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
              echo '<div class="m-4">
          <table class="table table-bordered table-dark" id="user_table">
            <thead>
              <tr>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price per  Piece</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price for Item</th>
                <th scope="col">Action</th>
              </tr>
              </thead>';
              $totalprice = 0;
              while($row = mysqli_fetch_assoc($result)) {
                $sql2 = 'SELECT * FROM product WHERE pid='.$row['pid'];
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '<tr id="prow-'.$row['pid'].'">
                        <th scope="row"><img src=\'./uploads/product/'.$row2['img_name'].'\' style="height: 170px; object-fit: contain;" class="card-img-top product-img-list" alt="..."></th>
                        <td>'.$row2['pname'].'</td>
                        <td id="price-'.$row['pid'].'">'.$row2['price'].'</td>
                        <td><div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="button" class="btn btn-primary" onclick="manageQuantity('.$row['pid'].', \'decrement\');">-</button>
                                <button type="button" class="btn btn-light" id="pimg-'.$row['pid'].'">'.$row['quantity'].'</button>
                                <button type="button" class="btn btn-primary" onclick="manageQuantity('.$row['pid'].', \'increment\');">+</button>
                              </div></td>
                        <td class="totprice" id="totprice-'.$row['pid'].'">'.$row2['price'] * $row['quantity'].'</td>
                        <td><button type="button" class="btn btn-danger" onclick="manageQuantity('.$row['pid'].', \'delete\');">Delete Item</button></td>
                      </tr>';
                      $totalprice += $row2['price'] * $row['quantity'];
              }
              echo '
                <tr>
                  <td colspan="4" class="text-right">Total Price</td>
                  <td id="final-price">'.$totalprice.'</td>
                  <td><a class="btn btn-success" href="checkout.php">Checkout</a></td>
                </tr>
              ';
            } else {
              ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="width: 600px; margin: 1rem auto;'">
                  <strong>Sorry!</strong> Your Cart is Empty.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php
            }
            ?>
            </table>
            
          </section>
        <?php
      }
    ?>
    

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
      function manageQuantity(pid, action) {
        $.ajax({
          url: './manageQuantity.php',
          type: 'POST',
          data: {
            sno : <?php echo $_SESSION['sno']; ?>,
            pid: pid,
            action: action
          },
          success: function(response) {
            response = JSON.parse(response);
            if(response.status == 1) {
              id = '#pimg-'+pid;
              $(id).text(response.quantity);
              id = '#totprice-'+pid;
              price = $('#price-'+pid).text() * response.quantity;
              $(id).text(price);
              <?php 
                // $sql = "SELECT * FROM cart WHERE sno='".$_SESSION['sno']."'";
                // $result = mysqli_query($conn, $sql);
                // $totalprice = 0;
                // while($row = mysqli_fetch_assoc($result)) {
                //   $sql2 = 'SELECT * FROM product WHERE pid='.$row['pid'];
                //   $result2 = mysqli_query($conn, $sql2);
                //   $row2 = mysqli_fetch_assoc($result2);
                //   $totalprice += $row['quantity'] * $row2['price'];
                //   echo 'console.log('.$totalprice.');';
                // }
              ?>
             // console.log(<?php echo $totalprice; ?>);
              //$('#final-price').text(<?php echo $totalprice; ?>);
              
            } else if (response.status == 0) {
              id = '#prow-'+pid;
              $(id).remove();
            } else {
              console.log(response.quantity);
            }
            getTotal();

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
        });
      }
      function getTotal()
      {
        let total = 0;
        $("#user_table tr .totprice").each(function(){
          total += parseFloat($(this).text());
        });
        $('#final-price').text(total);
      }
    </script>
  </body>
  </html>