<?php
  require './includes/conn.php';
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pid'])) {
      $sno = $_POST['sno'];
      $pid = $_POST['pid'];
      $sql = "SELECT * FROM cart WHERE sno = $sno AND pid = $pid";
      $result = mysqli_query($conn, $sql);      
      $sql = 'INSERT INTO cart (sno, pid, quantity) VALUES ("'.$sno.'", "'.$pid.'", 1)';
      if($result && mysqli_num_rows($result) > 0) {
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE sno = $sno AND pid = $pid";
      } 
      $result = mysqli_query($conn, $sql);
      if($result) {
        $sql = "SELECT * FROM cart WHERE sno='".$_SESSION['sno']."' AND pid='".$pid."'";
        $result = mysqli_query($conn, $sql);
        if($result) {
          $row = mysqli_fetch_assoc($result);
          $quantity = $row['quantity'];
          $response = array('status' => 1, 'quantity' => $quantity, 'msg' => 'Item added to cart.');
          echo json_encode($response);
          exit;
        } else {
          $quantity = 0;
          $response = array('status' => 0, 'quantity' => 0, 'msg' => 'Item not Added to Cart');
          $sql = "DELETE FROM cart WHERE sno = $sno AND pid = $pid";
          $result = mysqli_query($conn, $sql);
          echo json_encode($response);
          exit;
        }
        
      } else {
        $response = array('status' => 0, 'quantity' => 0, 'msg' => 'Item not Added to Cart');
        echo json_encode($response);
      }
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Invalid request";
      header("Location: cart.php");
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login to continue";
    header("Location: ./login.php");
  }
?>