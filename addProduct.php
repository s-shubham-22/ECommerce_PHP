<?php
  require 'includes/conn.php';
  if(isset($_SESSION['username'])) {
    $pname = $_POST['pname'];
    $cid = $_POST['cid'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $slug = create_slug($pname);
    $added_by = $_SESSION['sno'];
    $added_at = date("Y-m-d H:i:s");
    $updated_by = $_SESSION['sno'];
    $updated_at = date("Y-m-d H:i:s");
    $description = $_POST['description'];
    $sql = "SELECT * FROM product WHERE slug = '$slug'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 0) {
      if(isset($_POST['pname']) && isset($_POST['cid']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_FILES['product_img'])) {
        $target_dir = "uploads/product/";
        $imageFileType = strtolower(pathinfo($_FILES["product_img"]["name"],PATHINFO_EXTENSION));
        $target_file_name = uniqid('product', true).'.'.$imageFileType;
        $target_file = $target_dir . $target_file_name;
        $uploadOk = 1;
    
        
    
        // Check if $uploadOk is set to 0 by an error
        // if ($uploadOk == 0) {
        //   $_SESSION['success'] = 0;
        //   $_SESSION['successmsg'] = "";
        //   $_SESSION['err'] = 1;
        //   $_SESSION['errmsg'] = "Sorry, your file was not uploaded.";
        //   header('Location: addProductPage.php');
        // // if everything is ok, try to upload file
        // } else {
          $sql = "INSERT INTO product (pname, slug, cid, price, stock, added_by, added_at, updated_by, updated_at, description) VALUES ('$pname', '$slug', '$cid', '$price', '$stock', '$added_by', '$added_at', '$updated_by', '$updated_at', '$description')";
          $result = mysqli_query($conn, $sql);
          if($result) {
            $p_id=mysqli_insert_id($conn);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["product_img"]["tmp_name"]);
              if($check !== false) {
                $uploadOk = 1;
                header('Location: addProductPage.php');
                exit;
              } else {
               
                echo "File is not an image.";
                $uploadOk = 0;
                header('Location: addProductPage.php');
                exit;
              }
            }
        
           
        
            // Check file size
            if ($_FILES["product_img"]["size"] > 5000000) {
              $_SESSION['success'] = 0;
              $_SESSION['successmsg'] = "";
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Sorry, your file is too large.";
              $uploadOk = 0;
              header('Location: addProductPage.php');
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
              $sql = "UPDATE product SET img_name = '".$target_file_name."' WHERE pid = ".$p_id;
              $result = mysqli_query($conn, $sql);
              $_SESSION['success'] = 1;
              $_SESSION['successmsg'] = "Product Added Successfully!";
              header('Location: product.php');
              exit;
            } else {
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Data Uploaded Successfully, But there was an Error Uploading Image!";
              header('Location: addProductPage.php');
              exit;
            } 
          } else {
            $_SESSION['err'] = 1;
            $_SESSION['errmsg'] = "Sorry, there was an error uploading your file.";
            header('Location: addProductPage.php');
            exit;
          }
        //}
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Please fill all the fields.";
        header('Location: ./addProductPage.php');
        exit;
      }
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Product Already Exists!";
      header('location: ./addProductPage.php');
      exit;
    }
  } else {
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