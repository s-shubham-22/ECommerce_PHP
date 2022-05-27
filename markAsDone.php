<?php
  require "./includes/conn.php";
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $oid = $_POST['oid'];
      $pid = $_POST['pid'];
      $sno = $_SESSION['sno'];
      $sql = "UPDATE order_details SET status='1' WHERE oid='$oid' AND pid='$pid' AND sno='$sno'";
      $result = mysqli_query($conn, $sql);
      $_SESSION['success'] = 1;
      $_SESSION['successmsg'] = "Order marked as completed successfully!";
      echo 'success';
      exit;
      if($result){
        header("Location: ./orders.php");
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Error marking order as completed!";
        echo 'error';
        header("Location: ./orders.php");
      }      
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Invalid Request!";
      echo 'error';
      header("Location: ./orders.php");
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login to continue";
    echo 'error';
    header('Location: ./login.php');
  }
?>