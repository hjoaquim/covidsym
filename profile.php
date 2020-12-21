<?php

if (session_status() == PHP_SESSION_NONE) {
session_start();
}

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'sim';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));
$query = 'SELECT * FROM utl_utilizadores WHERE ID = "'.$_SESSION['id'].'"';
$result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

if (mysqli_num_rows($result) > 0) {
	$user = mysqli_fetch_row($result);
}

?>

<?php
  include_once 'header.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$user[1]?></td>
					</tr>
					<tr>
						<td>Nome:</td>
						<td><?=$user[4]?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$user[9]?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>

<?php
  include_once 'footer.php';
?>