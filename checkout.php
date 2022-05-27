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

    <title>Checkout | Ecommerce</title>
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
            <form action="checkoutScript.php" method="post" class="center">
              <div class="form-group">
                <label for="name">Name <strong class="text-danger">*</strong></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
              </div>
              <div class="form-group">
                <label for="email">Email <strong class="text-danger">*</strong></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email" required>
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number <strong class="text-danger">*</strong></label>
                <input type="tel" class="form-control" name="mobile" id="mobile" maxlength="10" placeholder="Enter your Mobile No." required>
              </div>
              <div class="form-group">
                <label for="baddress">Billing Address <strong class="text-danger">*</strong></label>
                <textarea name="baddress" id="baddress" cols="105" rows="3" placeholder="Enter Your Billing Address" required></textarea>
              </div>
              <div class="form-group">
                <label for="saddress">Shipping Address <strong class="text-danger">*</strong></label>
                <textarea name="saddress" id="saddress" cols="105" rows="3" placeholder="Enter Your Shipping Address" required></textarea>
              </div>
              <div class="form-group">
                <label for="country">Country <strong class="text-danger">*</strong></label>
                <select class="form-control" id="country" name="country" required>
                  <option value="">Select Country</option>
                  <?php 
                    $sql = 'SELECT * FROM country';
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                      echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="state">State <strong class="text-danger">*</strong></label>
                <select class="form-control" id="state" name="state" required>
                  <option value="">Select State</option>
                </select>
              </div>
              <div class="form-group">
                <label for="city">City <strong class="text-danger">*</strong></label>
                <select class="form-control" id="city" name="city" required>
                  <option value="">Select City</option>
                </select>
              </div>
            <?php
            $sql = "SELECT * FROM cart WHERE sno='".$_SESSION['sno']."'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
              echo '<div>
                      <table class="table table-bordered table-dark" id="user_table">
                        <thead>
                          <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price per  Piece</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price for Item</th>
                          </tr>
                        </thead>';
              $totalprice = 0;
              while($row = mysqli_fetch_assoc($result)) {
                $sql2 = 'SELECT * FROM product WHERE pid='.$row['pid'];
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo '<tr id="prow-'.$row['pid'].'">
                        <td>'.$row2['pname'].'</td>
                        <td id="price-'.$row['pid'].'">'.$row2['price'].'</td>
                        <td>'.$row['quantity'].'</td>
                        <td class="totprice" id="totprice-'.$row['pid'].'">'.$row2['price'] * $row['quantity'].'</td>
                      </tr>';
                      $totalprice += $row2['price'] * $row['quantity'];
              }
              echo '
                <tr>
                  <td colspan="3" class="text-right">Total Price</td>
                  <td id="final-price">'.$totalprice.'</td>
                  </tr>
                  
                  ';
            } else {
              ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Sorry!</strong> Your Cart is Empty.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php
            }
            ?>
            </table>
            <button type="submit" class="btn btn-success center">Checkout</button>
            </form>
          </section>
        <?php
      }
    ?>
    

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
      $('#country').change(function() {
        var country_id = $(this).val();
        $.ajax({
          url: 'getState.php',
          type: 'POST',
          data: {
            'country_id': country_id
          },
          success: function(response) {
            let data = JSON.parse(response);
            if(data.length > 0 ) {
              $('#state').html('');
              $('#state').append('<option value="">Select State</option>');
              $('#city').html('<option value="">Select City</option>');
              data.forEach(function(item) {
                $('#state').append('<option value="'+item.state_id+'">'+item.state_name+'</option>');
              });
            } else {
              $('#state').html('<option value="">Select State</option>');
            }
          }
        });
      });

      $('#state').change(function() {
        var state_id = $(this).val();
        var country_id = $('#country').val();
        $.ajax({
          url: 'getCity.php',
          type: 'POST',
          data: {
            'state_id': state_id,
            'country_id': country_id
          },
          success: function(response) {
            let data = JSON.parse(response);
            if(data.length > 0 ) {
              $('#city').html('');
              $('#city').append('<option value="">Select City</option>');
              data.forEach(function(item) {
                $('#city').append('<option value="'+item.city_id+'">'+item.city_name+'</option>');
              });
            } else {
              $('#state').html('<option value="">Select State</option>');
            }
          }
        });
      });

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