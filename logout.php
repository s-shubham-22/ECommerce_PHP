<?php

require "./includes/conn.php";
if(isset($_SESSION)){
  session_destroy();
  header("location: ./signup.php");

  mysqli_close($conn);
}

?>