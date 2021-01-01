<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['loggedin'])) {
    include("login.php");
}

else
    include("profile.php");


?>
