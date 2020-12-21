<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$message_sucess = "Loggedin sucessfuly";
$message_fail = "Error loggin in";

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'sim';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));


if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	echo "<script type='text/javascript'>alert('$message_fail');</script>";
	header("Location: core.php");
	exit();
}

$query = 'SELECT * FROM utl_utilizadores WHERE username = "'.$_POST['username'].'"';
$result = mysqli_query($con, $query) or die('The query failed: ' . mysqli_error($con));

if (mysqli_num_rows($result) > 0) {

	$user = mysqli_fetch_row($result);
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $user[2])) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $user[1];
		$_SESSION['id'] = $user[0];
		echo "<script type='text/javascript'>alert('$message_sucess');</script>";;
		
	} else {
		// Incorrect password
		echo "<script type='text/javascript'>alert('$message_fail');</script>";
	}
} else {
	// Incorrect username
	echo "<script type='text/javascript'>alert('$message_fail');</script>";
}

header("Location: core.php");
exit();


?>