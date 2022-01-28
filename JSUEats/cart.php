<?php
session_start();
require 'db_connection.php';
$conn = OpenCon();
if (!isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit;

}
?>

<html>

  <head>
    <title> Home | JSUEats </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <link href="css/home.css" rel="stylesheet" type="text/css">

  <body>

    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">JSUEATS</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contact.php">Contact Us</a></li>

          </ul>


<?php

if (isset($_SESSION['loggedin'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome  </a></li>
            <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
            <li class="active"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
              (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>)
             </a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>

<ul class="nav navbar-nav navbar-right">
              <li> <a href="register.php"> Sign-up</a></li>
            
              <li> <a href="login.php"> User Login</a></li>
             
            
            </li>
        </ul>

<?php
}
?>
       </div>

      </div>
    </nav>

    <?php
    if(!empty($_SESSION["cart"]))
    {
    ?>
    <div class="container">
        <div class="jumbotron">
            <h1>Your Order</h1>
            
        </div>
        
        </div>
        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;" >
    <table class="table table-striped">
    <thead class="thead-dark">
    <tr>
    <th width="40%">Food Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price</th>
    <th width="15%">Order Total</th>
    <th width="5%">Action</th>
    </tr>
    </thead>


    <?php  

    $total = 0;
    foreach($_SESSION["cart"] as $keys => $values)
    {
    ?>
    <tr>
    <td><?php echo $values["food_name"]; ?></td>
    <td><?php echo $values["food_quantity"] ?></td>
    <td>&#36; <?php echo $values["food_price"]; ?></td>
    <td>&#36;<?php echo number_format($values["food_quantity"] * $values["food_price"], 2); ?></td>
    <td><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><span class="text-danger">Remove</span></a></td>
    </tr>
    <?php 
    $total = $total + ($values["food_quantity"] * $values["food_price"]);
    }
    ?>
    <tr>
    <td colspan="3" align="right">Total</td>
    <td align="right">&#36; <?php echo number_format($total + (.07 * $total), 2); ?></td>
    <td></td>
    </tr>
    </table>
    <?php
    echo '<a href="cart.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Empty Cart</button></a>&nbsp;<a href="restaurantlist.php"><button class="btn btn-warning">Continue Shopping</button></a>&nbsp;<a href="payment.php"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Check Out</button></a>';
    ?>
    </div>
    <br><br><br><br><br><br><br>
    <?php
    }
    if(empty($_SESSION["cart"]))
    {
    ?>
    <div class="container">
        <div class="jumbotron">
            <h1>Your Order</h1>
            <p>No food Here. Go back and <a href="restaurantlist.php">order Here.</a></p>
            
        </div>
        
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php
    }
    ?>


    <?php


    if(isset($_POST["add"]))
    {
    if(isset($_SESSION["cart"]))
    {
    $item_array_id = array_column($_SESSION["cart"], "food_id");
    if(!in_array($_GET["id"], $item_array_id))
    {
    $count = count($_SESSION["cart"]);

    $item_array = array(
    'food_id' => $_GET["id"],
    'food_name' => $_POST["hidden_name"],
    'food_price' => $_POST["hidden_price"],
    'r_id' => $_POST["hidden_RID"],
    'food_quantity' => $_POST["quantity"]
    );
    $_SESSION["cart"][$count] = $item_array;
    echo '<script>window.location="cart.php"</script>';
    }
    else
    {
    echo '<script>alert("Products already added to cart")</script>';
    echo '<script>window.location="cart.php"</script>';
    }
    }
    else
    {
    $item_array = array(
    'food_id' => $_GET["id"],
    'food_name' => $_POST["hidden_name"],
    'food_price' => $_POST["hidden_price"],
    'r_id' => $_POST["hidden_RID"],
    'food_quantity' => $_POST["quantity"]
    );
    $_SESSION["cart"][0] = $item_array;
    }
    }
    if(isset($_GET["action"]))
    {
    if($_GET["action"] == "delete")
    {
    foreach($_SESSION["cart"] as $keys => $values)
    {
    if($values["food_id"] == $_GET["id"])
    {
    unset($_SESSION["cart"][$keys]);
    echo '<script>alert("Food item has been removed")</script>';
    echo '<script>window.location="cart.php"</script>';
    }
    }
    }
    }

    if(isset($_GET["action"]))
    {
    if($_GET["action"] == "empty")
    {
    foreach($_SESSION["cart"] as $keys => $values)
    {

    unset($_SESSION["cart"]);
    echo '<script>alert("Your cart is now empty!")</script>';
    echo '<script>window.location="cart.php"</script>';

    }
    }
    }


    ?>
    <?php

    ?>