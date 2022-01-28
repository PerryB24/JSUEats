<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit;
}
?>

<html>

  <head>
    <title> Restaurants Mcdonalds menu JSUEats </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
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
<?php
require 'db_connection.php';
$conn = OpenCon();

$sql = "SELECT * FROM food  ORDER BY id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
$count=0;

while($row = mysqli_fetch_assoc($result)){
if ($count == 0)
echo "<div class='row'>";

?>
<div class="col-md-3">


<form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">
<div class="mypanel" align="center";>
<img src="<?php echo $row["image_path"]; ?>" class="img-responsive">
<h4 class="text-dark"><?php echo $row["names"]; ?></h4>
<h5 class="text-danger">&#36; <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["names"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["r_id"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>

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
         <label style="margin-left: 5px;color: red;"> <h1>No food is available at the moment try again later.</h1> </label>
        
      </center>
       
    </div>
  </div>

  <?php

}

?>

   
</body>
</html>