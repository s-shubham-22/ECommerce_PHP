<?php
  require 'includes/conn.php';
  if(isset($_SESSION['username'])){
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM product WHERE pid = '$pid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql = "DELETE FROM product WHERE pid = '$pid'";
    $result = mysqli_query($conn, $sql);
    if($result) {
      unlink("uploads/product/".$row['img_name']);
      $_SESSION['success'] = 1;
      $_SESSION['successmsg'] = "Product deleted successfully.";
      header('Location: product.php');
      exit;
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Error deleting product.";
      header('Location: product.php');
      exit;
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login to continue.";
    header('Location: login.php');
    exit;
  } 
?>