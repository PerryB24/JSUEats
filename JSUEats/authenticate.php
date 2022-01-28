<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "jsueats";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Database connection not established.");
 
 
if ( mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
 

if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home.php');
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }


	$stmt->close();
}
?>