<?php

    $username = $_POST['txtUser'];
    $password = $_POST['txtPassword'];

    if(!isset($username) || $username == "" 
    || !isset($password) || $password == "")
    {
        header("Location: signup.php");
        die();
    }

    $username = htmlspecialchars($username);

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    require("/dbConnect.php");
    $db =get_db();

    $query = "INSERT INTO usr(username, password) VALUES(:username, :password)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);

    $statement->bindValue(':password', $hashPassword);

    $statement->execute();

    header("Location: signin.php");
    die();

?>