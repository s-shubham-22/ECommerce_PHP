<?php
  require './includes/conn.php';
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $country_id = $_POST['country_id'];
    $sql = 'SELECT * FROM state WHERE country_id = '.$country_id.'';
    $result = mysqli_query($conn, $sql);
    if($result) {
      $data = array();
      while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
      }
      echo json_encode($data);
    } else {
      echo "0";
    }
  }  
?>