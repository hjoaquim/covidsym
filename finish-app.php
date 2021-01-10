<?php


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'], $_SESSION['usr_type']) && $_SESSION['usr_type']==3) {
        header('Location: index.html');
        exit;
    }

    include_once 'header.php';


    

    include_once 'footer.php';


?>
