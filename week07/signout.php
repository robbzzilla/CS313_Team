<?php
    $title = "Signing out...";
    include_path: ("/header.php");

    require("/password.php");
    unset($_SESSION['username']);

    header("Location: signin.php");
    die();
    include '/footer.php';
?>