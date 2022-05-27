<?php
  require './includes/conn.php';
  $cid = $_REQUEST['cid'];
  $sql = "DELETE FROM `category` WHERE `category`.`cid` = $cid;";
  $result = mysqli_query($conn, $sql);
  if($result) {
    $_SESSION['success'] = 1;
    $_SESSION['successmsg'] = "Data Deleted Successfully!";
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Data not Deleted!";
  }
  header('location: category.php'); 
?>