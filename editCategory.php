<?php
  require "./includes/conn.php";
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == "POST") {
      $cid = $_POST['cid'];
      $cname = $_POST['cname'];
      $slug = create_slug($cname);
      echo $sql = 'UPDATE category SET cname = "'.$cname.'", slug = "'.$slug.'", edited_by = "'.$_SESSION['sno'].'", edited_at = now() WHERE cid = '.$cid;
      $result = mysqli_query($conn, $sql);
      if($result) {
        $_SESSION['success'] = 1;
        $_SESSION['successmsg'] = "Category updated successfully!";
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Error updating category!";
      }
      header("location: category.php");
    }
  }
  function create_slug($string){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = strtolower($slug);
    return $slug;
  }
  

?>