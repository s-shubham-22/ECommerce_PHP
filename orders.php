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

    <title>Orders | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname='orders';
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
          <section class="m-4" >
          <div id="order-completed">            
              <h2>Orders Completed:</h2>
              <?php
              $sql = "SELECT * FROM order_details WHERE sno='".$_SESSION['sno']."' AND status='1'";
              $result = mysqli_query($conn, $sql);
              
                echo '
            <table class="table table-bordered table-dark" id="order_c">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Product Image</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Price per  Piece</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total Price for Item</th>
                </tr>
                </thead>';
                if(mysqli_num_rows($result) > 0) {
                $totalprice = 0;
                while($row = mysqli_fetch_assoc($result)) {
                  $sql2 = 'SELECT * FROM product WHERE pid='.$row['pid'];
                  $result2 = mysqli_query($conn, $sql2);
                  $row2 = mysqli_fetch_assoc($result2);
                  echo '<tr id="prow-'.$row['pid'].'">
                          <td>'.$row['oid'].'</td>
                          <td scope="row"><img src=\'./uploads/product/'.$row2['img_name'].'\' style="height: 170px; object-fit: contain;" class="card-img-top product-img-list" alt="..."></td>
                          <td>'.$row2['pname'].'</td>
                          <td id="price-'.$row['pid'].'">'.$row2['price'].'</td>
                          <td>'.$row['quantity'].'</td>
                          <td class="totprice" id="totprice-'.$row['pid'].'">'.$row2['price'] * $row['quantity'].'</td>
                          
                        </tr>';
                        $totalprice += $row2['price'] * $row['quantity'];
                }
              } else {
                ?>
                  <tr><td colspan="7" id="no-data-alert">No Data Found</td></tr>
                <?php
              }
              ?>
              </table>
            </div>

            <div id="order-remaining">            
              <h2>Orders Remaning:</h2>
              <?php
              $sql = "SELECT * FROM order_details WHERE sno='".$_SESSION['sno']."' AND status='0'";
              $result = mysqli_query($conn, $sql);
              
                echo '
            <table class="table table-bordered table-dark" id="order_r">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Product Image</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Price per  Piece</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total Price for Item</th>
                  <th scope="col">Action</th>
                </tr>
                </thead>';
                if(mysqli_num_rows($result) > 0) {
                $totalprice = 0;
                while($row = mysqli_fetch_assoc($result)) {
                  $sql2 = 'SELECT * FROM product WHERE pid='.$row['pid'];
                  $result2 = mysqli_query($conn, $sql2);
                  $row2 = mysqli_fetch_assoc($result2);
                  echo '<tr id="prow-'.$row['pid'].'" class="prow">
                          <td>'.$row['oid'].'</td>
                          <td scope="row"><img src=\'./uploads/product/'.$row2['img_name'].'\' style="height: 170px; object-fit: contain;" class="card-img-top product-img-list" alt="..."></td>
                          <td>'.$row2['pname'].'</td>
                          <td id="price-'.$row['pid'].'">'.$row2['price'].'</td>
                          <td>'.$row['quantity'].'</td>
                          <td class="totprice" id="totprice-'.$row['pid'].'">'.$row2['price'] * $row['quantity'].'</td>
                          <td><button type="button" class="btn btn-success" onclick="markAsDone('.$row['oid'].', '.$row['pid'].');">Mark as Done</button></td>
                        </tr>';
                        $totalprice += $row2['price'] * $row['quantity'];
                }
              } else {
                ?>
                  <tr colspan="7" id="no-data-alert">No Data Found</tr>
                <?php
              }
              ?>
              </table>
            </div>
          </section>
        <?php
      }
    ?>
    

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
      function markAsDone(oid, pid) {
        $.ajax({
          url: './markAsDone.php',
          type: 'POST',
          data: {
            sno : <?php echo $_SESSION['sno']; ?>,
            oid: oid,
            pid: pid
          },
          success: function(response) {
            const img_name = $('#prow-'+pid).find('img').attr('src');
            const pname = $('#prow-'+pid).find('td:nth-child(3)').text();
            const price = $('#prow-'+pid).find('td:nth-child(4)').text();
            const quantity = $('#prow-'+pid).find('td:nth-child(5)').text();
            if(response == 'success') {
              console.log('success');
              $('#no-data-alert').remove();
              $('#order_c').append(`<tr id="prow-${pid}">
                          <td>${oid}</td>
                          <td scope="row"><img src='${img_name}' style="height: 170px; object-fit: contain;" class="card-img-top product-img-list" alt="..."></td>
                          <td>${pname}</td>
                          <td id="price-${pid}">${price}</td>
                          <td>${quantity}</td>
                          <td class="totprice" id="totprice-${pid}">${price * quantity}</td>
                        </tr>`);
              $('#order_r').find('#prow-'+pid).remove();
            }
            if($('#order_r').find('.prow').length == 0) {
              $('#order_r').hide();
              $('#order-remaining').append(`<div class="alert alert-info alert-dismissible fade show" role="alert" style="width: 600px; margin: 1rem auto;'">
                  <strong>Sorry!</strong> Your Order List is Empty.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>`);
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