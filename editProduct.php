<?php
  require 'includes/conn.php';
  if(isset($_SESSION['username'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $cid = $_POST['cid'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $slug = create_slug($pname);
    $old_img_name = $_POST['old_img_name'];
    $updated_by = $_SESSION['sno'];
    $updated_at = date("Y-m-d H:i:s");
    $description = $_POST['description'];
    $sql = "SELECT * FROM product WHERE slug = '$slug' AND pid != '$pid'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0) {
      if(isset($_POST['pname']) && isset($_POST['cid']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_FILES['product_img'])) {
        $target_dir = "uploads/product/";
        $imageFileType = strtolower(pathinfo($_FILES["product_img"]["name"],PATHINFO_EXTENSION));
        $target_file_name = uniqid('product', true).'.'.$imageFileType;
        $target_file = $target_dir . $target_file_name;
        $uploadOk = 1;
        $sql = "UPDATE product SET pname = '$pname', slug = '$slug', cid = '$cid', price = '$price', stock = '$stock', updated_by = '$updated_by', updated_at = '$updated_at', description = '$description' WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
        if($result) {
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["product_img"]["tmp_name"]);
            if($check !== false) {
              $uploadOk = 1;
              header('Location: editProductPage.php?pid='.$pid);
              exit;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
              header('Location: editProductPage.php?pid='.$pid);
              exit;
            }
          }
      
          if(isset($_FILES["product_img"]['tmp_name']) && !empty($_FILES["product_img"]['tmp_name']))
          {
            // Check file size
            if ($_FILES["product_img"]["size"] > 2000000) {
              $_SESSION['success'] = 0;
              $_SESSION['successmsg'] = "";
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Sorry, your file is too large.";
              $uploadOk = 0;
              header('Location: editProductPage.php?pid='.$pid);
              exit;
            }
        
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['success'] = 0;
                $_SESSION['successmsg'] = "";
                $_SESSION['err'] = 1;
                $_SESSION['errmsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                header('Location: product.php');
                exit;
            
            }
            if ( move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file)) {
              unlink("uploads/product/".$old_img_name);
              $sql = "UPDATE product SET img_name = '$target_file_name' WHERE pid = '$pid'";
              $result = mysqli_query($conn, $sql);
              $_SESSION['success'] = 1;
              $_SESSION['successmsg'] = "Product Updated Successfully!";
              header('Location: product.php');
              exit;
            } else {
              $_SESSION['success'] = 0;
              $_SESSION['successmsg'] = "";
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Data Updated Successfully, But there was an Error Updating Image!";
              header('Location: editProductPage.php?pid='.$pid);
              exit;
            }
          } else {
            $_SESSION['success'] = 0;
            $_SESSION['successmsg'] = "";
            $_SESSION['success'] = 1;
            $_SESSION['successmsg'] = "Product Updated Successfully!";
            header('Location: product.php');
            exit;
          }             
        } else {
          $_SESSION['success'] = 0;
          $_SESSION['successmsg'] = "";
          $_SESSION['err'] = 1;
          $_SESSION['errmsg'] = "Sorry, There was no Image detected.";
          header('Location: editProductPage.php?pid='.$pid);
          exit;
        }
        //}
      } else {
        $_SESSION['success'] = 0;
        $_SESSION['successmsg'] = "";
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Please fill all the fields.";
        header('Location: editProductPage.php?pid='.$pid);
        exit;
      }
    } else {
      $_SESSION['success'] = 0;
      $_SESSION['successmsg'] = "";
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Product Already Exists!";
      header('location: editProductPage.php?pid='.$pid);
      exit;
    }
  } else {
    $_SESSION['success'] = 0;
    $_SESSION['successmsg'] = "";
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login first.";
    header('Location: ./login.php');
    exit;
  }
  // print_r($_POST);
  function create_slug($string){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = strtolower($slug);
    return $slug;
  }
?>