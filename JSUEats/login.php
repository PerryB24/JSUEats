<? 
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
  <title> login | JSUEats </title>
</head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
        <link href="css/styles.css" rel="stylesheet" type="text/css">


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
		<div class="login">
			<h1>Login </h1> 
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
                <a href="register.php"> No Account? Register here </a>
				<input type="submit" value="Login">
    
			</form>
		</div>
	</body>
</html>