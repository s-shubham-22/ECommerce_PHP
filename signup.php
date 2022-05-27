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

    <title>Sign Up | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname='signup';
      include "./includes/nav.php";
      if(isset($_SESSION['err']) && $_SESSION['err'] == 1){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> '.$_SESSION['errmsg'].' 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        $_SESSION['err'] = 0;
        $_SESSION['errmsg'] = "";
      }
    ?>
    <div class="form-container">
      <form method="post" action="./insert.php">
        <div class="form-group">
          <label for="username">Username<span class="text-danger">*</span></label>
          <input type="username" class="form-control" name="username" id="username" maxlength="20" required>   
        </div>
        <div class="form-group">
          <label for="fname">First Name<span class="text-danger">*</span></label>
          <input type="fname" class="form-control" name="fname" id="fname" maxlength="80" required>
        </div>
        <div class="form-group">
          <label for="lname">Last Name<span class="text-danger">*</span></label>
          <input type="lname" class="form-control" name="lname" id="lname" maxlength="80" required>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
          <input type="tel" class="form-control" name="mobile" id="mobile" maxlength="10" required>
        </div>
        <div class="form-group">
          <label for="email">Email ID<span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" id="email" aria-describedby="cplabel" maxlength="80" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender<span class="text-danger">*</span></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
            <label class="form-check-label" for="female">Female</label>
          </div>
        </div>
        <div class="form-group">
          <label for="address">Address<span class="text-danger">*</span></label>
          <textarea class="form-control" name="address" id="address" maxlength="400" rows="4" cols="100" required></textarea>
        </div>
        <div class="form-group">
          <label for="password">Password<span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password" id="password" maxlength="10" required>
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password<span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="cpassword" id="cpassword" aria-describedby="cplabel" maxlength="10" required>
          <small id="cplabel" class="form-text text-muted">Both passwords should be same. Length should be less than 20 characters.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>