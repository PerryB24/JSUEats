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

  <link rel="stylesheet" type = "text/css" href ="css/payment.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

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
            <li class="active" ><a href="home.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contact.php">Contact Us</a></li>

          </ul>


<?php

if (isset($_SESSION['loggedin'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome  </a></li>
            <li><a href="profile.php"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
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
$gtotal = 0;
  foreach($_SESSION["cart"] as $keys => $values)
  {

    $F_id = $values["food_id"];
    $foodname = $values["food_name"];
    $quantity = $values["food_quantity"];
    $price =  $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $R_ID = $values["r_id"];
    $account_id = $_SESSION["loggedin"];
    $order_date = date('Y-m-d');
    
    $gtotal = $gtotal + $total;


     $query = "INSERT INTO ORDERS ( F_id, foodname, price,  quantity, order_date, account_id, R_ID) 
              VALUES ('" . $F_id . "','" . $foodname . "','" . $price . "','" . $quantity . "','" . $order_date . "','" . $account_id . "','" . $R_ID . "')";
             

              $success = $conn->query($query);         

      if(!$success)
      {
        ?>
        <div class="container">
          <div class="jumbotron">
            <h1>There Has Been A Problem!</h1>
            <p>Try again later.</p>
          </div>
        </div>

        <?php
      }
      
  }

        ?>
        <div class="container">
          <div class="jumbotron">
            <h1>How Would You Like To Pay?</h1>
          </div>
        </div>
        <br>
<h1 class="text-center">Your Total: &#36;<?php echo "$gtotal"; ?>/-</h1>
<h5 class="text-center">including all services. (no delivery charges applied)</h5>
<br>
<h1 class="text-center">
  <a href="cart.php"><button class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go back to cart</button></a>
  <a href="payonline.php"><button class="btn btn-success"><span class="glyphicon glyphicon-credit-card"></span> Pay Online</button></a>
  <a href="Delivery.php"><button class="btn btn-primary"><span class="glyphicon glyphicon"></span> Pay at location</button></a>
  <a href="delivery.php"><button class="btn btn-success"><span class="glyphicon glyphicon-"></span> Cash On Delivery(Charges will be applied)</button></a>
</h1>
        


<br><br><br><br><br><br>
        </body>
</html>