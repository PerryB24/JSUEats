<?php



if(!isset($_SESSION)) {
    session_start();
}
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "jsueats";
 //This creates the connection
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Database connection not established.");
 
 return $conn;
 }
?>