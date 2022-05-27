<?php
  require "./includes/conn.php";
  if(isset($_SESSION['sno'])) {
    if($_SERVER['REQUEST_METHOD'] = 'POST') {
      $sno = $_SESSION['sno'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $baddress = $_POST['baddress'];
      $saddress = $_POST['saddress'];
      $country = $_POST['country'];
      $state = $_POST['state'];
      $city = $_POST['city'];
      $sql = "INSERT INTO orders (sno, name, email, mobile, baddress, saddress, country, state, city) VALUES ('$sno', '$name', '$email', '$mobile', '$baddress', '$saddress', '$country', '$state', '$city')";
      $result = mysqli_query($conn, $sql);
      if($result) {
        $oid = mysqli_insert_id($conn);
        $sql = "SELECT * FROM cart WHERE sno = '$sno'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            $pid = $row['pid'];
            $quantity = $row['quantity'];
            $sql2 = "SELECT * FROM product WHERE pid = '$pid'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $price = $row2['price'];
            $sql3 = "INSERT INTO order_details (oid, sno, pid, price, quantity, status) VALUES ($oid, $sno, $pid, $price, $quantity, 0)";
            $result3 = mysqli_query($conn, $sql3);
          }

          $sql = "DELETE FROM cart WHERE sno = '$sno'";
          $result = mysqli_query($conn, $sql);
          if($result) {
            $_SESSION['success'] = 1;
            $_SESSION['successmsg'] = "Order placed successfully";
            header("Location: cart.php");
            exit;
          }
        } else {
          header('Location: cart.php');
          exit;
        }
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Error in placing order. Please try again.";
        header("Location: checkout.php");
        exit;
      }
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Invalid Request";
      header("Location: checkout.php");
      exit;
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login to continue";
    header("Location: ./login.php");
    exit;
  }
?>