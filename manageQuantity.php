<?php
  require './includes/conn.php';
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pid']) && isset($_POST['action'])) {
      $sno = $_POST['sno'];
      $pid = $_POST['pid'];
      $action = $_POST['action'];
      if ($action == 'increment') {
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE sno = $sno AND pid = $pid";
      } else if ($action == 'decrement') {
        $sql = "UPDATE cart SET quantity = quantity - 1 WHERE sno = $sno AND pid = $pid";
      } else if ($action == 'delete') {
        $sql = "DELETE FROM cart WHERE sno = $sno AND pid = $pid";
        $result = mysqli_query($conn, $sql);
        if($result){
          $response = array('status' => 0, 'quantity' => 0, 'msg' => 'Item deleted from cart.');
          echo json_encode($response);
          exit;
        }
      }
      $result = mysqli_query($conn, $sql);
      if($result) {
        $sql = "SELECT * FROM cart WHERE sno='".$_SESSION['sno']."' AND pid='".$pid."'";
        $result = mysqli_query($conn, $sql);
        if($result) {
          $row = mysqli_fetch_assoc($result);
          $quantity = $row['quantity'];
        } else {
          $quantity = 0;
        }
        if ($quantity <= 0) {
          $response = array('status' => 0, 'quantity' => 0, 'msg' => 'Item deleted from cart.');
          $sql = "DELETE FROM cart WHERE sno = $sno AND pid = $pid";
          $result = mysqli_query($conn, $sql);
        } else {
          $response = array('status' => 1, 'quantity' => $quantity, 'msg' => 'Item updated in cart.');
        }
        echo json_encode($response);
      } else {
        echo 'error';
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