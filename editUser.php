<?php
  require "./includes/conn.php";
  $sno = $_REQUEST['sno'];
  $sql = "SELECT * FROM users WHERE sno = $sno";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $gender = $row['gender'];
    $address = $row['address'];
    //-----------------------LEFT FROM HERE----------------------
  }
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

    <title>Edit User | Ecommerce</title>
  </head>
  <body>
    <?php 
      $pgname = 'user';
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
      <form method="post" action="./edit.php">
        <div class="form-group">
          <input type="hidden" class="form-control" name="sno" id="sno" maxlength="20" value="<?php echo $sno ?>" required>   
        </div>
        <div class="form-group">
          <label for="username">Username<span class="text-danger">*</span></label>
          <input type="username" class="form-control" name="username" id="username" maxlength="20" value="<?php echo $username ?>" required>   
        </div>
        <div class="form-group">
          <label for="fname">First Name<span class="text-danger">*</span></label>
          <input type="fname" class="form-control" name="fname" id="fname" maxlength="80" value="<?php echo $fname ?>" required>
        </div>
        <div class="form-group">
          <label for="lname">Last Name<span class="text-danger">*</span></label>
          <input type="lname" class="form-control" name="lname" id="lname" maxlength="80" value="<?php echo $lname ?>" required>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number<span class="text-danger">*</span></label>
          <input type="tel" class="form-control" name="mobile" id="mobile" maxlength="10" value="<?php echo $mobile ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email ID<span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" id="email" aria-describedby="cplabel" maxlength="80" value="<?php echo $email ?>" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender<span class="text-danger">*</span></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if($gender == "male"){echo "checked";} ?>>
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if($gender == "female"){echo "checked";} ?>>
            <label class="form-check-label" for="female">Female</label>
          </div>
        </div>
        <div class="form-group">
          <label for="address">Address<span class="text-danger">*</span></label>
          <textarea class="form-control" name="address" id="address" maxlength="400" rows="4" cols="100" required><?php echo $address ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-danger" href="./user.php">Cancel</a>
      </form>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>