<?php
  require 'conn.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="./">Ecommerce -  <?php if(isset($_SESSION['username'])) { echo $_SESSION['username'].' - '.$_SESSION['sno']; }?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php

        // Home 
        $uri = strtolower($_SERVER['REQUEST_URI']);
        $proactive='';
          if($pgname =='home'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
        echo '<a class="nav-link" href="./">Home</a>
        </li>';

        if(!isset($_SESSION['username'])) {
          // Login
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='login'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./login.php">Login</a>
          </li>';

          // Sign Up
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='signup'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./signup.php">Sign Up</a>
          </li>';
        } else if ($_SESSION == true) {
          // User
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='user'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./user.php">Users</a>
          </li>';

          //Category
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='category'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./category.php">Category</a>
          </li>';
          
          //Product
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='product'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./product.php">Products</a>
          </li>';

          //Store
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='store'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./store.php">Store</a>
          </li>';
          
          //Cart
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='cart'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./cart.php">Cart</a>
          </li>';
          
          //Orders
          $uri = strtolower($_SERVER['REQUEST_URI']);
          $proactive='';
          if($pgname =='orders'){
            $proactive='active';
          }
          echo '<li class="nav-item '.$proactive.'">';
          echo '<a class="nav-link" href="./orders.php">Orders</a>
          </li>';

          // Logout
          echo '<li>
          <a class="nav-link" href="./logout.php">Logout</a>
          </li>';
        } else {
          echo '<h1>Something Went Wrong</h1>';
        }

      ?>
    </ul>
  </div>
</nav>