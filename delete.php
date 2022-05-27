<?php
  require './includes/conn.php';
  $sno = $_REQUEST['sno'];
  $sql = "DELETE FROM `users` WHERE `users`.`sno` = $sno;";
  $result = mysqli_query($conn, $sql);
  if($result) {
    $_SESSION['success'] = 1;
    $_SESSION['successmsg'] = "Data Deleted Successfully!";
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Data not Deleted!";
  }
  header('location: user.php'); 
?>