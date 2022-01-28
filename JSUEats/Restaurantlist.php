<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit;

}
?>
<html>

  <head>
    <title> Explore | Restaurants JSUEats </title>
  </head>

  
  <link rel="stylesheet" type = "text/css" href ="css/restaurantlist.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
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
    h2 {
        display: block;
        text-align: center;
    }</style>
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
          <a class="navbar-brand" href="index.php">JSUEats </a>
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
<h1 >JSUEats </h1>
<h2>Where would you like to eat?</h2>
<div class="container" style="width:95%;">

<!-- Display all Food from food table -->
<?php

require 'db_connection.php';
$conn = OpenCon();

$sql = "SELECT * FROM restaurants  ORDER BY id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
$count=0;

while($row = mysqli_fetch_assoc($result)){
if ($count == 0)
echo "<div class='row'>";

?>
<div class="col-md-3">


<div class="mypanel" align="center";>

</div>

<form method="post" action="restaurantlist.php<?php echo $row["id"]; ?>">
<div class="mypanel" align="center";>
<a href="<?php echo $row["menu_path"]?>"><img src="<?php echo $row["image_path"]; ?>">
<h3 class="text-dark"><?php echo $row["name"]; ?></h3>
<h3 class="text-dark"> <?php echo $row["address"]; ?>/-</h3>


</div>

<?php
$count++;
if($count==4)
{
echo "</div>";
$count=0;
}
}
?>

</div>
</div>
<?php
}
else
{
?>

<div class="container">
<div class="jumbotron">
<center>
   <label style="margin-left: 5px;color: red;"> <h1>Oops! No food is available.</h1> </label>
  <p>Stay Hungry...! :P</p>
</center>
 
</div>
</div>

<?php

}

?>