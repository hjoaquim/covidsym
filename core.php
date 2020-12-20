<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

// If the user is not logged in redirect to the login page...
#include("login.php");

if (!isset($_SESSION['loggedin'])) {
    include("login.php");
}
else 
    echo "teste";

?>