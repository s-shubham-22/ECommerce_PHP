<?php
  require "./includes/conn.php";
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $sno = $_POST['sno'];  
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $sql = 'SELECT * FROM users WHERE username = "'.$username.'" AND NOT sno = '.$sno.'';
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
      $sql = 'UPDATE users SET username = "'.$username.'", fname = "'.$fname.'", lname = "'.$lname.'", mobile = "'.$mobile.'", email = "'.$email.'", gender = "'.$gender.'", address = "'.$address.'" WHERE sno = "'.$sno.'"';
      $result = mysqli_query($conn, $sql);
      if($result) {
        $_SESSION['success'] = 1;
        $_SESSION['successmsg'] = "Data Updated Successfully!";
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Data not Updated!";
      }
      header('location: ./user.php');
    }

    echo $num;
  }
?>