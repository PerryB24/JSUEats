<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "jsueats";
$con = new mysqli($localhost, $username, $password, $dbname);
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM sample";
if( isset($_GET['search']) ){
    $name = mysqli_real_escape_string($con, htmlspecialchars($_GET['search']));
    $sql = "SELECT * FROM  sample WHERE firstname ='$name'";
}
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic Search form using mysqli</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<label>Search</label>
<form action="" method="GET">
<input type="text" placeholder="Type the name here" name="search">&nbsp;
<input type="submit" value="Search" name="btn" class="btn btn-sm btn-primary">
</form>
<h2>List of students</h2>
<table class="table table-striped table-responsive">
<tr>
<th>ID</th>
<th>First name</th>
<th>Lastname</th>
<th>Address</th>
<th>Contact</th>
</tr>
<?php
while($row = $result->fetch_assoc()){
    ?>
    <tr>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo $row['firstname']; ?></td>
    <td><?php echo $row['lastname']; ?></td>
    <td><?php echo $row['address']; ?></td>
    <td><?php echo $row['contact']; ?></td>
    </tr>
    <?php
}
?>
</table>
</div>
</body>
</html>