<?php
session_start();
?>

<html>

  <head>
    <title> Home | JSUEats </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <link rel="stylesheet" type = "text/css" href ="css/home.css">
  <style>
    h1 {
      display: block;
      text-align: center;
      font-size: 5em;
      margin-top: 0.67em;
      margin-bottom: 0.67em;
      margin-left: 0;
      margin-right: 0;
      font-weight: bold;
    }
  
  </style>
  <body >

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

    <div class="wide">
      	<div class="col-xs-5 line"><hr></div>
        <img src="images/homeimg.jpg" alt="JSUEats" width="300s" height="400"/>
        <div class="col-xs-5 line"><hr></div>
    </div>
    <br>
    <h1 style="color:blue">THEE I LOVE</h1>
    <div class="orderblock">
    <h2>Are you ready to order?</h2>
    <?php  
    if(isset($_SESSION['loggedin'])){

    
    ?>
    <center><a class="btn btn-primary btn-lg" href="restaurantlist.php" role="button" > Order Now </a></center>
    
    <?php
    } 
    else {

    
    ?>
    <center>You must be logged in to use make any orders.<a href="login.php"> login here </a></center>
    <?php
    }
    ?> 
    </div>

    
  
</body>
</html>