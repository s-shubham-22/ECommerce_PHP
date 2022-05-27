<?php
  require("./includes/conn.php");

  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
      $cname = $_POST['add-category'];
      $slug = create_slug($cname);
      $created_by = $_SESSION['sno'];
      $created_at = date("Y-m-d H:i:s");
      $edited_by = $_SESSION['sno'];
      $edited_at = date("Y-m-d H:i:s");
      $sql = "SELECT * FROM category WHERE slug = '$slug'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if($num == 0) {
        $sql = "INSERT INTO category (cname, slug, created_by, created_at, edited_by, edited_at) VALUES ('$cname', '$slug', '$created_by', '$created_at', '$edited_by', '$edited_at')";
        $result = mysqli_query($conn, $sql);
        if($result) {
          $_SESSION['success'] = 1;
          $_SESSION['successmsg'] = "Category Added Successfully!";
        } else {
          $_SESSION['err'] = 1;
          $_SESSION['errmsg'] = "Category not Added!";
        }
        header('location: ./category.php');
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Category Already Exists!";
        header('location: ./category.php');
      }
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Category not Added! Please Login or Sign Up First!";
    header('location: ./category.php');
  }

  function create_slug($string){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = strtolower($slug);
    return $slug;
  }
?>