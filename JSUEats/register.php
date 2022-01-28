<? 
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
  <title> Register | JSUEats </title>
</head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
        <link href="css/register.css" rel="stylesheet" type="text/css">


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
		<div class="register">
			<h1>Register</h1>
			<form action="register.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
                <a href="login.php"> Alreafy have an account? Login </a>
				<input type="submit" value="Register">
			</form>
		</div>
	</body>
</html>

<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "jsueats";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Database connection not established.");
 
 
if ( mysqli_connect_errno()) {

	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	
	exit('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	
	exit('Please complete the registration form');
}


if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
		
		echo 'Username exists, please choose another!';
	} else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email is not valid!');
        }

        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            exit('Username is not valid!');
        }

        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            exit('Password must be between 5 and 20 characters long!');
        }

        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {         
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $uniqid = uniqid();
            $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $uniqid);
            $stmt->execute();
            
            
        } else {
         
            echo 'Could not prepare statement!';
        }
	}
	$stmt->close();
} else {
	
	echo 'Could not prepare statement!';
}
$con->close();
?>
 