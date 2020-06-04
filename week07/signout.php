<?php
    $title = "Signing out...";
    include ("/header.php");
    
    require("/password.php");
    unset($_SESSION['username']);

    header("Location: signin.php");
    die();
?>