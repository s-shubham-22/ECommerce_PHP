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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
  
    
    <title>Category | Ecommerce</title>
  </head>
  <body>
    <?php
      $pgname = 'category';
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
      } else if (isset($_SESSION['success']) && $_SESSION['success'] == 1){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> '.$_SESSION['successmsg'].' 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        $_SESSION['success'] = 0;
        $_SESSION['successmsg'] = "";
      }
      if(isset($_SESSION['username'])) {
        echo '<form id="category-form" class="m-4 form" method="POST" action="addCategory.php">
                <input type="text" class="form-control mb-2" id="add-category" aria-describedby="emailHelp" name="add-category" placeholder="New Category">
                <button type="submit" class="btn btn-primary">Add Category</button>
              </form>';
        $sql = "SELECT * FROM category";
        $result = mysqli_query($conn, $sql);

        echo '<div class="m-4">
          <table class="table table-striped table-dark" id="category_table">
            <thead>
              <tr>
                <th scope="col">CID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Category Slug</th>
                <th scope="col">Created By</th>
                <th scope="col">Created At</th>
                <th scope="col">Last Edited By</th>
                <th scope="col">Last Edited At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>';
        while($row = mysqli_fetch_assoc($result)) {
          echo '<tr>
            <th scope="row">'.$row['cid'].'</th>
            <td>'.$row['cname'].'</td>
            <td>'.$row['slug'].'</td>
            <td>'.$row['created_by'].'</td>
            <td>'.$row['created_at'].'</td>
            <td>'.$row['edited_by'].'</td>
            <td>'.$row['edited_at'].'</td>
            <td>
              <!-- New Page Edit Button -->
              <a href="editCategoryPage.php?cid='.$row['cid'].'" class="mr-4"><img src = "./asset/icon/edit.svg" alt="Edit" width="18"/></a>

              <!-- Same Page Edit Button -->
              <!-- <a href="javascript:void(0);" onclick="editCategory('.$row['cid'].', \''.$row['cname'].'\');" class="mr-4"><img src = "./asset/icon/edit.svg" alt="Edit" width="18"/></a> -->
              
              <a id="delete-category-'.$row['cid'].'" href-url="deleteCategory.php?cid='.$row['cid'].'" href="javascript:void(0);" onclick="confirmation('.$row['cid'].');"><img src = "./asset/icon/delete.svg" alt="Delete" width="18"/></a>
            </td>
          </tr>';
        }
        
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Please Sign Up or Login to continue.";
        header("location: ./signup.php");
      }
    ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
    
    <script>
      $(document).ready( function () {
        $('#category_table').DataTable();
      });

      function confirmation(id){
        var answer = confirm("Are you sure you want to delete this task?");
        if(answer){
          window.location = document.getElementById('delete-category-' + id).getAttribute('href-url'); 
        }
      }

      function editCategory(cid, cname){
        $('#category-form>button').text('Edit Category');
        $('#category-form').attr('action', 'editCategory.php');
        $('#category-form').prepend(`<input type="hidden" name="cid" value="${cid}">`);
        $('#add-category').val(cname);
        $('#add-category').attr('name', 'cname');
        $('#category-form').append(`<a href="./category.php" class="btn btn-secondary">Cancel</a>`);
        // alert(`Edit Category ${cid}`);
      }
    </script>
  </body>
</html>